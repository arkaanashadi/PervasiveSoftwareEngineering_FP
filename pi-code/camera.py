from picamera import PiCamera
import time
camera = PiCamera()

def camera_take(rotation = 180):
	camera.rotation = rotation
        name = str(time.time())+'.jpg'
	camera.start_preview()
	time.sleep(5)
	camera.capture(name)
	camera.stop_preview()
        print(name)
