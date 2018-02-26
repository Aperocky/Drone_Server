import requests
import json
import uuid

class Sender:

    def __init__(self, url, data):
        self.url = url
        if isinstance(data, dict):
            data = json.dumps(data)
        self.data = data

    def send(self):
        r = requests.post(self.url, data = self.data)
        print('status: ', r.status_code, r.reason)

# Dummy payload to dummy database

def payload_gen():
    curr_time = (datetime.datetime.now().strftime("%I:%M:%S, %b %d, %Y"))
    my_mac = (':'.join(['{:02x}'.format((uuid.getnode() >> i) & 0xff) for i in range(0,8*6,8)][::-1]))
    payload = 'MWAHAHA, THIS IS ROCKY'

    my_url = 'http://localhost/Drone-Watch/create.php'
    mydata = {'time': curr_time, 'device': my_mac, 'payload': payload}
    return my_url, mydata

sender = Sender(my_url, mydata)
sender.send()
