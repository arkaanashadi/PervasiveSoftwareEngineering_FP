import RPi.GPIO as GPIO
import time

if __name__ == "__main__":
    pin = 11
    GPIO.setmode(GPIO.BOARD)
    GPIO.setup(pin, GPIO.OUT)

def relay(pin, state):
    if state == 1:
        GPIO.output(pin, 1)
    elif state == 0:
        GPIO.output(pin, 0)
