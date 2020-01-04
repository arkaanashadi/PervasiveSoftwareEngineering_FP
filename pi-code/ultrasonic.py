import RPi.GPIO as GPIO
import time

def measure(Trig, Echo):
    GPIO.output(Trig, True)
    time.sleep(0.0001)
    GPIO.output(Trig, False)

    while GPIO.input(Echo) == False:
        start = time.time()

    while GPIO.input(Echo) == True:
        end = time.time()

    sig_time = end-start

    # cm:
    distance = sig_time / 0.000058 # inches: 0.000148

    return distance
