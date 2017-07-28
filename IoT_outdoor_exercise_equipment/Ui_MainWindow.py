# -*- coding: utf-8 -*-
from OtherClass import OtherClass
import sys
from time import strftime
from PyQt4 import QtCore, QtGui
from PyQt4.phonon import Phonon
from PyQt4.QtGui import *
from PyQt4.QtCore import *
import time
now = time.localtime()



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

var = True




class Ui_MainWindow(object):




    def myButtonSlot(self):
        objVar = OtherClass()

        objVar.method()


    def myButtonStop(self):
        objVar = OtherClass2()
        objVar.method2()


    def Time(self):
        global var4
        if var == True:
                 self.lcd.display(QTime.currentTime().toString(QString("hh mm")))

    

    def setupUi(self, MainWindow):
        MainWindow.setObjectName(_fromUtf8("Dialog"))
        MainWindow.resize(1360, 768)
        MainWindow.setWindowFlags(QtCore.Qt.CustomizeWindowHint)
        pic = QtGui.QLabel(MainWindow)
        pic.setGeometry(0, 0, 1360, 768)
        # use full ABSOLUTE path to the image, not relative
        pic.setPixmap(QtGui.QPixmap("/home/pi/Downloads/02_running_1.png"))

        pic1 = QtGui.QLabel(MainWindow)
        pic1.setGeometry(1200, 5, 37, 37)
        # use full ABSOLUTE path to the image, not relative
        pic1.setPixmap(QtGui.QPixmap("/home/pi/Downloads/AA.png"))
        self.timer2 = QtCore.QTimer(self)
        self.timer2.timeout.connect(self.Time)
        self.timer2.start(10)
        self.lcd = QtGui.QLCDNumber(self)
        self.lcd.setDigitCount(6)

        self.lcd.setGeometry(QtCore.QRect(1082, 5, 100, 40))
        self.lcd.setStyleSheet('color: white')

        #self.lcd.display(strftime("%H" + ":" + "%M" + ":" + "%S"))






        #self.pushButton4 = QtGui.QPushButton(MainWindow)
        #self.pushButton4.setGeometry(QtCore.QRect(1200, 600, 50, 50))
        #font = QtGui.QFont()
        #font.setPointSize(30)
        #self.pushButton4.setFont(font)
        #self.pushButton4.setObjectName(_fromUtf8("pushButton4"))



        self.count = QtGui.QLabel(MainWindow)
        self.count.setGeometry(QtCore.QRect(450, 120, 200, 100))
        font = QtGui.QFont()
        font.setPointSize(34)
        self.count.setFont(font)
        self.count.setObjectName(_fromUtf8("count"))
        self.count.setStyleSheet('color: white')
        self.count.setAlignment(QtCore.Qt.AlignRight)


        self.kcal = QtGui.QLabel(MainWindow)
        self.kcal.setGeometry(QtCore.QRect(350, 425, 300, 71))
        font = QtGui.QFont()
        font.setPointSize(34)
        self.kcal.setFont(font)
        self.kcal.setObjectName(_fromUtf8("kcal"))
        self.kcal.setStyleSheet('color: white')
        self.kcal.setAlignment(QtCore.Qt.AlignRight)


      #  self.label3 = QtGui.QLabel(MainWindow)
      #  self.label3.setGeometry(QtCore.QRect(580, 319, 300, 71))
       # font = QtGui.QFont()
       # font.setPointSize(34)
       # self.label3.setFont(font)
       # self.label3.setObjectName(_fromUtf8("label3"))
       # self.label3.setStyleSheet('color: white')

        self.distance = QtGui.QLabel(MainWindow)
        self.distance.setGeometry(QtCore.QRect(450, 223, 200, 71))
        font = QtGui.QFont()
        font.setPointSize(34)
        self.distance.setFont(font)
        self.distance.setObjectName(_fromUtf8("label3"))
        self.distance.setStyleSheet('color: white')
        self.distance.setAlignment(QtCore.Qt.AlignRight)

        self.cache = QtGui.QLabel(MainWindow)
        self.cache.setGeometry(QtCore.QRect(450, 522, 200, 100))
        font = QtGui.QFont()
        font.setPointSize(34)
        self.cache.setFont(font)
        self.cache.setObjectName(_fromUtf8("cache"))
        self.cache.setStyleSheet('color: white')
        self.cache.setAlignment(QtCore.Qt.AlignRight)


        self.year = QtGui.QLabel(MainWindow)
        self.year.setGeometry(QtCore.QRect(775, 10, 110, 30))
        font = QtGui.QFont()
        font.setPointSize(20)
        self.year.setFont(font)
        self.year.setObjectName(_fromUtf8("year"))
        self.year.setStyleSheet('color: white')
        #self.year.setAlignment(QtCore.Qt.AlignRight)

        self.month = QtGui.QLabel(MainWindow)
        self.month.setGeometry(QtCore.QRect(895, 10, 110, 30))
        font = QtGui.QFont()
        font.setPointSize(20)
        self.month.setFont(font)
        self.month.setObjectName(_fromUtf8("month"))
        self.month.setStyleSheet('color: white')
        #self.year.setAlignment(QtCore.Qt.AlignRight)

        self.day = QtGui.QLabel(MainWindow)
        self.day.setGeometry(QtCore.QRect(985, 10, 110, 30))
        font = QtGui.QFont()
        font.setPointSize(20)
        self.day.setFont(font)
        self.day.setObjectName(_fromUtf8("day"))
        self.day.setStyleSheet('color: white')

        self.weather = QtGui.QLabel(MainWindow)
        self.weather.setGeometry(QtCore.QRect(1260, 10, 110, 30))
        font = QtGui.QFont()
        font.setPointSize(15)
        self.weather.setFont(font)
        self.weather.setObjectName(_fromUtf8("weather"))
        self.weather.setStyleSheet('color: white')

       




     #   self.label5 = QtGui.QLabel(MainWindow)
       # self.label5.setGeometry(QtCore.QRect(310, 440, 231, 51))
      #  font = QtGui.QFont()
      #  font.setPointSize(20)
      #  self.label5.setFont(font)
      #  self.label5.setObjectName(_fromUtf8("label5"))




        self.retranslateUi(MainWindow)
        QtCore.QMetaObject.connectSlotsByName(MainWindow)




    def retranslateUi(self, MainWindow):
        year = str(now.tm_year)
        month = str(now.tm_mon)
        day = str(now.tm_mday)
        MainWindow.setWindowTitle(
         QtGui.QApplication.translate("MainWindow", "MainWindow", None, QtGui.QApplication.UnicodeUTF8))
        self.count.setText(QtGui.QApplication.translate("MainWindow", "000", None, QtGui.QApplication.UnicodeUTF8))
        self.kcal.setText(QtGui.QApplication.translate("MainWindow", "000", None, QtGui.QApplication.UnicodeUTF8))
       # self.label3.setText(QtGui.QApplication.translate("MainWindow", "0", None, QtGui.QApplication.UnicodeUTF8))
        self.distance.setText(QtGui.QApplication.translate("MainWindow", "000", None, QtGui.QApplication.UnicodeUTF8))
        self.cache.setText(QtGui.QApplication.translate("MainWindow", "000", None, QtGui.QApplication.UnicodeUTF8))
        self.year.setText(QtGui.QApplication.translate("MainWindow", year, None, QtGui.QApplication.UnicodeUTF8))
        self.month.setText(QtGui.QApplication.translate("MainWindow", month, None, QtGui.QApplication.UnicodeUTF8))
        self.day.setText(QtGui.QApplication.translate("MainWindow", day, None, QtGui.QApplication.UnicodeUTF8))
        self.weather.setText(QtGui.QApplication.translate("MainWindow", "21", None, QtGui.QApplication.UnicodeUTF8))

      #  self.label5.setText(QtGui.QApplication.translate("MainWindow", "스탑워치", None, QtGui.QApplication.UnicodeUTF8))
        #self.pushButton1.setText(QtGui.QApplication.translate("MainWindow", "전환", None, QtGui.QApplication.UnicodeUTF8))

       #self.pushButton4.setText(QtGui.QApplication.translate("MainWindow", "멈추기", None, QtGui.QApplication.UnicodeUTF8))


"""
        #스탑워치
    app = QtGui.QApplication(sys.argv)
    vp = Phonon.VideoPlayer()
    vp.show()
    media = Phonon.MediaSource('C:\\uplus.wmv')
    vp.load(media)
    vp.play()
    sys.exit(app.exec_())



        centralwidget = QtGui.QWidget(self)

        self.lcd = QtGui.QLCDNumber(self)

        self.timer = QtCore.QTimer(self)
        self.timer.timeout.connect(self.Time)

        self.start = QtGui.QPushButton("Start", self)
        self.start.clicked.connect(self.Start)

        self.stop = QtGui.QPushButton("Stop", self)
        self.stop.clicked.connect(lambda: self.timer.stop())

        self.reset = QtGui.QPushButton("Reset", self)
        self.reset.clicked.connect(self.Reset)

        grid = QtGui.QGridLayout()

        grid.addWidget(self.start, 1, 0)
        grid.addWidget(self.stop, 1, 1)
        grid.addWidget(self.reset, 1, 2)
        grid.addWidget(self.lcd, 2, 0, 1, 3)

        centralwidget.setLayout(grid)
        self.lcd.setGeometry(100, 100, 280, 170)
        self.setCentralWidget(centralwidget)
"""





