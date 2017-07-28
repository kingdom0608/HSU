import binascii
import sys
import MySQLdb
import RPi.GPIO as GPIO
import datetime
import time
import Adafruit_PN532 as PN532
import mcpi_data

GPIO.setmode(GPIO.BCM)
GPIO.setup(17, GPIO.IN)
GPIO.setup(27, GPIO.IN)

try:
    input = raw_input
except NameError:
    pass

while True:
    db = MySQLdb.connect(host="localhost", user="root", passwd="hansung", db="itshansung")
    cur = db.cursor()
    
    CS   = 18
    MOSI = 23
    MISO = 24
    SCLK = 25

    CARD_KEY = ([0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF])

    pn532 = PN532.PN532(cs=CS, sclk=SCLK, mosi=MOSI, miso=MISO)
    pn532.begin()
    pn532.SAM_configuration()

    print('Place the card to be written on the PN532...')
    uid = pn532.read_passive_target()
    while uid is None:
        uid = pn532.read_passive_target()
    print('')
    print('Found card with UID: 0x{0}'.format(binascii.hexlify(uid)))

    readid = str(binascii.hexlify(uid))
    userid1 = "bc0cba21"
    userid2 = "1217b5d5"
    if(readid == userid1):
        cur.execute("UPDATE user SET name = 'ahnjaesung' WHERE id = 1")
        cur.execute("UPDATE user SET birthday = '920608' WHERE id = 1")

        cur.execute("UPDATE user SET starthour = '00' WHERE id = 1")
        cur.execute("UPDATE user SET startmin = '00' WHERE id = 1")
        cur.execute("UPDATE user SET startsec = '00' WHERE id = 1")

        cur.execute("UPDATE user SET endhour = '00' WHERE id = 1")
        cur.execute("UPDATE user SET endmin = '00' WHERE id = 1")
        cur.execute("UPDATE user SET endsec = '00' WHERE id = 1")

        cur.execute("UPDATE user SET duration = '00' WHERE id = 1")
        
        db.commit()
        cur.close()
        db.close()

    elif(readid == userid2):
        cur.execute("UPDATE user SET name = 'kimsanghoon' WHERE id = 1")
        cur.execute("UPDATE user SET birthday = '930412' WHERE id = 1")
        
        cur.execute("UPDATE user SET starthour = '00' WHERE id = 1")
        cur.execute("UPDATE user SET startmin = '00' WHERE id = 1")
        cur.execute("UPDATE user SET startsec = '00' WHERE id = 1")

        cur.execute("UPDATE user SET endhour = '00' WHERE id = 1")
        cur.execute("UPDATE user SET endmin = '00' WHERE id = 1")
        cur.execute("UPDATE user SET endsec = '00' WHERE id = 1")

        cur.execute("UPDATE user SET duration = '00' WHERE id = 1")

        db.commit()
        cur.close()
        db.close()

    else:
        print str(binascii.hexlify(uid))
        print "world"
        print format(binascii.hexlify(uid))
