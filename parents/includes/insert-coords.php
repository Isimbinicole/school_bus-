
<?php
session_start();
if (!isset($_SESSION['parent_ID'])) {
    header("location:../index.php");
} else {
    $parent_ID = $_SESSION['parent_ID'];
}
include '../../includes/db_conn.php';
$lat = $_GET['lat'];
$long = $_GET['long'];

$sql = "UPDATE `parents` SET `latitude`='$lat',`longitude`='$long' WHERE parent_ID='$parent_ID'";
$exe = $conn->query($sql);
if ($exe) {
    $success = true;
} else {
    $success = false;
}
$out = array("success" => $success);
echo json_encode($out);

?>