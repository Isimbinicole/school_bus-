<?php
include '../database/db_config.php';

$data = json_decode(file_get_contents("php://input"), true);
$card = isset($data['card']) ? strtoupper(trim($conn->real_escape_string($data['card']))) : '';

if (!$card) {
    echo json_encode([
        "status" => 1,
        "message" => "Card UID not provided"
    ]);
    exit;
}

// Log incoming UID
file_put_contents(__DIR__ . "/debug.log", "Received Card: $card\n", FILE_APPEND);

// Query student info
$sql = "SELECT * FROM `students` WHERE `card_number` = '$card'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $student = $result->fetch_assoc();

    // Get location if available
    $latitude = "";
    $longitude = "";
    $sql_bus = "SELECT latitude, longitude FROM `bus` LIMIT 1";
    $bus_result = $conn->query($sql_bus);
    if ($bus_result && $bus_result->num_rows > 0) {
        $bus = $bus_result->fetch_assoc();
        $latitude = $bus['latitude'];
        $longitude = $bus['longitude'];
    }

    // Build image path (adjust if images folder is different)
    $image_path = "http://nicole1-001-site1.jtempurl.com/images/" . $student['profile_image'];

    // Respond with full info
    echo json_encode([
        "status" => 0,
        "student_names" => $student['student_names'],
        "DOB" => $student['DOB'],
        "sex" => $student['sex'],
        "profile_image" => $image_path,
        "latitude" => $latitude,
        "longitude" => $longitude
    ]);
} else {
    echo json_encode([
        "status" => 1,
        "message" => "Student Not Found",
        "card_received" => $card
    ]);
}
?>
