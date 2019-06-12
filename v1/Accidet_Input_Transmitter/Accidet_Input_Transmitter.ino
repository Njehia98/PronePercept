int pezPinfive = 5;
int pezPinfour = 4;
int pezPinthree = 3;
int pezPintwo = 2;
int pezPinone = 1;
String vinno = "XXXXXXXXXXXXXXXXX";
String gpscoord = "0.000000,-0.000000";
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
  valfour = valfour / 4;
 
if (valfour == 0) {
  valfour = float(valfour);
    float sensitivityfour = 100 - valfour/255.0 * 100.0;
    String datafour = "GET http://www.autocollisdetectnet.amitagarwal.net/arduino.php?q="+vinno+"|"+gpscoord+"|Back|";
    Serial.println(datafour);
    for (int i=0; i <= 150; i++){
      digitalWrite(13, HIGH); 
      delay(20);
      digitalWrite(13, LOW);
      delay(20);
    } 
    
   }  

  // Analog pin A3
  int valthree = analogRead(pezPinthree);
  valthree = valthree / 4;
 
if (valthree == 0) {
  valthree = float(valthree);
    float sensitivitythree = 100 - valthree/255.0 * 100.0;
    String datathree = "GET http://www.autocollisdetectnet.amitagarwal.net/arduino.php?q="+vinno+"|"+gpscoord+"|Right|";
    Serial.println(datathree);
      for (int i=0; i <= 150; i++){
      digitalWrite(13, HIGH); 
      delay(20);
      digitalWrite(13, LOW);
      delay(20);
    }
   
   }  
  
  // Analog pin A2  
  int valtwo = analogRead(pezPintwo);
  valtwo = valtwo / 4;
 
if (valtwo == 0) {
   valtwo = float(valtwo);
    float sensitivitytwo = 100 - valtwo/255.0 * 100.0;
    String datatwo = "GET http://www.autocollisdetectnet.amitagarwal.net/arduino.php?q="+vinno+"|"+gpscoord+"|Front|";
    Serial.println(datatwo);
   for (int i=0; i <= 150; i++){
      digitalWrite(13, HIGH); 
      delay(20);
      digitalWrite(13, LOW);
      delay(20);
    }
   
   }
   
   // Analog pin A1
  int valone = analogRead(pezPinone);
  valone = valone / 4;
 
if (valone == 0) {
   valone = float(valone);
    float sensitivityone = 100 - valone/255.0 * 100.0;
    String dataone = "GET http://www.autocollisdetectnet.amitagarwal.net/arduino.php?q="+vinno+"|"+gpscoord+"|Left|";
    Serial.println(dataone);
    for (int i=0; i <= 150; i++){
      digitalWrite(13, HIGH); 
      delay(20);
      digitalWrite(13, LOW);
      delay(20);
    }
   
   }  
   
}


