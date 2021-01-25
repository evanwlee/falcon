import RPi.GPIO as GPIO
from time import sleep
GPIO.setmode(GPIO.BCM)

GPIO.setup(17,GPIO.OUT)
GPIO.setup(26,GPIO.OUT)
GPIO.setup(13,GPIO.OUT)
GPIO.setup(6,GPIO.OUT)
try:
        while True:
             	GPIO.output(6,0)
                print "6=0"
                sleep(1)
                GPIO.output(6,1)
                print "6=1"
                sleep(1)
                GPIO.output(6,0)
                print "6=0"
                sleep(1)
                GPIO.output(6,1)
                print "6=1"
                sleep(1)
		GPIO.output(13,0)
                print "13=0"
                sleep(1)
                GPIO.output(13,1)
                print "13=1"
                sleep(1)
                GPIO.output(13,0)
                print "13=0"
                sleep(1)
                GPIO.output(13,1)
                print "13=1"
                sleep(1)
                GPIO.output(26,0)
                print "26=0"
                sleep(1)
                GPIO.output(26,1)
                print "26=1"
                sleep(1)
                GPIO.output(26,0)
                print "26=0"
                sleep(1)
                GPIO.output(26,1)
                print "26=1"
                sleep(1)
                GPIO.output(17,0)
                print "17=0"
                sleep(1)
                GPIO.output(17,1)
                print "17=1"
                sleep(1)
                GPIO.output(17,0)
                print "17=0"
                sleep(1)
                GPIO.output(17,1)
                print "17=1"
                sleep(1)
		GPIO.output(6,0)
		sleep(.25)
		GPIO.output(13,0)
		sleep(.25)
		GPIO.output(26,0)
		sleep(.25)
		GPIO.output(17,0)
		sleep(5)   
                GPIO.output(17,1)
		sleep(.25)
		GPIO.output(26,1)
		sleep(.25)
		GPIO.output(13,1)
		sleep(.25)
		GPIO.output(6,1)
		sleep(5) 

except KeyboardInterrupt:
        GPIO.cleanup()
