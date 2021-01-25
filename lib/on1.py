try:
    import RPi.GPIO as GPIO
    print "HElllllllLLOOOO"
    GPIO.setwarnings(False)
    print "HElllllllLLOOOO" 
    GPIO.setmode(GPIO.BCM)
    print "HElllllllLLOOOO"
    GPIO.setup(6,GPIO.OUT)
    print "NOW"
    GPIO.output(6,0)
    print "Done"
except RuntimeError:
    print("Error importing RPi.GPIO!  This is probably because you need superuser privileges.  You can achieve this by using 'sudo' to run your script")
