try:
    import RPi.GPIO as GPIO
    GPIO.setwarnings(False)
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(6,GPIO.OUT)
    GPIO.output(6,0)
    GPIO.setup(13,GPIO.OUT)
    GPIO.output(13,0)
    GPIO.setup(26,GPIO.OUT)
    GPIO.output(26,0)
    GPIO.setup(17,GPIO.OUT)
    GPIO.output(17,0)
except RuntimeError:
    print("Error importing RPi.GPIO!  This is probably because you need superuser privileges.  You can achieve this by using 'sudo' to run your script")
