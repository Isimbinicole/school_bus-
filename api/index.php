<?php
include '../includes/db_conn.php';
$card = @$_GET['card'];
$bus_ID = @$_GET['busID'];

$sql = "SELECT * FROM `data` WHERE status!='0' ";
$exe = $conn->query($sql);
$counts = $exe->num_rows;

$sql = "SELECT * FROM `students` where card_number='$card'";
$exe = $conn->query($sql);
$error = 0;



if ($exe->num_rows > 0) {
    while ($row = $exe->fetch_array()) {
        $student_ID = $row['student_ID'];
        $parent_ID = $row['parent_ID'];
        $studentName = $row['student_names'];
    }

    $sql = "SELECT * FROM `parents` WHERE parent_ID ='$parent_ID'";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $phone = $row['phone_number1'];
    }

    $sql = "SELECT * FROM bus as b inner join drivers as d on b.bus_ID=d.bus_ID where b.bus_ID='$bus_ID'";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $lat = $row['latitude'];
        $long = $row['longitude'];
        $driver_ID = $row['driver_ID'];
        $seats = $row['seats'];
    }


    $sql = "SELECT * FROM `mode`";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $mode = $row['mode'];
    }
    if ($mode == 0) {
        $sql = "SELECT * FROM `data` WHERE status='1' AND student_ID='$student_ID'";
        $exe = $conn->query($sql);
        if ($counts <= $seats) {
            if ($exe->num_rows > 0) {
                $error = 1;
            } else {
                $time = time();
                $sql = "INSERT INTO `data`(`data_ID`, `student_ID`, `board_time`, `arrival_time`, `longitude_d`, `latitude_d`, `driver_ID`, `status`) VALUES (NULL,'$student_ID','$time','','','','$driver_ID','1')";
                $exe = $conn->query($sql);
                $error = 0;
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.mista.io/sms',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array('to' => "+25" . $phone, 'from' => 'SMS 250', 'unicode' => '0', 'sms' => "Hello  ! Your child " . $studentName . "  taped a card on  the bus  now at  " . date(" H:i:s") . "   If there are available guardians, they must be ready to pick up your child", 'action' => 'send-sms'),
                    CURLOPT_HTTPHEADER => array(
                        'x-api-key: a02c7aaa-48a7-974d-901d-d6476d221271-152d9ab3'
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
            }
        } else {
            $error = 1;
        }
    } else {
        $sql = "SELECT * FROM `data` WHERE status='1' ";
        $exe = $conn->query($sql);
        if ($exe->num_rows > 0) {
            $time = time();
            $sql = "UPDATE `data` SET `arrival_time`='$time',`longitude_d`='$long',`latitude_d`='$lat',`status`='0' WHERE `status`='1' AND student_ID='$student_ID'";
            $exe = $conn->query($sql);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.mista.io/sms',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('to' => "+25" . $phone, 'from' => 'SMS 250', 'unicode' => '0', 'sms' => "Hello  ! Your child " . $studentName . "  has reached the destination  now at  " . date(" H:i:s") . ", to check more details login into the system", 'action' => 'send-sms'),
                CURLOPT_HTTPHEADER => array(
                    'x-api-key: a02c7aaa-48a7-974d-901d-d6476d221271-152d9ab3'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
        } else {
            $error = 1;
        }
    }
} else {
    $error = 1;
}
$out = array("status" => $error);
echo json_encode($out);
