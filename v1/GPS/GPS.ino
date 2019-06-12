#include "TinyGPS.h"

long lon;
long lat;
// create variable for latitude and longitude object

TinyGPS gps; // create gps object

void setup(){
  Serial.begin(9600); // connect serial
}

void loop(){
  while(Serial.available()){ // check for gps data
     if(gps.encode(Serial.read())){ // encode gps data
      gps.get_position(&lat,&lon); // get latitude and longitude
      // display position
      Serial.print("Position: ");
      Serial.println("lat: ");Serial.print(lat);Serial.print(" ");// print latitude
      Serial.println("lon: ");Serial.println(lon); // print longitude
      delay(2000);
     }
     else {
      Serial.println("No Data!");
      delay(2000);
    }
  }
  
}
