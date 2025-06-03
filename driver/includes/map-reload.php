<?php
session_start();
if (!isset($_SESSION['driver_ID'])) {
    header("location:../index.php");
} else {
    $driver_ID = $_SESSION['driver_ID'];
}
include '../../includes/db_conn.php';
$sql = "SELECT * FROM `data` as d  inner join students as s on d.student_ID=s.student_ID inner join parents as p on s.parent_ID=p.parent_ID  WHERE d.driver_ID='$driver_ID' AND d.status='0'";
$exe = $conn->query($sql);
$send_map = "";
while ($row = $exe->fetch_array()) {
    $longitude = $row['longitude'];
    $latitude = $row['latitude'];
    $name = $row['student_names'];
    $image = $row['profile_image'];
    $icon = "";

    $profile = '<img src="../images/students/' . $image . '"height="50" width="50"><br>';



    //$send_map .= "{lat:" . $latitude . ",lng:" . $longitude . "},";
}
$sql = "SELECT * FROM `drivers` as d inner join bus as b on d.bus_ID=b.bus_ID where d.driver_ID='$driver_ID' ";
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
$send_map .= "{lat:" . $latitude . ",lng:" . $longitude . "}";

echo json_encode($send_map);
