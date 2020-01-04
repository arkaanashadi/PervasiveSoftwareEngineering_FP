import RPi.GPIO as GPIO
import time
import ultrasonic as usonic
#import camera as cam
from gcp import upload_blob

GPIO.setmode(GPIO.BOARD)

Laser = 7
Trig = 3
Echo = 5

GPIO.setup(Laser, GPIO.IN)
GPIO.setup(Trig, GPIO.OUT)
GPIO.setup(Echo, GPIO.IN)

def main():
    if GPIO.input(Laser) == True:
        print("Laser Detected")
        time.sleep(3)
        print(usonic.measure(Trig, Echo))
        print(time.time())
        #cam.camera_take(1)
        #upload_blob()
        time.sleep(1)

if __name__ == "__main__":
    while(True):
        try:
            main()
        except(KeyboardInterupt):
            GPIO.cleanup()
            break
