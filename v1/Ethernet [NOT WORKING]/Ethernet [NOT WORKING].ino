// EDIT: Change the 'ssid' and 'password' to match your network
//char ssid[] = "yournetwork";  // wireless network name
//char password[] = "yourpassword"; // wireless password
//int status = WL_IDLE_STATUS;
//WiFiClient client;
#include <Ethernet.h>
#include <SPI.h>

byte mac[] = { 0x90,0xA2,0xDA,0x0D,0x0D,0xB1};  //Replace with your Ethernet shield MAC
EthernetClient client;
IPAddress ip(192, 128, 0, 100); //ethernet ip address attatched to my ethernet shield

// EDIT: 'Server' address to match your domain
char server[] = "127.0.0.1"; // This could also be 192.168.1.18/~me if you are running a server on your computer on a local network.

void setup()
{
Serial.begin(9600);
Ethernet.begin(mac,ip);
delay(1000);
Serial.println("connecting...");
postData();
}


// This is the data that will be passed into your POST and matches your mysql column
/*int yourarduinodata = 999;
String yourdatacolumn = "yourdata=";
String yourdata;

void setup() {
  Serial.begin(9600);

  connectWifi();

  // You're connected now, so print out the status
  printWifiStatus();

  postData();
}*/

void loop() {

}

/*void connectWifi() {
  // Attempt to connect to wifi network
  while ( status != WL_CONNECTED) {
    Serial.print("Attempting to connect to SSID: ");
    Serial.println(ssid);
    status = WiFi.begin(ssid, password);
    // Wait 10 seconds for connection
    delay(10000);
  }
}*/

/*void printWifiStatus() {
  // Print the SSID of the network you're attached to
  Serial.print("SSID: ");
  Serial.println(WiFi.SSID());

  // Print your WiFi shield's IP address
  IPAddress ip = WiFi.localIP();
  Serial.print("IP Address: ");
  Serial.println(ip);

  // Print the received signal strength
  long rssi = WiFi.RSSI();
  Serial.print("signal strength (RSSI):");
  Serial.print(rssi);
  Serial.println(" dBm");
}*/

// This method makes a HTTP connection to the server and POSTs data
void postData() {
  // Combine yourdatacolumn header (yourdata=) with the data recorded from your arduino
  // (yourarduinodata) and package them into the String yourdata which is what will be
  // sent in your POST request
  String yourdata = "samp=samp";

  // If there's a successful connection, send the HTTP POST request
  if (client.connect(server, 80)) {
    Serial.println("connecting...");

    // EDIT: The POST 'URL' to the location of your insert_mysql.php on your web-host
    client.println("POST /../arduino.php HTTP/1.1");

    // EDIT: 'Host' to match your domain
    client.println("Host:127.0.0.1 ");
    client.println("User-Agent: Arduino/1.0");
    client.println("Connection: close");
    client.println("Content-Type: application/x-www-form-urlencoded;");
    client.print("Content-Length: ");
    client.println(yourdata.length());
    client.println();
    client.println(yourdata); 
  } 
  else {
    // If you couldn't make a connection:
    Serial.println("Connection failed");
    Serial.println("Disconnecting.");
    client.stop();
  }
}
