from picamera import PiCamera
import time
camera = PiCamera()

def camera_take(name, rotation = 180):
    camera.rotation = rotation
    name = name
    camera.start_preview()
    time.sleep(5)
    camera.capture(name)
    camera.stop_preview()
    print(name)

if __name__ == "__main__":
    camera_take()