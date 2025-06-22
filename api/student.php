<?php
// student.php
include '../includes/db_conn.php';

$card_number = $_POST['card_number'];

$query = "SELECT student_names, DOB, sex FROM students WHERE card_number = '$card_number'";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode([
        'status' => 'success',
        'student_names' => $row['student_names'],
        'DOB' => $row['DOB'],
        'sex' => $row['sex']
    ]);
} else {
    echo json_encode(['status' => 'not_found']);
}
?>
