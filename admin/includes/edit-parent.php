<?php
// database connection
include '../../includes/db_conn.php';

$parent_ID = mysqli_escape_string($conn, $_GET['id']);
$valid = array('success' => false, 'messages' => array());

$father_name = mysqli_escape_string($conn, $_POST['father_name']);
$father_nid = mysqli_escape_string($conn, $_POST['father_nid']);
$mother_name = mysqli_escape_string($conn, $_POST['mother_name']);
$mother_nid = mysqli_escape_string($conn, $_POST['mother_nid']);
$email = mysqli_escape_string($conn, $_POST['email']);
$phone = mysqli_escape_string($conn, $_POST['phone']);
$phone2 = mysqli_escape_string($conn, $_POST['phone2']);

if ($father_name == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please enter father's name";
} elseif ($father_nid == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please enter father's NID";
} elseif ($mother_name == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please enter mother's name";
} elseif ($mother_nid == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please enter mother's NID";
} elseif ($email == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please enter email";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $valid['success'] = false;
    $valid['messages'] = "Invalid email address";
} elseif (preg_match("/^[a-zA-Z ]*$/", $phone)) {
    $valid['success'] = false;
    $valid['messages'] = "Phone number must not contain characters or white spaces";
} elseif (!in_array(substr($phone, 0, 3), ['078', '072', '073']) || strlen($phone) != 10) {
    $valid['success'] = false;
    $valid['messages'] = "Invalid first phone number. It must start with [078, 073, or 072] and be 10 digits";
} elseif (preg_match("/^[a-zA-Z ]*$/", $phone2)) {
    $valid['success'] = false;
    $valid['messages'] = "Second phone number must not contain characters or white spaces";
} elseif (!in_array(substr($phone2, 0, 3), ['078', '072', '073', '079']) || strlen($phone2) != 10) {
    $valid['success'] = false;
    $valid['messages'] = "Invalid second phone number. It must start with [078, 073, 072, or 079] and be 10 digits";
} else {
    $sql = "UPDATE `parents` SET 
                `mothers_names`='$mother_name',
                `fathers_names`='$father_name',
                `fathers_NID`='$father_nid',
                `mothers_NID`='$mother_nid',
                `email`='$email',
                `phone_number1`='$phone',
                `phone_number2`='$phone2'
            WHERE parent_ID='$parent_ID'";

    if ($conn->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Parent profile successfully updated";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while recording the data";
    }
}

echo json_encode($valid);
?>
