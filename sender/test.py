import uuid
import datetime

print (':'.join(['{:02x}'.format((uuid.getnode() >> i) & 0xff) for i in range(0,8*6,8)][::-1]))
print(datetime.datetime.now().strftime("%I:%M:%S, %b %d, %Y"))
