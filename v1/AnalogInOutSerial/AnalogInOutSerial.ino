int pezPinfive = 5;
int pezPinfour = 4;
int pezPinthree = 3;
int pezPintwo = 2;
int pezPinone = 1;
int pezPinzero = 0;
int f_cntr = 0;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  pinMode(13, OUTPUT);      // sets the digital pin as output

}

void loop() {
  // put your main code here, to run repeatedly:

  if (f_cntr == 0) {
    f_cntr = f_cntr + 1;
  }
   
// Analog pin A4
  int valfour = analogRead(pezPinfour);
  
if (valfour > 850) {
   Serial.println("Impact Sensed! (Sensor 4)");
   digitalWrite(13, HIGH); 
   delay(1000);
   digitalWrite(13, LOW); 
} 

// Analog pin A3
  int valthree = analogRead(pezPinthree);
  
if (valthree > 850) {
   Serial.println("Impact Sensed! (Sensor 3)");
   digitalWrite(13, HIGH); 
   delay(1000);
   digitalWrite(13, LOW); 
} 

// Analog pin A2
  int valtwo = analogRead(pezPintwo);
  
if (valtwo > 850) {
   Serial.println("Impact Sensed! (Sensor 2)");
   digitalWrite(13, HIGH); 
   delay(1000);
   digitalWrite(13, LOW); 
} 

// Analog pin A1
  int valone = analogRead(pezPinone);
  
if (valone > 850) {
   Serial.println("Impact Sensed! (Sensor 1)");
   digitalWrite(13, HIGH); 
   delay(1000);
   digitalWrite(13, LOW); 
} 
  
}


