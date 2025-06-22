<?php
// database connection
include '../../includes/db_conn.php';

$valid = array('success' => false, 'messages' => array());

$father_name = mysqli_escape_string($conn, $_POST['father_name']);
$father_nid = mysqli_escape_string($conn, $_POST['father_nid']);
$mother_name = mysqli_escape_string($conn, $_POST['mother_name']);
$mother_nid = mysqli_escape_string($conn, $_POST['mother_nid']);
$email = mysqli_escape_string($conn, $_POST['email']);
$phone = mysqli_escape_string($conn, $_POST['phone']);
$phone2 = mysqli_escape_string($conn, $_POST['phone2']);

// Input validations
if ($father_name == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please enter father's name";
} else if ($father_nid == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please enter father's NID";
} else if ($mother_name == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please enter mother's name";
} else if ($mother_nid == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please enter mother's NID";
} else if ($email == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please enter email";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $valid['success'] = false;
    $valid['messages'] = "Invalid email address";
} else if (preg_match("/^[a-zA-Z ]*$/", $phone)) {
    $valid['success'] = false;
    $valid['messages'] = "Phone number must not contain characters and white spaces";
} else if (!in_array(substr($phone, 0, 3), ['078', '072', '073']) || strlen($phone) != 10) {
    $valid['success'] = false;
    $valid['messages'] = "Invalid phone number. Must start with 078, 072, or 073 and be 10 digits long";
} else if (preg_match("/^[a-zA-Z ]*$/", $phone2)) {
    $valid['success'] = false;
    $valid['messages'] = "Second phone number must not contain characters and white spaces";
} else if (!in_array(substr($phone2, 0, 3), ['078', '072', '073', '079']) || strlen($phone2) != 10) {
    $valid['success'] = false;
    $valid['messages'] = "Invalid second phone number. Must start with 078, 072, 073, or 079 and be 10 digits long";
} else {
    // Generate random password
    $gensn = "";
    $possible = "1234567890qwertyuiopasdfghjklzxcvbnm@#$^&QWERTYUIOPASDFGHJKLZXCVBNM";
    $length = 6;

    while (strlen($gensn) < $length) {
        $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
        if (!strstr($gensn, $char)) {
            $gensn .= $char;
        }
    }

    $password = md5($gensn);
    $date = time();

    // Insert into database
    $sql = "INSERT INTO `parents`(`parent_ID`, `mothers_names`, `fathers_names`, `fathers_NID`, `mothers_NID`, `email`, `phone_number1`, `phone_number2`, `password`, `date_added`, `status`) 
            VALUES (NULL, '$mother_name', '$father_name', '$father_nid', '$mother_nid', '$email', '$phone', '$phone2', '$password', '$date', '1')";

    if ($conn->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Parent successfully registered";

        // Send SMS with account details
        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'http://api.mista.io/sms',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_POSTFIELDS => array(
        //         'recipient' => "+25" . $phone,
        //         'sender_id' => 'SMS 250',
        //         'message' => "Hello! Your account has been successfully created. Email: $email, Password: $gensn",
        //         'type' => 'plain'
        //     ),
        //     CURLOPT_HTTPHEADER => array(
        //         'Content-Type: application/json',
        //         'Authorization: 744|Mvd9lD8ynSVcvPicj3qu1dEJ2d9pup9tm76hMwVA'
        //     ),
        // ));
        // $response = curl_exec($curl);
        // curl_close($curl);
        // echo ($response);


        
        $curl = curl_init();

        $data = [
            "recipient" => "+25" . $phone, // Remove space between numbers
            "sender_id" => "E-Notifier",
            "type" => "plain",
            "message" => "Hello! Your account has been successfully created. Email: $email, Password: $gensn"
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mista.io/sms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 50,
            CURLOPT_TIMEOUT => 50,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data), // Use json_encode for safety
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer 744|Mvd9lD8ynSVcvPicj3qu1dEJ2d9pup9tm76hMwVA'
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $valid['messages'] .= " (SMS not sent: " . curl_error($curl) . ")";
        } else {
            $sms_response = json_decode($response, true);

            if (!isset($sms_response['status']) || $sms_response['status'] !== 'success') {
                $valid['messages'] .= " (SMS failed to send: " . ($sms_response['message'] ?? 'Unknown error') . ")";
            }
        }

        

        curl_close($curl);

    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while recording the data";
    }
}

echo json_encode($valid);


?>