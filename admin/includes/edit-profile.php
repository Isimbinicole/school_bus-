<?php
// database connection
session_start();
if (!isset($_SESSION['admin_ID'])) {
    header("location:../index.php");
} else {
    $admin_ID = $_SESSION['admin_ID'];
}
include '../../includes/db_conn.php';

$valid = array('success' => false, 'messages' => array());
$admin_name = mysqli_escape_string($conn, $_POST['admin_name']);
$email = mysqli_escape_string($conn, $_POST['email']);
$type = explode('.', $_FILES['driver_image']['name']);
$type = $type[count($type) - 1];
$img1 = uniqid(rand()) . '.' . $type;
$url = '../../images/admin/' . $img1;


if ($type == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please choose  an image ! ";
} else {

    if ($admin_name == '') {
        $valid['success'] = false;
        $valid['messages'] = "Please enter your name  ";
    } else {


        if ($email == '') {
            $valid['success'] = false;
            $valid['messages'] = "Please enter email  ";
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $valid['success'] = false;
                $valid['messages'] = "Invalid email address ";
            } else {


                if (in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {

                    if (is_uploaded_file($_FILES['driver_image']['tmp_name'])) {
                        if (move_uploaded_file($_FILES['driver_image']['tmp_name'], $url)) {



                            $sql = "UPDATE `admin` SET `admin_names`='$admin_name',`profile`='$img1',`email`='$email' WHERE admin_ID='$admin_ID'";

                            if ($conn->query($sql) === TRUE) {
                                $valid['success'] = true;
                                $valid['messages'] = "profile  sucessfully updated  ";
                            } else {
                                $valid['success'] = false;
                                $valid['messages'] = "Error while recording the data ";
                            }
                        } else {
                            $valid['success'] = false;
                            $valid['messages'] = "Error while uploading";
                        }
                    }
                }
            }
        }
    }
}

echo json_encode($valid);
// upload the file 
