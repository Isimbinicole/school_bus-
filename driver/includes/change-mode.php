
<?php
include '../../includes/db_conn.php';
$valid = array('success' => false, 'messages' => array(), "mode" => "");
$sql = "SELECT * FROM `mode` limit 1";
$exe = $conn->query($sql);
if ($exe->num_rows == 0) {
    $sql2 = "INSERT INTO `mode`(`m_id`, `mode`) VALUES (NULL,'0')";
    $exe2 = $conn->query($sql2);
} else {
    while ($row = $exe->fetch_array()) {
        $mode = $row['mode'];
    }
}
$mode == 1 ? $mode = 0 : $mode = 1;
$sql = "UPDATE `mode` SET `mode` = '$mode' WHERE `mode`.`m_id` = 1 ";
$exe = $conn->query($sql);
if ($exe) {
    $msg = $mode == 1 ? "exit" : "entry";
    $valid['success'] = true;
    $valid['messages'] = " Mode set to $msg successfuly";
    $valid['mode'] = $mode;
} else {
    $valid['success'] = false;
    $valid['messages'] = "Failed please try again ";
}
echo json_encode($valid);

?>