import processing.serial.*;

Serial port;

void setup() {
 size(500,500); 
 port = new Serial(this, "COM8", 9600);
 port.bufferUntil('\n');
}
boolean overButton = false;


void draw() {
  background(204);

  if (overButton == true) {
    fill(255);
  } else {
    noFill();
  }
  rect(105, 60, 75, 75);
  line(135, 105, 155, 85);
  line(140, 85, 155, 85);
  line(155, 85, 155, 100);
}

void mousePressed() {
  if (overButton) { 
   // link(port);
  }
}

void mouseMoved() { 
  checkButtons(); 
}
  
void mouseDragged() {
  checkButtons(); 
}

void checkButtons() {
  if (mouseX > 105 && mouseX < 180 && mouseY > 60 && mouseY <135) {
    overButton = true;   
  } else {
    overButton = false;
  }
}