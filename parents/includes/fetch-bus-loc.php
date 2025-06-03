<?php
include '../../includes/db_conn.php';
$bus_ID = $_GET['bus_ID'];
$send_map = "";
$sql = "SELECT * FROM bus as b  where b.bus_ID='$bus_ID' ";
$exe = $conn->query($sql);
while ($row = $exe->fetch_array()) {
    $longitude = $row['longitude'];
    $latitude = $row['latitude'];
    $name = $row['plate_number'];
    $icon2 = "{
                url: '../images/development/bus.png', 
                scaledSize: new google.maps.Size(50, 50), 
                origin: new google.maps.Point(0, 0), 
                anchor: new google.maps.Point(0, 0) 
            }";
}
$send_map .= "{coords:{lat:" . $latitude . ",lng:" . $longitude . "},content:'" . $name . "',iconImage:" . $icon2 . ",},";
$centerlat = $latitude;
$centerlong = $longitude;

$out = array("latitude" => $centerlat, "longitude" => $centerlong);
echo json_encode($out);
