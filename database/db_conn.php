<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_bus_tracking";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
date_default_timezone_set("Africa/Kigali");
?>