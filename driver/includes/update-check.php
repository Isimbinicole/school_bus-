<?php
session_start();
$driver_ID = $_SESSION['driver_ID'];
include '../../includes/db_conn.php';
$sql = "SELECT * FROM data WHERE driver_ID='$driver_ID' and status='1' ";
$exe = $conn->query($sql);
echo $exe->num_rows;
