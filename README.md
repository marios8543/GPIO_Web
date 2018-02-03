# GPIO_Web
An API for controlling the Raspberry Pi GPIO pins written in PHP

## Dependencies:
1. Apache2 w/ PHP modules
2. WiringPi

## Usage:
The script accepts a GET request with the following parameters
1. Action
- Write (Writes a pin)
- State (Gets the state of a pin in write mode)
- Read (Reads the input of a pin)

2. State (Write only)
- Can be 1 or 0

3. Pin
- Can be any of the raspberry pi pins accessible by Wiring Pi
(So pretty much all of them)


## Examples:

###### Writing a pin
` http://*IP_Address*/gpio_web.php?action=write&pin=08&state=1 `

###### Getting the state of a pin in write mode:
` http://*IP_Address*/gpio_web.php?action=state&pin=08 `

###### Reading an input pin:
` http://*IP_Address*/gpio_web.php?action=read&pin=08 `

The script will return a json-formatted result on a successful request or an error.
