import RPi.GPIO as GPIO
from time import sleep
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)
GPIO.setup(6,GPIO.OUT)
GPIO.output(6,1)
GPIO.setup(13,GPIO.OUT)
GPIO.output(13,1)
GPIO.setup(26,GPIO.OUT)
GPIO.output(26,1)
GPIO.setup(17,GPIO.OUT)
GPIO.output(17,1)
