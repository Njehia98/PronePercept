#include <Wire.h> 
#include <LiquidCrystal_I2C.h>
#include "StringSplitter.h"

LiquidCrystal_I2C lcd(0x3F, 20, 4);

char phone_no[] = "19024013278";
int threshold = 65;

void setup()
{
  Serial.begin(115200);
  pinMode(12, OUTPUT);
  lcd.init(); lcd.backlight();
  lcd.setCursor(0,0); lcd.print("Initialization!"); delay(2000); lcd.clear();
  String mod1 = "";
}

void loop()
{
  if (Serial.available() > 0) {
    String mod1 = Serial.readString();
  }
  
  int x = analogRead(A0);
  if (x != 0) { x = ((x - 650) + 70) / 1.5; } else { x = 95; }
  int y = analogRead(A1);
  if (y != 0) { y = ((y - 650) + 70) / 1.5; } else { y = 95; }
  int z = analogRead(A2);
  if (z != 0) { z = ((z - 650) + 70) / 1.5; } else { z = 95; }
  
  if (x > threshold) {
    digitalWrite(12, HIGH);
    lcd.setCursor(0,0); lcd.print("ACCIDENT!"); lcd.setCursor(0,1); lcd.print("X = "); lcd.print(x); lcd.print("%");
    Serial.println("AT+CMGF=1"); delay(2000); Serial.print("AT+CMGS=\"");
    Serial.print(phone_no); 
    Serial.write(0x22); Serial.write(0x0D); Serial.write(0x0A);
    delay(2000);
    Serial.print("Accident Detected!\n\nImpact Magnitude/Density: ");
    Serial.print(x);
    Serial.print("\n\nPredominant Angle: X-Axis\n\n");
    delay(2500);
    Serial.println(char(26));//the ASCII code of the ctrl+z is 26
    digitalWrite(12, LOW);   // turn the LED on (HIGH is the voltage level)
    lcd.clear();
  }
  if (y > threshold) {
    digitalWrite(12, HIGH);
    lcd.setCursor(0,0); lcd.print("ACCIDENT!"); lcd.setCursor(0,1); lcd.print("Y = "); lcd.print(y); lcd.print("%");
    Serial.println("AT+CMGF=1"); delay(2000); Serial.print("AT+CMGS=\"");
    Serial.print(phone_no); 
    Serial.write(0x22); Serial.write(0x0D); Serial.write(0x0A);
    delay(2000);
    Serial.print("Accident Detected!\n\nImpact Magnitude/Density: ");
    Serial.print(y);
    Serial.print("\n\nPredominant Angle: Y-Axis\n\n");
    delay(2500);
    Serial.println(char(26));//the ASCII code of the ctrl+z is 26
    digitalWrite(12, LOW);   // turn the LED on (HIGH is the voltage level)
    lcd.clear();
  }
  if (z > threshold) {
    digitalWrite(12, HIGH);
    lcd.setCursor(0,0); lcd.print("ACCIDENT!"); lcd.setCursor(0,1); lcd.print("Z = "); lcd.print(z); lcd.print("%");
    Serial.println("AT+CMGF=1"); delay(2000); Serial.print("AT+CMGS=\"");
    Serial.print(phone_no); 
    Serial.write(0x22); Serial.write(0x0D); Serial.write(0x0A);
    delay(2000);
    Serial.print("Accident Detected!\n\nImpact Magnitude/Density: ");
    Serial.print(z);
    Serial.print("\n\nPredominant Angle: Z-Axis\n\n");
    delay(2500);
    Serial.println(char(26));//the ASCII code of the ctrl+z is 26
    digitalWrite(12, LOW);   // turn the LED on (HIGH is the voltage level)
    lcd.clear();
  }
  
}
