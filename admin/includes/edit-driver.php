<?php
// database connection
include '../../includes/db_conn.php';

$valid = array('success' => false, 'messages' => '');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $valid['messages'] = "Invalid or missing driver ID in URL";
    echo json_encode($valid);
    exit;
}

$driver_ID = intval($_GET['id']);

$driver_name = mysqli_escape_string($conn, $_POST['driver_name']);
$driver_nid = mysqli_escape_string($conn, $_POST['driver_nid']);
$plate_number = mysqli_escape_string($conn, $_POST['plate_number']);
$email = mysqli_escape_string($conn, $_POST['email']);
$phone = mysqli_escape_string($conn, $_POST['phone']);
$phone2 = mysqli_escape_string($conn, $_POST['phone2']);

// === Validation ===
if (empty($driver_name)) {
    $valid['messages'] = "Please enter driver's name";
} elseif (empty($driver_nid)) {
    $valid['messages'] = "Please enter driver's NID";
} elseif (empty($email)) {
    $valid['messages'] = "Please enter email";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $valid['messages'] = "Invalid email address";
} elseif (preg_match("/[a-zA-Z\s]/", $phone) || strlen($phone) != 10 || !in_array(substr($phone, 0, 3), ['078', '072', '073', '079'])) {
    $valid['messages'] = "Invalid phone number 1";
} elseif (preg_match("/[a-zA-Z\s]/", $phone2) || strlen($phone2) != 10 || !in_array(substr($phone2, 0, 3), ['078', '072', '073', '079'])) {
    $valid['messages'] = "Invalid phone number 2";
} elseif ($plate_number === '-- choose bus --') {
    $valid['messages'] = "Please choose a plate number";
} else {
    // Fetch bus_ID using plate number
    $sql = "SELECT bus_ID FROM bus WHERE plate_number='$plate_number'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $bus = $result->fetch_assoc();
        $bus_ID = $bus['bus_ID'];

        // Update driver details
        $update_sql = "UPDATE drivers SET 
            driver_names = '$driver_name',
            driver_NID = '$driver_nid',
            email = '$email',
            phone_number1 = '$phone',
            phone_number2 = '$phone2',
            bus_ID = '$bus_ID'
            WHERE driver_ID = '$driver_ID'";

        if ($conn->query($update_sql) === TRUE) {
            $valid['success'] = true;
            $valid['messages'] = "Driver profile successfully updated.";
        } else {
            $valid['messages'] = "Error while updating data: " . $conn->error;
        }
    } else {
        $valid['messages'] = "Bus not found with provided plate number.";
    }
}

echo json_encode($valid);
?>
