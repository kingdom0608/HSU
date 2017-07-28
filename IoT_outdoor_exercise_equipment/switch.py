
# -*- coding: utf-8 -*-
from PyQt4 import QtGui, QtCore

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


class switch(QtGui.QMainWindow):
    def __init__(self, parent):

        super(switch, self).__init__(parent)
        # ensure this window gets garbage-collected when closed
        #self.setAttribute(QtCore.Qt.WA_DeleteOnClose)

        self.SWindow = QtGui.QWidget()
        pic = QtGui.QLabel(self.SWindow)
        pic.setGeometry(0, 0, 1360, 768)
        # use full ABSOLUTE path to the image, not relative
        pic.setPixmap(QtGui.QPixmap("/home/pi/Downloads/03_ranking.png"))

        self.SWindow.setGeometry(QtCore.QRect(0,0,1360,768))
        self.Button_02 = QtGui.QPushButton(self.SWindow)
        self.Button_02.setGeometry(1000, 600, 30, 30)
        self.Button_02.clicked.connect(self.closeAndReturn)




        self.SWindow.setFixedSize(1360, 768)
        self.setCentralWidget(self.SWindow)
        self.setWindowTitle('Dialog 02')

    def setupUi(self, MainWindow2):
        MainWindow2.setObjectName(_fromUtf8("Dialog"))
        MainWindow2.resize(1360, 768)
        self.pushButton1 = QtGui.QPushButton(MainWindow2)
        self.pushButton1.setGeometry(QtCore.QRect(1000, 500, 100, 101))
        font = QtGui.QFont()
        font.setPointSize(30)
        self.pushButton1.setFont(font)
        self.pushButton1.setObjectName(_fromUtf8("pushButton1"))
        self.retranslateUi(MainWindow2)
        QtCore.QMetaObject.connectSlotsByName(MainWindow2)

    def retranslateUi(self, MainWindow2):
        MainWindow2.setWindowTitle(
            QtGui.QApplication.translate("MainWindow2", "MainWindow2", None, QtGui.QApplication.UnicodeUTF8))
        self.pushButton1.setText(QtGui.QApplication.translate("MainWindow", "전환", None, QtGui.QApplication.UnicodeUTF8))
    def closeAndReturn(self):
        self.close()
        self.parent().show()
