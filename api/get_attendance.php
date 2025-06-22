<?php
header("Content-Type: application/json");
include '../database/db_config.php';

$data = json_decode(file_get_contents("php://input"), true);
$student_ID = isset($data['student_ID']) ? intval($data['student_ID']) : 0;

if ($student_ID <= 0) {
    echo json_encode(["status" => "error", "message" => "Invalid student_ID"]);
    exit;
}

$sql = "SELECT action_type, timestamp, bus_ID FROM attendance_log WHERE student_ID = $student_ID ORDER BY timestamp DESC";
$result = $conn->query($sql);

$logs = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $logs[] = [
            "action" => $row['action_type'],
            "time" => date("Y-m-d H:i:s", $row['timestamp']),
            "bus_ID" => $row['bus_ID']
        ];
    }
}

echo json_encode([
    "status" => "success",
    "logs" => $logs
]);
