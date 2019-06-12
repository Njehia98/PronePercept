#include <SPI.h>
#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <SoftwareSerial.h>
#include <TinyGPS++.h>


SoftwareSerial serial_connection(8, 9); // RX, TX - FOR GPS
TinyGPSPlus gps;

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

char phone_no[]="9024013278";

void setup() {

  serial_connection.begin(9600);
  
  pinMode(12, OUTPUT);
 
  display.begin(SSD1306_SWITCHCAPVCC, 0x3C);  // initialize with the I2C addr 0x3D (for the 128x64)
  // init done
  
  // Show image buffer on the display hardware.
  // Since the buffer is intialized with an Adafruit splashscreen
  // internally, this will display the splashscreen.
  display.display();
  delay(2000);

  // Clear the buffer.
  display.clearDisplay();
  Serial.begin(115200);
}

void loop() {
  display.clearDisplay();
  display.display();

  while(serial_connection.available())//While there are characters to come from the GPS
  {
    gps.encode(serial_connection.read());//This feeds the serial NMEA data into the library one char at a time
  }

    //Serial.println("Latitude:");
    //Serial.println(gps.location.lat(), 6);
    //Serial.println("Longitude:");
    //Serial.println(gps.location.lng(), 6);
    //Serial.println("Speed MPH:");
    //Serial.println(gps.speed.mph());
    
  // Clear the buffer.
  
  // put your main code here, to run repeatedly:
  int x = analogRead(A0);
  int y = analogRead(A1);
  int z = analogRead(A2);
  //int piezo = analogRead(A3);
  int piezo = 0;
  
  if (x > 650 && piezo == 0 || x == 0 && piezo == 0) {

    digitalWrite(12, HIGH);   // turn the LED on (HIGH is the voltage level)
  
    if (x != 0) {
      x = (x - 650) + 70;
    }
    else {
      x = 100;
    }

    display.setTextSize(1);
    display.setTextColor(WHITE);
    display.setCursor(0,0);
    display.println("Collision Detected!\n");
    display.setTextSize(2);
    display.print("X = ");
    display.print(x);
    display.print("%");
    display.display();
    
    //Serial.print(x);
    //Serial.print(" | ");
    //Serial.print("YYY");
    //Serial.print(" | ");
    //Serial.println("ZZZ");
    //Serial.println(piezo);
    //delay(500);
     
delay(300); 

Serial.println("AT+CMGF=1");    
delay(2000);
Serial.print("AT+CMGS=\"");
Serial.print(phone_no); 
Serial.write(0x22);
Serial.write(0x0D);  // hex equivalent of Carraige return    
Serial.write(0x0A);  // hex equivalent of newline
delay(2000);

//Serial.print("IMPACT DETECTED!!!");

Serial.print("Accident Detected!\n\nImpact Magnitude/Density: ");
Serial.print(x);
Serial.print("%\n\nLocation: ");
Serial.print(gps.location.lat());
Serial.print(", ");
Serial.print(gps.location.lng());
Serial.print("\n\nPredominant Angle: X-Axis\n\nCar XXXXXXXXXXXX (");
Serial.print(gps.speed.mph());
Serial.print(" mph)");

delay(2500);
Serial.println (char(26));//the ASCII code of the ctrl+z is 26

digitalWrite(12, LOW);   // turn the LED on (HIGH is the voltage level)
display.clearDisplay();
    
  }
  if (y > 650 && piezo == 0 || y == 0 && piezo == 0) {
    
    digitalWrite(12, HIGH);   // turn the LED on (HIGH is the voltage level)
    
    if (y != 0) {
      y = (y - 650) + 70;
    }
    else {
      y = 100;
    }
    
    display.setTextSize(1);
    display.setTextColor(WHITE);
    display.setCursor(0,0);
    display.println("Collision Detected!\n");
    display.setTextSize(2);
    display.print("Y = ");
    display.print(y);
    display.print("%");
    display.display();
    
    //Serial.print("XXX");
    //Serial.print(" | ");
    //Serial.print(y);
    //Serial.print(" | ");
    //Serial.println("ZZZ");
    //Serial.println(piezo);
    //delay(500);

delay(300); 

Serial.println("AT+CMGF=1");    
delay(2000);
Serial.print("AT+CMGS=\"");
Serial.print(phone_no); 
Serial.write(0x22);
Serial.write(0x0D);  // hex equivalent of Carraige return    
Serial.write(0x0A);  // hex equivalent of newline
delay(2000);

//Serial.print("IMPACT DETECTED!!!");

Serial.print("Accident Detected!\n\nImpact Magnitude/Density: ");
Serial.print(y);
Serial.print("%\n\nLocation: ");
Serial.print(gps.location.lat());
Serial.print(", ");
Serial.print(gps.location.lng());
Serial.print("\n\nPredominant Angle: Y-Axis\n\nCar XXXXXXXXXXXX (");
Serial.print(gps.speed.mph());
Serial.print(" mph)");

//char one = "Accident Detected!\n\nImpact Magnitude/Density: ";
//char two = one + y;
//char three = two + "\n\nLocation: ";
//char four = three + gps.location.lat();
//char five = four + ", ";
//char six = five + gps.location.lng();
//char seven = six + "\n\nPredominant Angle: Y-Axis\n\nCar XXXXXXXXXXXX (";
//char eight = seven + gps.speed.mph();
//char nine = eight + " mph)";
//char str = nine;

//Serial.print(str);
//Serial.print("Accident Detected!\n\nImpact Magnitude/Density: "+y+"\n\nLocation: "+gps.location.lat()+", "+gps.location.lng()+"\n\nPredominant Angle: Y-Axis\n\nCar XXXXXXXXXXXX ("+gps.speed.mph()+" mph)");
delay(2500); 
Serial.println (char(26));//the ASCII code of the ctrl+z is 26

digitalWrite(12, LOW);   // turn the LED on (HIGH is the voltage level)
display.clearDisplay();
  
  }
  if (z > 650 && piezo == 0 || z == 0 && piezo == 0) {
    
    digitalWrite(12, HIGH);   // turn the LED on (HIGH is the voltage level)
    
    if (z != 0) {
      z = (z - 650) + 70;
    }
    else {
      z = 100;
    }
    
    display.setTextSize(1);
    display.setTextColor(WHITE);
    display.setCursor(0,0);
    display.println("Collision Detected!\n");
    display.setTextSize(2);
    display.print("Z = ");
    display.print(z);
    display.print("%");
    display.display();
    
    //Serial.print("XXX");
    //Serial.print(" | ");
    //Serial.print("YYY");
    //Serial.print(" | ");
    //Serial.println(z);
    //Serial.println(piezo);
    //delay(500);
      
delay(300); 

Serial.println("AT+CMGF=1");    
delay(2000);
Serial.print("AT+CMGS=\"");
Serial.print(phone_no); 
Serial.write(0x22);
Serial.write(0x0D);  // hex equivalent of Carraige return    
Serial.write(0x0A);  // hex equivalent of newline
delay(2000);

//Serial.print("IMPACT DETECTED!!!");

Serial.print("Accident Detected!\n\nImpact Magnitude/Density: ");
Serial.print(z);
Serial.print("% \n\nLocation: ");
Serial.print(gps.location.lat());
Serial.print(", ");
Serial.print(gps.location.lng());
Serial.print("\n\nPredominant Angle: Z-Axis\n\nCar XXXXXXXXXXXX (");
Serial.print(gps.speed.mph());
Serial.print(" mph)");

delay(2500);
Serial.println (char(26));//the ASCII code of the ctrl+z is 26

digitalWrite(12, LOW);   // turn the LED on (HIGH is the voltage level)
display.clearDisplay();
  
  }

  //Serial.print(x);
  //Serial.print(" | ");
  //Serial.print(y);
  //Serial.print(" | ");
  //Serial.println(z);
  //Serial.println(piezo);
  
}
