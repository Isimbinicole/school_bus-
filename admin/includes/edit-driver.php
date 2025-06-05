<?php
include '../../includes/db_conn.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid or missing driver ID.");
}

$driver_id = intval($_GET['id']);

// Sanitize and get form data
$driver_name = $conn->real_escape_string($_POST['driver_name']);
$driver_nid = $conn->real_escape_string($_POST['driver_nid']);
$email = $conn->real_escape_string($_POST['email']);
$phone1 = $conn->real_escape_string($_POST['phone']);
$phone2 = $conn->real_escape_string($_POST['phone2']);
$plate_number = $conn->real_escape_string($_POST['plate_number']);

// Get the corresponding bus_ID from the plate number
$bus_query = $conn->query("SELECT bus_ID FROM bus WHERE plate_number = '$plate_number'");
if ($bus_query->num_rows === 0) {
    die("Selected bus not found.");
}
$bus_row = $bus_query->fetch_assoc();
$bus_ID = $bus_row['bus_ID'];

// Update driver info
$update_sql = "UPDATE drivers SET 
    driver_names = '$driver_name',
    driver_NID = '$driver_nid',
    email = '$email',
    phone_number1 = '$phone1',
    phone_number2 = '$phone2',
    bus_ID = '$bus_ID'
    WHERE driver_ID = $driver_id";

if ($conn->query($update_sql)) {
    echo "<script>alert('Driver updated successfully.'); window.location.href = '../drivers.php';</script>";
} else {
    echo "Error updating driver: " . $conn->error;
}

$conn->close();
?>
