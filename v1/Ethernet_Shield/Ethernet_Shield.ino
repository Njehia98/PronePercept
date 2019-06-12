#include <SPI.h>
#include <Ethernet.h>

// MAC address from Ethernet shield sticker under board
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
EthernetServer server(80);  // create a server at port 80
String data = "";

void setup()
{
    Serial.begin(9600);
    if (Ethernet.begin(mac) == 0) {
     Serial.println("Failed to configure Ethernet using DHCP");
    }
    server.begin();   // start to listen for clients
    Serial.println(Ethernet.localIP());   //have to get rid of ip assignment at the top to get real local ip
}

void loop()
{
  EthernetClient client = server.available();  // try to get client

    if (client) {  // got client?
        boolean currentLineIsBlank = true;
        while (client.connected()) {
            if (client.available()) {   // client data available to read
                char c = client.read(); // read 1 byte (character) from client
                // last line of client request is blank and ends with \n
                // respond to client only after last line received
                if (c == '\n' && currentLineIsBlank) {
                    // send a standard http response header
                    client.println("HTTP/1.1 200 OK");
                    client.println("Content-Type: text/html");
                    client.println("Connection: close");
                    client.println();
                    // send web page
                    client.println("<!DOCTYPE html>");
                    client.println("<html>");
                    client.println("<head>");
                    client.println("<meta http-equiv='refresh' content='1'>");
                    
                    if (Serial.available() > 0) {
                      data = Serial.readString();
                    }
                      
                    if (data == "") {
                      
                    } else {  
                      client.println("<meta http-equiv='refresh' content='1'>");
                      String url = "http://www.acdn.omagarwal.net/arduino.php?q="+data+"";
                      client.println("<script> window.open('"+url+"', '_blank'); </script>");
                      data = "";
                      
                    }
                      
                    client.println("<title>Ethernet Shield!</title>");
                    client.println("</head>");
                    client.println("<body style='font-family:Verdana'>");
                    client.println("<h1>Arduino Ethernet Shield Connectivity Page</h1>");
                    client.println("<p>Web-Based platform to dispatch data to an external server...</p>");
                    client.println("</body>");
                    client.println("</html>");
                    break;
                }
                // every line of text received from the client ends with \r\n
                if (c == '\n') {
                    // last character on line of received text
                    // starting new line with next character read
                    currentLineIsBlank = true;
                } 
                else if (c != '\r') {
                    // a text character was received from client
                    currentLineIsBlank = false;
                }
            } // end if (client.available())
        } // end while (client.connected())
        delay(1);      // give the web browser time to receive the data
        client.stop(); // close the connection
    }
}// end if (client)

