import RPi.GPIO as GPIO

Laser = 15
GPIO.setmode(GPIO.BOARD)
GPIO.setup(Laser, GPIO.IN)

while True:
    print(GPIO.input(Laser))
