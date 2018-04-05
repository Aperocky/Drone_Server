#!/usr/bin/env python3
import requests
import numpy as np
import uuid
import time
import datetime
import os, random

class Sender:

    header = {'User-Agent':"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.134 Safari/537.36"}

    def __init__(self, url = '', data = dict()):
        self.url = url
        self.data = data

    def renew(self, url, data, files):
        self.url = url
        self.data = data
        self.files = files

    def send(self):
        try:
            print(self.data)
            print(self.files)
            print(self.url)
            r = requests.post(self.url, data = self.data, files=self.files, headers=self.header)
            status = 'status: ' + str(r.status_code) + ' ' + r.reason
            print(status)
            content = r.content
            print(content)
        except requests.exceptions.RequestException as e:
            print(e)
            return status, 'PAGE FAILED TO LOAD: ' + str(e)
        return status, content

class Logger:

    def __init__(self, filename):
        self.filename = filename

    def logs(self, message):
        with open(self.filename, 'a+') as log:
            now = datetime.datetime.now()
            nowstr = now.strftime('%Y-%m-%d, %H:%M:%S.%f')
            log.write(nowstr + '\n')
            log.write(message + '\n')

# Simulating class
class Simulate:

    def __init__(self, pictures = True):
        self.chance = 0
        self.pictures = pictures
        self.picpath = '/Users/aperocky/Sites/Drone-Watch/pics'

    def genchance(self):
        self.chance += np.random.normal()/2
        self.chance -= 0.2*self.chance
        if self.chance < 0:
            self.chance = 0
        elif self.chance > 1:
            self.chance = 1

    def runhook(self):
        filename = random.choice(os.listdir(self.picpath))
        return filename

    def run(self):
        self.genchance()
        if self.chance > 0.2 and self.pictures:
            fname = 'pics/' + self.runhook()
        else:
            fname = False
        if self.chance < 0.2:
            payload = 'Nothing to Report'
        else:
            payload = 'Chance of Detection : %02f %%' % (self.chance*100)
        return payload, fname

def payload_gen(sim):
    curr_time = (datetime.datetime.now().strftime("%Y-%m-%d, %H:%M:%S"))
    my_mac = (':'.join(['{:02x}'.format((uuid.getnode() >> i) & 0xff) for i in range(0,8*6,8)][::-1]))
    payload, fname = sim.run()
    # payload = 'MWAHAHA, THIS IS ROCKY'
    mydata = {'time': curr_time, 'device': my_mac, 'payload': payload}
    # my_url = 'http://localhost/Drone-Watch/create.php'
    # my_url = 'http://apps.hal.pratt.duke.edu/dronedetection/create.php'
    my_url = 'http://apps.hal.pratt.duke.edu/test/create.php'
    if fname == False:
        myfile = {}
    else:
        myfile = {'files': open(fname, 'rb')}
    return my_url, mydata, myfile

if __name__ == '__main__':
    sender = Sender()
    sim = Simulate(pictures = False)
    logger = Logger('log.txt')
    time.sleep(5)
    for i in range(10):
        url, data, files = payload_gen(sim)
        print(url, data, files)
        sender.renew(url, data, files)
        logger.logs(str(data))
        status, content = sender.send()
        logger.logs(status + '\n' + str(content))
        time.sleep(3)
