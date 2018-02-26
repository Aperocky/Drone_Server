import requests
import json
import uuid
import time
import datetime

class Sender:

    header = {'User-Agent':"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.134 Safari/537.36"}

    def __init__(self, url = '', data = dict()):
        self.url = url
        self.data = data

    def renew(self, url, data):
        self.url = url
        self.data = data

    def send(self):
        r = requests.post(self.url, data = self.data, headers=self.header)
        print('status: ', r.status_code, r.reason)

# Dummy payload to dummy database

def payload_gen():
    curr_time = (datetime.datetime.now().strftime("%I:%M:%S, %b %d, %Y"))
    my_mac = (':'.join(['{:02x}'.format((uuid.getnode() >> i) & 0xff) for i in range(0,8*6,8)][::-1]))
    payload = 'MWAHAHA, THIS IS ROCKY'

    # my_url = 'http://localhost/Drone-Watch/create.php'
    my_url = 'http://apps.hal.pratt.duke.edu/dronedetection/create.php'
    mydata = {'time': curr_time, 'device': my_mac, 'payload': payload}
    print(mydata)
    return my_url, mydata

if __name__ == '__main__':
    sender = Sender()
    for i in range(3):
        url, data = payload_gen()
        sender.renew(url, data)
        sender.send()
        time.sleep(3)
