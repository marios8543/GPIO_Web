# GPIO_Web
An API for controlling the Raspberry Pi GPIO pins written in PHP (Python version also available)

## Dependencies:
For the PHP version:
1. Apache2 w/ PHP modules
2. WiringPi
For the Python version:
1. Python3
2. Flask

## Usage:
The script accepts a GET request with the following parameters
1. Action
- Write (Writes a pin)
- State (Gets the state of a pin in write mode)
- Read (Reads the input of a pin)

2. State
- Can be 1 or 0 (PHP)
- In the python version it can also be pullup or pulldown in read mode

3. Pin
- Can be any of the raspberry pi pins accessible by Wiring Pi
(So pretty much all of them)  
Note: In both APIs use the board pin numbering not bcm

## Examples:

###### Writing a pin
` http://*IP_Address*/gpio_web.php?action=write&pin=08&state=1 `

###### Getting the state of a pin in write mode:
` http://*IP_Address*/gpio_web.php?action=state&pin=08 `

###### Reading an input pin:
` http://*IP_Address*/gpio_web.php?action=read&pin=08 `

Similar syntax in python but use ` http://*IP_Address*/gpio_web? ` instead  
The script will return a json-formatted result on a successful request or an error.
