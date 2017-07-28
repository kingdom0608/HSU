import urllib
import time
import datetime
now = time.localtime()
now = time.localtime()
year = str(now.tm_year)
month = str(now.tm_mon)
day = str(now.tm_mday)
hour = str(now.tm_hour)
minute = str(now.tm_min)
sec = str(now.tm_sec)
b='123'
a="http://glight.ueni.co.kr:7181/HCB_SERVICE/hcbService/setSportsAgent?param="+b+";run;;;;;;;"
#params = urllib.urlencode({'UID': 0, 'run': 1})
f = urllib.urlopen(a)
today = datetime.datetime.today()
to = today.strftime('20%y%m%d%H%M%S')
startmin = str(datetime.datetime.today().min)

print f.read()

             
