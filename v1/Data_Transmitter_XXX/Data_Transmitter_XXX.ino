#include "TinyGPS++.h"
#include "SoftwareSerial.h"

SoftwareSerial serial_connection(10, 11); //RX=pin 10, TX=pin 11
TinyGPSPlus gps;//This is the GPS object that will pretty much do all the grunt work with the NMEA data

int pezPinfive = 5;
int pezPinfour = 4;
int pezPinthree = 3;
int pezPintwo = 2;
int pezPinone = 1;
int pezPinzero = 0;
String vinno = "XXXXXXXXXXXXXXXXX";
float latitude = 0.00000;
float longitude = 0.00000;
int f_cntr = 0;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  pinMode(13, OUTPUT);      // sets the digital pin as output
  serial_connection.begin(9600);//This opens up communications to the GPS
}

void loop() {
      
// Analog pin A5
  int valfive = analogRead(pezPinfive);
  
if (valfive == 0) {
  
  while(serial_connection.available())//While there are characters to come from the GPS
  {
   gps.encode(serial_connection.read());//This feeds the serial NMEA data into the library one char at a time
   //Get the latest info from the gps object which it derived from the data sent by the GPS unit
    latitude = gps.location.lat();
    longitude = gps.location.lng();
  }
 
  String datafive = ""+vinno+"|"+latitude+","+longitude+"|Left|";
  Serial.print(datafive);
   digitalWrite(13, HIGH); 
   delay(1000);
   digitalWrite(13, LOW); 
} 

// Analog pin A4
  int valfour = analogRead(pezPinfour);
  
if (valfour == 0) {
   while(serial_connection.available())//While there are characters to come from the GPS
  {
   gps.encode(serial_connection.read());//This feeds the serial NMEA data into the library one char at a time
   //Get the latest info from the gps object which it derived from the data sent by the GPS unit
    latitude = gps.location.lat();
    longitude = gps.location.lng();
  }
  
  String datafour = ""+vinno+"|"+latitude+","+longitude+"|Rear|";
  Serial.print(datafour);
   digitalWrite(13, HIGH); 
   delay(1000);
   digitalWrite(13, LOW); 
} 

// Analog pin A3
  int valthree = analogRead(pezPinthree);
  
if (valthree == 0) {
   while(serial_connection.available())//While there are characters to come from the GPS
  {
   gps.encode(serial_connection.read());//This feeds the serial NMEA data into the library one char at a time
   //Get the latest info from the gps object which it derived from the data sent by the GPS unit
    latitude = gps.location.lat();
    longitude = gps.location.lng();
  }
    
  String datathree = ""+vinno+"|"+latitude+","+longitude+"|Front|";
  Serial.print(datathree);
   digitalWrite(13, HIGH); 
   delay(1000);
   digitalWrite(13, LOW); 
} 

// Analog pin A2
  int valtwo = analogRead(pezPintwo);
  
if (valtwo == 0) {
   while(serial_connection.available())//While there are characters to come from the GPS
  {
   gps.encode(serial_connection.read());//This feeds the serial NMEA data into the library one char at a time
   //Get the latest info from the gps object which it derived from the data sent by the GPS unit
    latitude = gps.location.lat();
    longitude = gps.location.lng();
  }
    
  String datatwo = ""+vinno+"|"+latitude+","+longitude+"|Top|";
  Serial.print(datatwo);
   digitalWrite(13, HIGH); 
   delay(1000);
   digitalWrite(13, LOW); 
} 

// Analog pin A1
  int valone = analogRead(pezPinone);
  
if (valone == 0) {
  while(serial_connection.available())//While there are characters to come from the GPS
  {
   gps.encode(serial_connection.read());//This feeds the serial NMEA data into the library one char at a time
   //Get the latest info from the gps object which it derived from the data sent by the GPS unit
    latitude = gps.location.lat();
    longitude = gps.location.lng();
  }
    
  String dataone = ""+vinno+"|"+latitude+","+longitude+"|Right|";
  Serial.print(dataone);
   digitalWrite(13, HIGH); 
   delay(1000);
   digitalWrite(13, LOW); 
} 
   
}


