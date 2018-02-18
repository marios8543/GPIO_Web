import flask
from flask import Flask
from flask import request
import RPi.GPIO as GPIO
app = Flask(__name__)
GPIO.setmode(GPIO.BOARD)


@app.route('/gpio_web', methods=['GET'])
def gpio_web():
  action = request.args['action']
  pin = int(request.args['pin'])
  state = request.args['state']
  print('Action: '+action)
  print('Pin: '+str(pin))
  print('State: '+str(state))
  if not (state == '1' or state == '0' or state == 'pullup' or state == 'pulldown'):
     return 'Invalid state '+str(state)
  if action == 'write':
     GPIO.setup(pin, GPIO.OUT)
     res = GPIO.output(pin, int(state)) 
     data = {'action':'write','pin':pin,'state':state,'result':res}
     data = flask.jsonify(data)
     return data
  if action == 'read':
     if state == 'pullup':
        GPIO.setup(pin, GPIO.IN, pull_up_down=GPIO.PUD_UP)
     if state == 'pulldown':
        GPIO.setup(pin, GPIO.IN, pull_up_down=GPIO.PUD_DOWN)
     else:
        GPIO.setup(pin, GPIO.IN)
     res = GPIO.input(pin)
     data = {'action':'read','pin':pin,'state':res,'result':res}
     data = flask.jsonify(data)
     return data
  if action == 'state':
     res = GPIO.input(pin)
     data = {'action':'state','pin':pin,'state':res,'result':res}
  else:
     return 'Invalid action'


app.run(debug=True,host='192.168.1.5',port=5000)


