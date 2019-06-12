#include <Adafruit_GPS.h>
#include <SoftwareSerial.h>
#include <SPI.h>
#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>

#define OLED_RESET 4
Adafruit_SSD1306 display(OLED_RESET);

#define NUMFLAKES 10
#define XPOS 0
#define YPOS 1
#define DELTAY 2


#define LOGO16_GLCD_HEIGHT 16 
#define LOGO16_GLCD_WIDTH  16 
static const unsigned char PROGMEM logo16_glcd_bmp[] =
{ B00000000, B11000000,
  B00000001, B11000000,
  B00000001, B11000000,
  B00000011, B11100000,
  B11110011, B11100000,
  B11111110, B11111000,
  B01111110, B11111111,
  B00110011, B10011111,
  B00011111, B11111100,
  B00001101, B01110000,
  B00011011, B10100000,
  B00111111, B11100000,
  B00111111, B11110000,
  B01111100, B11110000,
  B01110000, B01110000,
  B00000000, B00110000 };

// GPSSerial Object
SoftwareSerial GPSSerial(13, 10);
SoftwareSerial UpdateSerial(11, 12);

Adafruit_GPS GPS(&GPSSerial);
#define GPSECHO false

uint32_t timer = millis();

int hr = 0; int mn = 0; int sc = 0; int dy = 0; int mo = 0; int yr = 0; float rev_latitude = 0.0000; float rev_longitude = 0.0000; float spd = 0.00;

void setup()
{
  //while (!Serial);  // uncomment to have the sketch wait until Serial is ready
  
  Serial.begin(9600);
  UpdateSerial.begin(9600);
  
  // 9600 NMEA is the default baud rate for Adafruit MTK GPS's- some use 4800
  GPS.begin(9600);
  GPS.sendCommand(PMTK_SET_NMEA_OUTPUT_RMCGGA);
  GPS.sendCommand(PMTK_SET_NMEA_UPDATE_1HZ); // 1 Hz update rate
  GPS.sendCommand(PGCMD_ANTENNA);

  delay(1000);
  
  GPSSerial.println(PMTK_Q_RELEASE);

  // by default, we'll generate the high voltage from the 3.3v line internally! (neat!)
  display.begin(SSD1306_SWITCHCAPVCC, 0x3C);  // initialize with the I2C addr 0x3D (for the 128x64)
  // init done
  
  // Show image buffer on the display hardware.
  // Since the buffer is intialized with an Adafruit splashscreen
  // internally, this will display the splashscreen.
  display.display();
  delay(2000);

  // Clear the buffer.
  display.clearDisplay();
}

void loop() // run over and over again
{
  // read data from the GPS in the 'main loop'
  char c = GPS.read();
  if (GPSECHO)
    if (c) Serial.print(c);
  // if a sentence is received, we can check the checksum, parse it...
  if (GPS.newNMEAreceived()) {
    
    // Serial.println(GPS.lastNMEA()); // this also sets the newNMEAreceived() flag to false
    if (!GPS.parse(GPS.lastNMEA())) // this also sets the newNMEAreceived() flag to false
      return; // we can fail to parse a sentence in which case we should just wait for another
  }
  // if millis() or timer wraps around, we'll just reset it
  if (timer > millis()) timer = millis();
    
  if (millis() - timer > 2000) {

    int oled_timer = millis();
    
    timer = millis(); // reset the timer
    
    Serial.print("\nTime: ");
    int hr = GPS.hour; Serial.print(hr); Serial.print(':');
    int mn = GPS.minute; Serial.print(mn); Serial.print(':');
    int sc = GPS.seconds; Serial.print(sc); Serial.print(" | ");
    
    Serial.print("Date: ");
    int dy = GPS.day; Serial.print(dy); Serial.print('/');
    int mo = GPS.month; Serial.print(mo); Serial.print("/");
    int yr = GPS.year; Serial.println(yr);
    
    //Serial.print("Fix: "); Serial.print((int)GPS.fix);
    //Serial.print(" quality: "); Serial.println((int)GPS.fixquality);
    
    Serial.print("Location: ");
    char lt[9]; float latitude = GPS.latitude; dtostrf(latitude,9,4,lt); String rev_latitude = String(lt) + String(GPS.lat);
    char ln[9]; float longitude = GPS.longitude; dtostrf(longitude,9,4,ln); String rev_longitude = String(ln) + String(GPS.lon);
    Serial.print(rev_latitude); Serial.print(", "); Serial.println(rev_longitude);
    
    Serial.print("Speed (mph): "); float spd = (GPS.speed * 1.15078); Serial.println(spd);
    
    //Serial.print("Angle: "); Serial.println(GPS.angle);
    //Serial.print("Altitude: "); Serial.println(GPS.altitude);
    //Serial.print("Satellites: "); Serial.println((int)GPS.satellites);    

    if (oled_timer < 1000) {
        display.clearDisplay();
    
        display.setTextSize(1); display.setTextColor(WHITE); display.setCursor(0, 0); display.cp437(true);
    
        display.print("Time: "); display.print(hr); display.print(':'); display.print(mn); display.print(':'); display.println(sc); display.println();
        display.print("Date: "); display.print(dy); display.print('/'); display.print(mo); display.print('/'); display.print(yr);
    
        display.display();
      }
    else {
        display.clearDisplay();
        
        display.setTextSize(1); display.setTextColor(WHITE); display.setCursor(0, 0); display.cp437(true);
    
        display.print("Location: "); display.print(rev_latitude); display.print(", "); display.println(rev_longitude); display.println();
        display.print("Speed (mph): "); display.print(spd);
        
        display.display();
      }
    
    UpdateSerial.print(hr); UpdateSerial.print("hr|"); UpdateSerial.print(mn); UpdateSerial.print("mn|"); UpdateSerial.print(sc); UpdateSerial.print("sc|"); 
    UpdateSerial.print(dy); UpdateSerial.print("dy|"); UpdateSerial.print(mo); UpdateSerial.print("mo|"); UpdateSerial.print(yr); UpdateSerial.print("yr|");
    UpdateSerial.print(rev_latitude); UpdateSerial.print("rev_latitude|"); UpdateSerial.print(rev_longitude); UpdateSerial.print("rev_longitude|"); UpdateSerial.print(spd); UpdateSerial.print("spd|");
    
    }
  }

/*
    display.setTextSize(1); display.setTextColor(WHITE); display.setCursor(0, 0); display.cp437(true);

    display.print("Time: "); display.print(hr); display.print(':'); display.print(mn); display.print(':'); display.println(sc); display.println();
    display.print("Date: "); display.print(dy); display.print('/'); display.print(mo); display.print('/'); display.print(yr);

    display.display(); display.clearDisplay();
 
    display.setTextSize(1); display.setTextColor(WHITE); display.setCursor(0, 0); display.cp437(true);
    
    display.print("Location: "); display.print(rev_latitude); display.print(", "); display.println(rev_longitude); display.println();
    display.print("Speed (Knots): "); display.print(spd);
    
    display.display(); display.clearDisplay();   
*/
