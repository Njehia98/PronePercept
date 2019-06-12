String vin = "XXX";
String prefix = "ACCIDENT DETECTED!!!\nV.I.N.: " + vin;
String gps_transmitter = "";

void setup() {
    Serial.begin(9600);
    pinMode(2, OUTPUT);
}

void loop() {
  if (Serial.available() > 0) {
    gps_transmitter = Serial.readString();
  }
  
  if (analogRead(A1) == 0) {
    Serial.println(prefix); Serial.print("Side/Angle: FRONT"); Serial.println(gps_transmitter);
    digitalWrite(2, HIGH); delay(1000); digitalWrite(2, LOW);
  }
  if (analogRead(A2) == 0) {
    Serial.println(prefix); Serial.print("Side/Angle: TOP"); Serial.println(gps_transmitter);
    digitalWrite(2, HIGH); delay(1000); digitalWrite(2, LOW);
  }
  if (analogRead(A3) == 0) {
    Serial.println(prefix); Serial.print("Side/Angle: REAR"); Serial.println(gps_transmitter);
    digitalWrite(2, HIGH); delay(1000); digitalWrite(2, LOW);
  }
  if (analogRead(A4) == 0) {
    Serial.println(prefix); Serial.print("Side/Angle: LEFT"); Serial.println(gps_transmitter);
    digitalWrite(2, HIGH); delay(1000); digitalWrite(2, LOW);
  }
  if (analogRead(A5) == 0) {
    Serial.println(prefix); Serial.print("Side/Angle: RIGHT"); Serial.println(gps_transmitter);
    digitalWrite(2, HIGH); delay(1000); digitalWrite(2, LOW);
  }
}
