import io
import os
import time
import random
import picamera
from PIL import Image
import numpy as np 
import smtplib
from email.MIMEMultipart import MIMEMultipart
from email.MIMEText import MIMEText
from email.MIMEImage import MIMEImage
from email.MIMEBase import MIMEBase
from email import Encoders


prior_image = None
width = 640
height = 480
threshold = 30
minPixelsChanged = width * height * 4 / 100

def detect_motion(camera):
    step = 1
    numImages = 1
    captureCount = 0
    global prior_image
    stream = io.BytesIO()

    stream.seek(0)
    camera.capture(stream, 'rgba',True) # use video port for high speed
    data1 = np.fromstring(stream.getvalue(), dtype=np.uint8)

    #time.sleep(1)
    
    stream.seek(0)
    camera.capture(stream, 'rgba',True)
    data2 = np.fromstring(stream.getvalue(), dtype=np.uint8)

    data3 = np.abs(data1 - data2)
    numTriggers = np.count_nonzero(data3 > threshold) / 4 / threshold

    print numTriggers
    if numTriggers > minPixelsChanged:
        captureCount = 1
        return captureCount

with picamera.PiCamera() as camera:
    camera.resolution = (1280, 720)
    stream = picamera.PiCameraCircularIO(camera, seconds=10)
    camera.start_recording(stream, format='h264')
    try:
        while True:
            camera.wait_recording(1)
            if detect_motion(camera):
                print('Motion detected!')
                camera.capture('/home/pi/RPiPetFeeder/static/image.png')
                camera.capture('/home/pi/Desktop/complete/NAS/image.png')
                #time.sleep(0.3)
                #camera.capture('/home/pi/Desktop/complete/NAS/image1.png')
                #time.sleep(0.3)
                #camera.capture('/home/pi/Desktop/complete/NAS/image2.png')
                #Set up crap for the attachments
                files = "NAS"
                filenames = [os.path.join(files, f) for f in os.listdir(files)]
                #print filenames
                #Set up users for email
                gmail_user = "kingdom0608@gmail.com"
                gmail_pwd = "ajs141749"
                recipients = ['kingdom0608@gmail.com']

                Create Module
                def mail(to, subject, text, attach):
                   msg = MIMEMultipart()
                   msg['From'] = gmail_user
                   msg['To'] = ", ".join(recipients)
                   msg['Subject'] = subject

                   msg.attach(MIMEText(text))

                   get all the attachments
                   for file in filenames:
                      part = MIMEBase('application', 'octet-stream')
                      part.set_payload(open(file, 'rb').read())
                      Encoders.encode_base64(part)
                      part.add_header('Content-Disposition', 'attachment; filename="%s"' % file)
                      msg.attach(part)

                   mailServer = smtplib.SMTP("smtp.gmail.com", 587)
                   mailServer.ehlo()
                   mailServer.starttls()
                   mailServer.ehlo()
                   mailServer.login("kingdom0608@gmail.com", "ajs141749")
                   mailServer.sendmail(gmail_user, to, msg.as_string())
                    #Should be mailServer.quit(), but that crashes...
                   mailServer.close()

                send it
                mail(recipients,
                   "Motion Detection",
                   "The current motion has occurred.",
                   "/home/pi/Desktop/complete/NAS")
          
                print('Motion stopped!')
                camera.split_recording(stream)
                
    finally:
        camera.stop_recording()
