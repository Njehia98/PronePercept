#include <Wire.h> 
#include <LiquidCrystal_I2C.h>
LiquidCrystal_I2C lcd(0x3F, 20, 4);

int threshold = 85;
String gps_transmitter = "";
String vin = "YYY";

void setup()
{
  Serial.begin(9600);
  pinMode(12, OUTPUT);
  lcd.init(); lcd.backlight();
  lcd.setCursor(0,0); lcd.print("Initialization!"); delay(2000); lcd.clear();
}

void loop()
{
  tone(8, 20000);
  
  if (Serial.available() > 0) {
    gps_transmitter = Serial.readString() + "\n";
  }
  
  int x = analogRead(A0);
  if (x != 0) { x = ((x - 650) + 70) / 1.5; } else { x = 95; }
  int y = analogRead(A1);
  if (y != 0) { y = ((y - 650) + 70) / 1.5; } else { y = 95; }
  int z = analogRead(A2);
  if (z != 0) { z = ((z - 650) + 70) / 1.5; } else { z = 95; }
  
  if (x > threshold) {
    lcd.setCursor(0,0); lcd.print("ACCIDENT!"); lcd.setCursor(0,1); lcd.print("X = "); lcd.print(x); lcd.print("%");
    Serial.print(vin); Serial.print("vin|"); Serial.print(x); Serial.print("per|Xax|"); Serial.print(gps_transmitter);
    digitalWrite(12, HIGH); tone(8, 1); delay(2000); digitalWrite(12, LOW); lcd.clear();
  }
  if (y > threshold) {
    lcd.setCursor(0,0); lcd.print("ACCIDENT!"); lcd.setCursor(0,1); lcd.print("Y = "); lcd.print(y); lcd.print("%");
    Serial.print(vin); Serial.print("vin|"); Serial.print(y); Serial.print("per|Yax|"); Serial.print(gps_transmitter);
    digitalWrite(12, HIGH); tone(8, 1); delay(2000); digitalWrite(12, LOW); lcd.clear();
  }
  if (z > threshold) {
    lcd.setCursor(0,0); lcd.print("ACCIDENT!"); lcd.setCursor(0,1); lcd.print("Z = "); lcd.print(z); lcd.print("%");
    Serial.print(vin); Serial.print("vin|"); Serial.print(z); Serial.print("per|Zax|"); Serial.print(gps_transmitter);
    digitalWrite(12, HIGH); tone(8, 1); delay(2000); digitalWrite(12, LOW); lcd.clear();
  }
  
}
