<?php
include '../includes/db_conn.php'; // DB connection

$card_number = $_POST['card_number'] ?? '';

if (!$card_number) {
    echo json_encode(['status' => 'error', 'message' => 'Card number is missing']);
    exit;
}

// Lookup student using card_number
$sql = "SELECT s.student_names, s.card_number, p.phone_number1 
        FROM students s
        JOIN parents p ON s.parent_ID = p.parent_ID
        WHERE s.card_number = '$card_number' AND s.status = 1";

$result = mysqli_query($conn, $sql);

if ($student = mysqli_fetch_assoc($result)) {
    $name = $student['student_names'];
    $phone = $student['phone_number1'];

    // SMS content
    $message = "$name has boarded the bus.";

    // Send SMS using Mista.io API
    $curl = curl_init();

    $data = [
        "recipient" => "+25" . $phone,
        "sender_id" => "E-Notifier",
        "type" => "plain",
        "message" => $message
    ];

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mista.io/sms',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: ' . 'Bearer YOUR_API_TOKEN_HERE'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    echo json_encode(['status' => 'success', 'message' => 'SMS sent', 'response' => $response]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Card not recognized or inactive']);
}
