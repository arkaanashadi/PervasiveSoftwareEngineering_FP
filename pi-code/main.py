import RPi.GPIO as GPIO
import datetime
import time
import ultrasonic as usonic
import camera as cam
import relay
from gcp import upload_blob
import json
import os
os.environ["GOOGLE_APPLICATION_CREDENTIALS"] = "mailbox-api-key.json"

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
image_save_dir = "Mailbox-Images/"

def main():
    if GPIO.input(Laser) == False:
        print("Laser Detected")
        time.sleep(3)
        measure1 = usonic.measure(Trig, Echo)
        measure2 = usonic.measure(Trig2, Echo2)
        print(measure1, measure2)

        date = datetime.datetime.now()
        cur_date = str(date.strftime("%Y-%m-%d"))
        cur_time = str(date.strftime("%H:%M:%S"))
        img_name = "{0} {1}.jpg".format(cur_date, cur_time)
        m1 = ( measure1 / 32)*100
        m2 = ( measure2 / 26)*100
        avg = int((m1+m2)/2)

        json_data = {
        "latest":{
            "file":str(cur_date+"/"+img_name),
            "date":cur_date, 
            "time":cur_time
            },
        "measure1":m1,
        "measure2":m2,
        "avg":avg
        }

        with open("data.json",'w') as json_out:
            json.dump(json_data, json_out)
        json_out.close()

        print(img_name)
        relay.relay(Relay, 0)
        cam.camera_take(image_save_dir+img_name)
        time.sleep(1)
        relay.relay(Relay, 1)
        upload_blob(bucket_name, "data.json", "data.json")
        upload_blob(bucket_name, image_save_dir+img_name, str(image_save_dir+cur_date+"/"+img_name))

if __name__ == "__main__":
    while(True):
        try:
            main()
        except KeyboardInterrupt:
            GPIO.cleanup()
            break

