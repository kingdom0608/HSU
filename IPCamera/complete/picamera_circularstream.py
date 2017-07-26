import io
import os
import time
import random
import picamera
from PIL import Image
import numpy as np
import smtplib
from email.mime.text import MIMEText

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
                camera.capture('/home/pi/Desktop/complete/NAS/image.png')
                # As soon as we detect motion, split the recording to
                # record the frames "after" motion
                dtFileStr2 = time.strftime("motionafter.h264")
                camera.split_recording(dtFileStr2)
                # Write the 10 seconds "before" motion to disk as well
                dtFileStr1 = time.strftime("motionbefore.h264")
                stream.copy_to(dtFileStr1, seconds=10)
                stream.clear()
                # Wait until motion is no longer detected, then split
                # recording back to the in-memory circular buffer
                while detect_motion(camera):
                    camera.wait_recording(1)
                print('Motion stopped!')
                camera.split_recording(stream)
                
    finally:
        camera.stop_recording()
