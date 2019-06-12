import re, serial, webbrowser as wb, calendar
from twilio.rest import Client

def connect(com, baud):
    ser = serial.Serial(com, baud, timeout=0)
    return ser

def geo(l):
    if list(l).count("0") >= 5:
        return "0.00000"
    else:
        d, m, s = int("".join(list(l)[0:2])), float("".join(list(l)[2:7])), int("".join(list(l)[7:9]))
        dd = str(d + float(m)/60 + float(s)/3600)
        if list(l)[-1] == 'W' or list(l)[-1] == 'S': 
            dd = "-" + dd
        return dd

def sms(msg):
    # Your Account Sid and Auth Token from twilio.com/console
    account_sid = 'AC8a21d3810dd09adf8a9fa6873d906803'
    auth_token = '1bdf89c72c0acc0a84a6d3b1e5950aa3'
    client = Client(account_sid, auth_token)
    # $0.0135 per text!
    msg = str(msg.replace("\\r", "\r")).replace("\\n", "\n")[:-5]
    message = client.messages \
                    .create(body=msg, from_='+19027005652', to='+19024013278')
    #print(message.sid)

def parse(lst):
    parsed = str("".join(str(str(s).replace("b", "")).replace("'", "") for s in lst))
    if re.search('ACCIDENT DETECTED!!!', parsed):
        return ["SMS-PIEZOELECTRIC", parsed]
    else:
        parsed = parsed.split("|")
        try:
            parsed.remove("\\n*")
        except ValueError:
            return ["error"]
        try:
            vin = parsed[0][:-3] if parsed[0][-3:] == "vin" else "error"
            per = parsed[1][:-3] if parsed[1][-3:] == "per" else "error"
            ax = parsed[2][:-2] if parsed[2][-2:] == "ax" else "error"
            hr = parsed[3][:-2] if parsed[3][-2:] == "hr" else "error"
            mn = parsed[4][:-2] if parsed[4][-2:] == "mn" else "error"
            sc = parsed[5][:-2] if parsed[5][-2:] == "sc" else "error"
            dy = parsed[6][:-2] if parsed[6][-2:] == "dy" else "error"
            mo = calendar.month_name[int(parsed[7][:-2])] if parsed[7][-2:] == "mo" else "error"
            yr = "20" + parsed[8][:-2] if parsed[8][-2:] == "yr" else "error"
            lat = parsed[9][:-12] if parsed[9][-12:] == "rev_latitude" else "error"
            lng = parsed[10][:-13] if parsed[10][-13:] == "rev_longitude" else "error"
            spd = parsed[11][:-3] if parsed[11][-3:] == "spd" else "error"
        except IndexError:
            return ["error"]
        if "error" not in {vin, per, ax, hr, mn, sc, dy, mo, yr, lat, lng, spd}:
            return ["WEB-ACCELEROMETER", vin + "|" + ax + " (" + per + "%)|" + geo(lat) + "|" + geo(lng) + "|" + spd + "|" + yr + "|" + mo + "|" + dy + "|" + hr + "|" + mn + "|" + sc + "|"]
        else:
            return ["error"]

def loop(lst, ser):
    while True:
        data = ser.read()
        if data:
            lst.append(data)
            if lst[-1] == b'*':
                out = parse(lst)
                if out[0] != "error":
                    if out[0] == "SMS-PIEZOELECTRIC":
                        sms(out[1])
                        print(out)    
                    elif out[0] == "WEB-ACCELEROMETER":
                        wb.open('http://omagarwal.net/acdn/arduino.php?q=' + out[1])
                        print(out)
                else:
                    print(out)
                lst = []
            
if __name__ == '__main__':
    
    com = 'COM13' # EDIT THIS
    baud = 9600 # EDIT THIS
    
    ser = connect(com, baud)
    loop([], ser)