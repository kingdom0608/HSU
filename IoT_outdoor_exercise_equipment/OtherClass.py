import sys
import mysql.connector
from PyQt4 import QtCore
import time  
import RPi.GPIO as GPIO
import smbus
import pygame
import subprocess
import urllib
import time
import datetime
import binascii
import sys
import Adafruit_PN532 as PN532




now = time.localtime()
pygame.init()
sound1 = pygame.mixer.Sound("/home/pi/Coex/sound/01.wav")
sound8 = pygame.mixer.Sound("/home/pi/Coex/sound/08.wav")

GPIO.setmode(GPIO.BCM)
GPIO.setup(22, GPIO.IN)

today = datetime.datetime.today()
to = today.strftime('%y%m%d%H%M%S')

UID = ""
starttime = ""
endtime = ""
worktime = ""
workcount = ""
workdistance = ""
workcal = ""
cache = ""


class OtherClass(QtCore.QObject):
    valueUpdated = QtCore.pyqtSignal(int)
    
    def method(self):
        print '2222222222222222'
        def RCtime (RCpin):  
            reading = 0  
            GPIO.setup(RCpin, GPIO.IN)
            while (GPIO.input(RCpin) == GPIO.LOW):  
                reading += 1
                self.valueUpdated.emit(i)
                print reading
            return reading
                
            
        i=0
        g=0
        count =100
        global workcount
        global UID
        global starttime
        global endtime
        global worktime
        global workcount
        global workdistance
        global workcal
        global cache
        today = datetime.datetime.today()
        startmin = datetime.datetime.today().min
        starttime = today.strftime('20%y%m%d%H%M%S')
        now = time.localtime()
        startminute = int(now.tm_min)
        startsec = int(now.tm_sec)
        #####NFC CODE
        
######
        while True:
            

            if(GPIO.input(22)==GPIO.HIGH and g==0):
                
                print '3333333333333333333'
                pygame.mixer.Sound.play(sound1)
                self.valueUpdated.emit(i)
                g=1
                continue
            elif(count>=0):
                if (RCtime(23)>1):
                    count=100
                    print '4444444444444444444'
                    i=i+1
                    workcount= i
                    self.valueUpdated.emit(i)
                elif (GPIO.input(22)==GPIO.LOW and count>=1):
                        count-=1
                        self.valueUpdated.emit(i)
                        print count
                        
                elif(GPIO.input(22)==GPIO.HIGH and count>=0):
                    self.valueUpdated.emit(i)
                    count+=1
                    print count
                
                elif(GPIO.input(22)==GPIO.LOW and count<=0):
                            now = time.localtime()
                            endminute = int(now.tm_min)
                            endsec = int(now.tm_sec)
                            today = datetime.datetime.today()
                            endtime = today.strftime('20%y%m%d%H%M%S')
                            worktime = str(int(endminute-startminute)*60+int(endsec-startsec))
                           # endtime = year+month+day+hour+minute+sec
                            cache = str(int(int(workcount)*0.1))
                            workdistance = str(int(int(workcount)*0.36))
                            workcal = str(int(int(workcount)*0.06))
                            workcount = str(i)
                            while True:
                                CS   = 18
                                MOSI = 20 #23
                                MISO = 24
                                SCLK = 25
                                pn532 = PN532.PN532(cs=CS, sclk=SCLK, mosi=MOSI, miso=MISO)
                                pn532.begin()
                                ic, ver, rev, support = pn532.get_firmware_version()
                                print('Found PN532 with firmware version: {0}.{1}'.format(ver, rev))
                                pn532.SAM_configuration()
                                
                                uid = pn532.read_passive_target()
                                # Try again if no card is available.
                                if uid is None:
                                        continue
                                        print('Found card with UID: 0x{0}'.format(binascii.hexlify(uid)))
                            # Authenticate block 4 for reading with default key (0xFFFFFFFFFFFF).
                                if not pn532.mifare_classic_authenticate_block(uid, 4, PN532.MIFARE_CMD_AUTH_B,
                                                                           [0xFF, 0xFF, 0xFF, 0xFF, 0xFF, 0xFF]):
                                        print('Failed to authenticate block 4!')
                                        continue
                            # Read block 4 data.
                                data = pn532.mifare_classic_read_block(4)
                                if data is None:
                                        print('Failed to read block 4!')
                                        continue
                                    # Note that 16 bytes are returned, so only show the first 4 bytes for the block.
                                print int(format(binascii.hexlify(data[:4])))
                                UID = str(int(format(binascii.hexlify(data[:4]))))
                                print('Read block 4: 0x{0}'.format(binascii.hexlify(data[:4])))
                                break
                                
                            pygame.mixer.Sound.play(sound8)
                            count =100
                            a="http://glight.ueni.co.kr:7181/HCB_SERVICE/hcbService/setSportsAgent?param="+UID+";run;"+starttime+";"+endtime+";"+worktime+";"+workcount+";"+workdistance+";"+workcal+";"+cache
                            f = urllib.urlopen(a)
                            break
                    
            
                    #if(GPIO.input(22)==0):
                        #cnx = mysql.connector.connect(user='vision406', password='hansung!@',  host='vision406.cafe24.com', database='vision406')
                        #cursor = cnx.cursor()
                        #cursor.execute("UPDATE guest SET count=%s WHERE id = 1" %(i))
                        #cursor.execute("UPDATE guest SET distance=%s WHERE id = 1" %(i*3.14*0.5))
                        #cursor.execute("UPDATE guest SET kcal=%s WHERE id = 1" %(i*0.12))
                        #cnx.commit()
                        #cursor.close()
                        #cnx.close()
                        #self.valueUpdated.emit(i)
                    
                    
                #else :
                 #   print '555555555555555555555'
                  #  self.valueUpdated.emit(i)
                 
                
         
        
            


         
            
            



