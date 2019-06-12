int pezPinfour = 4;
int pezPinthree = 3;
int pezPintwo = 2;
int pezPinone = 1;
String vinno = "abcd";
int f_cntr = 0;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  pinMode(13, OUTPUT);      // sets the digital pin as output

}

void loop() {
  // put your main code here, to run repeatedly:

  if (f_cntr == 0) {
    Serial.print("The following interuptions will notify\nof any disturbances that have occured\nto any of the Piezoelectric Sensors through\nan Analog Agigation:\n\n");
    f_cntr = f_cntr + 1;
  }
   
  
  // Analog pin A4
  int valfour = analogRead(pezPinfour);
  valfour = valfour / 4;
 
if (valfour < 50) {
  valfour = float(valfour);
    float sensitivityfour = 100 - valfour/255.0 * 100.0;
    String tipfour = "Analog Pin 4 Peizo Sensor (FRONT) Impact (on Car Vin No. "+vinno+"): ";
    String datafour = tipfour + sensitivityfour + "%";
    Serial.println(datafour);
    for (int i=0; i <= 250; i++){
      digitalWrite(13, HIGH); 
      delay(20);
      digitalWrite(13, LOW);
      delay(20);
    } 
    
   }  

  // Analog pin A3
  int valthree = analogRead(pezPinthree);
  valthree = valthree / 4;
 
if (valthree < 50) {
  valthree = float(valthree);
    float sensitivitythree = 100 - valthree/255.0 * 100.0;
    String tipthree = "Analog Pin 3 Peizo Sensor (LEFT SIDE) Impact (on Car Vin No. "+vinno+"): ";
    String datathree = tipthree + sensitivitythree + "%";
    Serial.println(datathree);
      for (int i=0; i <= 250; i++){
      digitalWrite(13, HIGH); 
      delay(20);
      digitalWrite(13, LOW);
      delay(20);
    }
   
   }  
  
  // Analog pin A2  
  int valtwo = analogRead(pezPintwo);
  valtwo = valtwo / 4;
 
if (valtwo < 50) {
   valtwo = float(valtwo);
    float sensitivitytwo = 100 - valtwo/255.0 * 100.0;
    String tiptwo = "Analog Pin 2 Peizo Sensor (RIGHT SIDE) Impact (on Car Vin No. "+vinno+"): ";
    String datatwo = tiptwo + sensitivitytwo + "%";
    Serial.println(datatwo);
   for (int i=0; i <= 250; i++){
      digitalWrite(13, HIGH); 
      delay(20);
      digitalWrite(13, LOW);
      delay(20);
    }
   
   }

  // Analog pin A1
  int valone = analogRead(pezPinone);
  valone = valone / 4;
 
if (valone < 50) {
   valone = float(valone);
    float sensitivityone = 100 - valone/255.0 * 100.0;
    String tipone = "Analog Pin 1 Peizo Sensor (BACK) Impact (on Car Vin No. "+vinno+"): ";
    String dataone = tipone + sensitivityone + "%";
    Serial.println(dataone);
    for (int i=0; i <= 250; i++){
      digitalWrite(13, HIGH); 
      delay(20);
      digitalWrite(13, LOW);
      delay(20);
    }
   
   }  
   
}


