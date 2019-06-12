#include <SPI.h>
#include <Ethernet.h>

// Enter a MAC address for your controller below.
byte mac[] = {  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
//An IP Address and Router settings just in case there is no DHCP available
IPAddress ip(192,168,0,104);
IPAddress gateway(192,168,0,1);
IPAddress subnet(255,255,255,0);

//The Web Server we are connecting to
char serverName[] = "69.89.31.152";


// Initialize the Ethernet client library
EthernetClient client;

void setup() {
  // start the serial library:
  Serial.begin(9600);
  // start the Ethernet connection:
  Ethernet.begin(mac, ip, gateway, subnet);
  
  // give the Ethernet shield a second to initialize:
  delay(1000);
if (client.connect(serverName, 443)) {
    Serial.println("Successfully Connected!");
} 
else {
   if (client.connect(serverName, 80)) {
    Serial.println("Successfully Connected!");
   }
   else {
    // If you didn't get a connection to the server:
    Serial.println("Connection Failed :(");
   }
 }
}

void loop()
{

  if (Serial.available() > 0) {
String data = Serial.readString();
 if (!client.connected()) {
      client.stop();
      
  }
  Serial.println();
  Serial.println();
      
  Ethernet.begin(mac, ip, gateway, subnet);
  
  // give the Ethernet shield a second to initialize:
  delay(1000);
  client.connect(serverName, 443); // Dummy call
  client.connect(serverName, 80); // Dummy call
  Serial.println("Input Recieved. Forwarding Information to Server...");

  // if you get a connection, report back via serial:
  delay(1000);
  if (client.connect(serverName, 443)) {
      Serial.println("Done!");
      Serial.println();
       client.println(data);
      Serial.println("Appended Data to Database + Sent Email to 911...");
      Serial.println("MAX Sensitivity Impact (100%)");
      Serial.println("Entry Viewable at: http://www.acdn.omagarwal.net/");
  } 
  else {
     if (client.connect(serverName, 80)) {
      Serial.println("Done!");
      Serial.println();
       client.println(data);
      Serial.println("Appended Data to Database + Sent Email to 911...");
      Serial.println("MAX Sensitivity Impact (100%)");
      Serial.println("Entry Viewable at: http://www.acdn.omagarwal.net/");
    }
    else {
      // If you didn't get a connection to the server:
      Serial.println("Oops something went wrong :(");
    }
  }
       
  } 
}


