import serial
import webbrowser as wb

def connect(com, baud):
    ser = serial.Serial(com, baud, timeout=0)
    return ser

def initialize():
    lst = []
    suffix = ""
    return lst, suffix 

def loop(lst, suffix, ser):
    while True:
        data = ser.read()
        if data:
            lst.append(data)
            if lst[-1] == b'\n':
                for i in str(lst):
                   suffix = suffix + i
                whitelist = set('1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ|.-')
                suffix = ''.join(filter(whitelist.__contains__, suffix))
                if len(suffix.split("|")) == 5:
                    url = 'http://omagarwal.net/acdn/arduino.php?q=' + suffix
                    wb.open(url)
                    print(url)
                lst, suffix = initialize()
            
if __name__ == '__main__':
    
    com = 'COM3' # EDIT THIS
    baud = 9600 # EDIT THIS
    
    ser = connect(com, baud)
    lst, suffix = initialize()
    loop(lst, suffix, ser)