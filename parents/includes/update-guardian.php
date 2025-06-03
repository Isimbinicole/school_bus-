<?php
session_start();
// database connection
include '../../includes/db_conn.php';
$parent_ID = $_SESSION['parent_ID'];
$g_ID = @$_GET['g_ID'];
$valid = array('success' => false, 'messages' => array());
$guardian_name = mysqli_escape_string($conn, $_POST['guardian_name']);
$type = explode('.', $_FILES['guardian_image']['name']);
$type = $type[count($type) - 1];
$img1 = uniqid(rand()) . '.' . $type;
$url = '../../images/guardians/' . $img1;


if ($type == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please choose  an image ! ";
} else {

    if ($guardian_name == '') {
        $valid['success'] = false;
        $valid['messages'] = "Please enter guardian's name  ";
    } else {

        if (in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {

            if (is_uploaded_file($_FILES['guardian_image']['tmp_name'])) {
                if (move_uploaded_file($_FILES['guardian_image']['tmp_name'], $url)) {


                    $time = time();
                    $sql = "UPDATE `legal_guardians` SET `g_names`='$guardian_name',`g_profile_img`='$img1' WHERE g_ID='$g_ID'";

                    if ($conn->query($sql) === TRUE) {
                        $valid['success'] = true;
                        $valid['messages'] = "Guardian sucessfully updated ";
                    } else {
                        $valid['success'] = false;
                        $valid['messages'] = "Error while updating the data ";
                    }
                } else {
                    $valid['success'] = false;
                    $valid['messages'] = "Error while uploading";
                }
            }
        }
    }
}

echo json_encode($valid);
	// upload the file 
