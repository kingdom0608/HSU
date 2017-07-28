#! /usr/bin/env python
# -*- coding: utf-8 -*-
import urllib
import mysql.connector
import RPi.GPIO as GPIO
import smbus
import sys
from PyQt4 import QtGui
from Ui_MainWindow import Ui_MainWindow
from OtherClass import OtherClass
from time import strftime
from PyQt4 import QtGui, QtCore
from multiprocessing import Process
import os
from switch import switch
import time
import binascii
import sys

import Adafruit_PN532 as PN532
GPIO.setmode(GPIO.BCM)
GPIO.setup(22, GPIO.IN)
sys.setrecursionlimit(100)

try:
    _fromUtf8 = QtCore.QString.fromUtf8
except AttributeError:
    def _fromUtf8(s):
        return s

try:
    _encoding = QtGui.QApplication.UnicodeUTF8
    def _translate(context, text, disambig):
        return QtGui.QApplication.translate(context, text, disambig, _encoding)
except AttributeError:
    def _translate(context, text, disambig):
        return QtGui.QApplication.translate(context, text, disambig)
j=0
g=0
s2 = 0
m2 = 0
h2 = 0

UID = ""
starttime = ""
endtime = ""
worktime = ""
workcount = ""
workdistance = ""
workcal = ""
cache = ""






a="http://glight.ueni.co.kr:7181/HCB_SERVICE/hcbService/setSportsAgent?param="+UID+";run;"+starttime+";"+endtime+";"+worktime+";"+workcount+";"+workdistance+";"+workcal+";"+cache

f = urllib.urlopen(a)



class MainWindow(QtGui.QMainWindow,Ui_MainWindow):
    
    
    def __init__(self):
        QtGui.QMainWindow.__init__(self)
        self.setupUi(self)
        #self.pushButton1.clicked.connect(self.myButtonSlot)
        self.lcd2 = QtGui.QLCDNumber(self)
        self.timer = QtCore.QTimer(self)
        self.timer.timeout.connect(self.Time2)
        self.lcd2.setGeometry(QtCore.QRect(547, 330, 100, 50))
        self.setStyleSheet("border: 0px solid black; color: white")
        #self.pushButton5.clicked.connect(self.callAnotherQMainWindow)
        self.otherclass = OtherClass(self)    
        self.otherclass.valueUpdated.connect(self.handleValueUpdated2)
        self.otherclass.valueUpdated.connect(self.handleValueUpdated3)
        self.otherclass.valueUpdated.connect(self.handleValueUpdated4)
        self.otherclass.valueUpdated.connect(self.handleValueUpdated5) 
        GPIO.add_event_detect(22, GPIO.FALLING, callback=self.myButtonSlot, bouncetime=5000)
        #self.pushButton4.clicked.connect(self.callAnotherQMainWindow)



    def Reset(self):
        global s2, m2, h2

        self.timer.stop()

        s2 = 0
        m2 = 0
        h2 = 0

        time = "{0}:{1}:{2}".format(h2,m2, s2)

        self.lcd2.setDigitCount(len(time))
        self.lcd2.display(time)

    def Start(self):
        global s2, m2, h2
        self.timer.start(1000)


    def Time2(self):
        global s2, m2, h2

        if s2 < 59:
            s2 += 1
        else:
            if m2 < 59:
                s2 = 0
                m2 += 1
            elif m2 == 59 and h2 < 24:
                h2 += 1
                m2 = 0
                s2 = 0
            else:
                self.timer.stop()

        time = "{0}:{1}:{2}".format(h2,m2, s2)

        self.lcd2.setDigitCount(len(time))
        self.lcd2.display(time)
 
    def hello(self,channel):
        print 'hihi'

    def callAnotherQMainWindow(self):
        self.dialog_02 = switch(self)
        self.dialog_02.show()
        self.hide()
        
    def myButtonSlot(self,channel):
       print '1111111111111111'
       global j
       global g
        #print '11111111111'
       # if (j==0 and value==0):
       
       while True:
            if(GPIO.input(22)==1 and GPIO.input(22)==1):
                j=1
                break
            elif (GPIO.input(22)==0 and GPIO.input(22)==0):
                global s2, m2, h2
                g=0
                self.timer.stop()

                s2 = 0
                m2 = 0
                h2 = 0

                time = "{0}:{1}:{2}".format(h2,m2, s2)

                self.lcd2.setDigitCount(len(time))
                self.lcd2.display(time)
       if j==1 and g==0:
           
           j=0
           g=1
           s2 = 0
           m2 = 0
           h2 = 0

           time = "{0}:{1}:{2}".format(h2,m2, s2)

           self.lcd2.setDigitCount(len(time))
           self.lcd2.display(time)
           self.timer.start(1000)
           self.otherclass.method()
           
       # elif (j==1 and value>0):
       #     self.otherclass.method()
        

    def handleValueUpdated(self, value):
        self.progressBar.setValue(value)
        QtGui.qApp.processEvents()

    def handleValueUpdated2(self, value):
      
        self.count.setText(QtGui.QApplication.translate("MainWindow", str(value), None, QtGui.QApplication.UnicodeUTF8))
        QtGui.qApp.processEvents()      

    def handleValueUpdated3(self, value):
        self.kcal.setText(QtGui.QApplication.translate("MainWindow", str(value*0.06), None, QtGui.QApplication.UnicodeUTF8))
        QtGui.qApp.processEvents()

    def handleValueUpdated4(self, value):
        self.distance.setText(QtGui.QApplication.translate("MainWindow", str(round(value*0.36,2)) , None, QtGui.QApplication.UnicodeUTF8))
        QtGui.qApp.processEvents()

    def handleValueUpdated5(self, value):
        self.cache.setText(QtGui.QApplication.translate("MainWindow", str(int(value*0.1)) , None, QtGui.QApplication.UnicodeUTF8))
        QtGui.qApp.processEvents()

def main():
    
    app = QtGui.QApplication(sys.argv)
    window = MainWindow()
    window.show()
    sys.exit(app.exec_())

if __name__ == '__main__':
    main()


