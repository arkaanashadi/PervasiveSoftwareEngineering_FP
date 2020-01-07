import RPi.GPIO as GPIO
import time
import ultrasonic as usonic
import camera as cam
import relay
from gcp import upload_blob

GPIO.setmode(GPIO.BOARD)

Laser = 15
Trig  = 11
Trig2 = 13
Echo  = 3
Echo2 = 5
Relay = 7

GPIO.setup(Laser, GPIO.IN)
GPIO.setup(Trig, GPIO.OUT)
GPIO.setup(Trig2, GPIO.OUT)
GPIO.setup(Echo, GPIO.IN)
GPIO.setup(Echo2, GPIO.IN)
GPIO.setup(Relay, GPIO.OUT)

bucket_name = "pse-oit-mailbox"

def main():
    if GPIO.input(Laser) == False:
        print("Laser Detected")
        time.sleep(3)
        measure1 = (usonic.measure(Trig, Echo)/30)*100
        measure2 = (usonic.measure(Trig2, Echo2)/30)*100
        print(measure1, measure2)
	#with open(measure.txt,'w') as capacity:
       	#	capacity.write(str(measure1))
        cur_time = str(time.time())
        img_name = str(cur_time)+".jpg"
        print(img_name)
        relay.relay(Relay, 0)
        cam.camera_take(img_name)
        time.sleep(1)
        relay.relay(Relay, 1)
        upload_blob(bucket_name, img_name, img_name)

if __name__ == "__main__":
    while(True):
        try:
            main()
        except(KeyboardInterupt):
            GPIO.cleanup()
            break

