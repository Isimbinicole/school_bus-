<?php
header("Content-Type: application/json");
include '../database/db_config.php'; // Adjust path to your DB connection

// === Decode JSON input ===
$data = json_decode(file_get_contents("php://input"), true);
$card = isset($data['card']) ? $data['card'] : '';
$bus_ID = isset($data['busID']) ? $data['busID'] : 1;

if (!$card) {
    echo json_encode(["status" => 1, "message" => "Card data missing"]);
    exit;
}

$studentName = $DOB = $sex = $phone = "";
$lat = $long = $driver_ID = $seats = "";
$error = 0;

// === Check if student exists ===
$sql = "SELECT * FROM `students` WHERE card_number='$card'";
$exe = $conn->query($sql);

if ($exe->num_rows > 0) {
    $student = $exe->fetch_assoc();
    $student_ID = $student['student_ID'];
    $parent_ID = $student['parent_ID'];
    $studentName = $student['student_names'];
    $DOB = $student['DOB'];
    $sex = $student['sex'];

    // === Get parent phone number ===
    $parentSQL = "SELECT phone_number1 FROM `parents` WHERE parent_ID ='$parent_ID'";
    $parentRes = $conn->query($parentSQL);
    if ($parentRes && $parentRes->num_rows > 0) {
        $phone = $parentRes->fetch_assoc()['phone_number1'];
    }

    // === Get bus & driver details ===
    $busSQL = "SELECT * FROM bus AS b 
               INNER JOIN drivers AS d ON b.bus_ID = d.bus_ID 
               WHERE b.bus_ID='$bus_ID'";
    $busRes = $conn->query($busSQL);
    if ($busRes && $busRes->num_rows > 0) {
        $bus = $busRes->fetch_assoc();
        $lat = $bus['latitude'];
        $long = $bus['longitude'];
        $driver_ID = $bus['driver_ID'];
        $seats = $bus['seats'];
    }

    // === Get mode (0 = boarding, 1 = alighting) ===
    $modeRes = $conn->query("SELECT mode FROM `mode` LIMIT 1");
    $mode = $modeRes->fetch_assoc()['mode'];

    if ($mode == 0) {
        // === Boarding Mode ===
        $onboardSQL = "SELECT * FROM `data` WHERE status='1' AND student_ID='$student_ID'";
        $onboardRes = $conn->query($onboardSQL);
        $countSQL = "SELECT * FROM `data` WHERE status!='0'";
        $countRes = $conn->query($countSQL);
        $counts = $countRes->num_rows;

        if ($counts < $seats) {
            if ($onboardRes->num_rows > 0) {
                $error = 1; // Already onboard
            } else {
                $time = time();
                $insertSQL = "INSERT INTO `data` (`student_ID`, `board_time`, `driver_ID`, `status`) 
                              VALUES ('$student_ID', '$time', '$driver_ID', '1')";
                $conn->query($insertSQL);
                $msg = "Hello! Your child $studentName boarded the bus at " . date("H:i:s") . ".";
                sendSMS($phone, $msg);
            }
        } else {
            $error = 1; // Bus full
        }

    } else {
        // === Alighting Mode ===
        $statusSQL = "SELECT * FROM `data` WHERE status='1' AND student_ID='$student_ID'";
        $statusRes = $conn->query($statusSQL);
        if ($statusRes->num_rows > 0) {
            $time = time();
            $updateSQL = "UPDATE `data` 
                          SET `arrival_time`='$time', `longitude_d`='$long', `latitude_d`='$lat', `status`='0' 
                          WHERE status='1' AND student_ID='$student_ID'";
            $conn->query($updateSQL);
            $msg = "Hello! Your child $studentName reached school/home at " . date("H:i:s") . ".";
            sendSMS($phone, $msg);
        } else {
            $error = 1; // No active record to close
        }
    }

    echo json_encode([
        "status" => $error,
        "student_names" => $studentName,
        "DOB" => $DOB,
        "sex" => $sex
    ]);

} else {
    echo json_encode(["status" => 1, "message" => "Student not found"]);
}

function sendSMS($phone, $message) {
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.mista.io/sms',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => [
            'to' => "+25" . $phone,
            'from' => 'SMS 250',
            'unicode' => '0',
            'sms' => $message,
            'action' => 'send-sms'
        ],
        CURLOPT_HTTPHEADER => [
            'x-api-key: a02c7aaa-48a7-974d-901d-d6476d221271-152d9ab3'
        ]
    ]);

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
