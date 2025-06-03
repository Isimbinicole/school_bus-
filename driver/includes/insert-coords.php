
<?php

session_start();
if (!isset($_SESSION['driver_ID'])) {
    header("location:../index.php");
} else {
    $driver_ID = $_SESSION['driver_ID'];
}
include '../../includes/db_conn.php';
$lat = $_GET['lat'];
$long = $_GET['long'];
$sql = "SELECT * FROM `drivers` as d inner join `bus` as b on d.bus_ID=b.bus_ID WHERE driver_ID='$driver_ID'";
$exe = $conn->query($sql);
while ($row = $exe->fetch_array()) {
    $bus_ID = $row['bus_ID'];
}

$sql = "UPDATE `bus` SET `longitude`='$long',`latitude`='$lat' WHERE bus_ID='$bus_ID'";
$exe = $conn->query($sql);


?>