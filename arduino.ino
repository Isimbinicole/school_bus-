#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <SPI.h>
#include <MFRC522.h>
#include <GyverOLED.h>

GyverOLED<SSH1106_128x64> oled;

// WiFi credentials
#define STASSID "HUAWEI-B310-68AD"
#define STAPSK  "YALJG3Y7FH6"

// Server URL (update if needed)
#define SERVER_URL "http://nicole1-001-site1.jtempurl.com/api/student.php"

// RFID pins
#define SS_PIN D3
#define RST_PIN D4
MFRC522 mfrc522(SS_PIN, RST_PIN);

// LEDs
#define LED_SUCCESS D0
#define LED_FAIL D8

WiFiClient client;
HTTPClient http;

String cardUID, studentInfo, requestStatus;
String latitude = "";
String longitude = "";

void setup() {
  Serial.begin(9600);
  SPI.begin();
  mfrc522.PCD_Init();

  pinMode(LED_SUCCESS, OUTPUT);
  pinMode(LED_FAIL, OUTPUT);
  digitalWrite(LED_SUCCESS, LOW);
  digitalWrite(LED_FAIL, LOW);

  oled.init();
  oled.clear();
  oled.setScale(1);
  oled.setCursor(0, 1);
  oled.print("Connecting WiFi...");
  oled.update();

  WiFi.begin(STASSID, STAPSK);
  while (WiFi.status() != WL_CONNECTED) {
    delay(200);
    Serial.print(".");
  }

  oled.clear();
  oled.setCursor(0, 1);
  oled.print("WiFi Connected!");
  oled.setCursor(0, 3);
  oled.print(WiFi.localIP());
  oled.update();
  delay(1000);
}

void loop() {
  if (!mfrc522.PICC_IsNewCardPresent() || !mfrc522.PICC_ReadCardSerial()) return;

  cardUID = "";
  for (byte i = 0; i < mfrc522.uid.size; i++) {
    cardUID += String(mfrc522.uid.uidByte[i], HEX);
  }
  cardUID.toUpperCase();
  Serial.println("Card UID: " + cardUID);

  oled.clear();
  oled.setCursor(0, 1);
  oled.print("Reading Card...");
  oled.setCursor(0, 3);
  oled.print("UID: " + cardUID);
  oled.update();

  sendCardToServer(cardUID);
  showResponse();

  delay(5000);
}

void sendCardToServer(String uid) {
  if (WiFi.status() != WL_CONNECTED) {
    requestStatus = "wifi_error";
    return;
  }

  String postBody = "{\"card\":\"" + uid + "\"}";
  Serial.println("Sending to server: " + postBody);

  http.begin(client, SERVER_URL);
  http.addHeader("Content-Type", "application/json");

  int httpCode = http.POST(postBody);

  if (httpCode > 0) {
    String payload = http.getString();
    Serial.println("HTTP " + String(httpCode) + " Response: " + payload);

    if (payload.indexOf("student_names") != -1) {
      requestStatus = "success";
      String name = getValue(payload, "student_names");
      String dob = getValue(payload, "DOB");
      String sex = getValue(payload, "sex");
      latitude = getValue(payload, "latitude");
      longitude = getValue(payload, "longitude");

      studentInfo = "Name: " + name + "\nDOB: " + dob + "\nSex: " + sex;
    } else {
      requestStatus = "not_found";
    }
  } else {
    requestStatus = "http_error";
    Serial.printf("HTTP Error: %s\n", http.errorToString(httpCode).c_str());
  }

  http.end();
}

void showResponse() {
  oled.clear();
  if (requestStatus == "success") {
    digitalWrite(LED_SUCCESS, HIGH);
    oled.setScale(1);
    oled.setCursor(0, 0);
    oled.print("STUDENT FOUND!");
    oled.setCursor(0, 2);
    oled.print(studentInfo);
    oled.setCursor(0, 6);
    oled.print("Lat: " + latitude);
    oled.setCursor(0, 7);
    oled.print("Long: " + longitude);
    oled.setCursor(0, 8);
    oled.print("Status: OK");
    digitalWrite(LED_FAIL, LOW);
  } else if (requestStatus == "not_found") {
    digitalWrite(LED_FAIL, HIGH);
    oled.setCursor(0, 1);
    oled.print("Student Not Found");
    digitalWrite(LED_SUCCESS, LOW);
  } else {
    digitalWrite(LED_FAIL, HIGH);
    oled.setCursor(0, 1);
    oled.print("Internet Error");
    digitalWrite(LED_SUCCESS, LOW);
  }
  oled.update();
  delay(1500);
  digitalWrite(LED_SUCCESS, LOW);
  digitalWrite(LED_FAIL, LOW);
}

String getValue(String data, String key) {
  int start = data.indexOf(key + "\":\"");
  if (start == -1) return "";
  start += key.length() + 3;
  int end = data.indexOf("\"", start);
  return data.substring(start, end);
}
