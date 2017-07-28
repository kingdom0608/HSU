import MySQLdb
import RPi.GPIO as GPIO
import datetime
import time

GPIO.setmode(GPIO.BCM)
GPIO.setup(17, GPIO.IN)
GPIO.setup(27, GPIO.IN)


while True:
    input_value1 = GPIO.input(17)
    input_value2 = GPIO.input(27)
        
    if input_value1 == GPIO.LOW:
        now = time.localtime()
        totalsec1 = time.time()
        time.sleep(1)

        starthour = now.tm_hour
        startmin = now.tm_min
        startsec = totalsec1 % 60

        print starthour
        print startmin
        print startsec
        

    if input_value2 == GPIO.LOW:
        now = time.localtime()
        totalsec2 = time.time()
        time.sleep(1)

        endhour = now.tm_hour
        endmin = now.tm_min
        endsec = totalsec2 % 60

        print endhour
        print endmin
        print endsec

        duration = int(totalsec2 - totalsec1)
        print duration
      
        db = MySQLdb.connect(host="localhost", user="root", passwd="hansung", db="itshansung")
        cur = db.cursor()
        cur.execute("UPDATE user SET starthour=%s WHERE id = 1" %(starthour))
        cur.execute("UPDATE user SET startmin=%s WHERE id = 1" %(startmin))
        cur.execute("UPDATE user SET startsec=%s WHERE id = 1" %(startsec))
        
        cur.execute("UPDATE user SET endhour=%s WHERE id = 1" %(endhour))
        cur.execute("UPDATE user SET endmin=%s WHERE id = 1" %(endmin))
        cur.execute("UPDATE user SET endsec=%s WHERE id = 1" %(endsec))
        
        cur.execute("UPDATE user SET duration=%s WHERE id = 1" %(duration))
        db.commit()
        cur.close()
        db.close()
