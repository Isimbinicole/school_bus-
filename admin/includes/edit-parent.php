<?php
// database connection
include '../../includes/db_conn.php';
$parent_ID = mysqli_escape_string($conn, $_GET['id']);
$valid = array('success' => false, 'messages' => array());
$father_name = mysqli_escape_string($conn, $_POST['father_name']);
$father_nid = mysqli_escape_string($conn, $_POST['father_nid']);
$mother_name = mysqli_escape_string($conn, $_POST['mother_name']);
$mother_nid = mysqli_escape_string($conn, $_POST['mother_nid']);
$email = mysqli_escape_string($conn, $_POST['email']);
$phone = mysqli_escape_string($conn, $_POST['phone']);
$phone2 = mysqli_escape_string($conn, $_POST['phone2']);
$type = explode('.', $_FILES['father_image']['name']);
$type = $type[count($type) - 1];
$img1 = uniqid(rand()) . '.' . $type;
$url = '../../images/parents/' . $img1;
$type2 = explode('.', $_FILES['mother_image']['name']);
$type2 = $type2[count($type2) - 1];
$img2 = uniqid(rand()) . '.' . $type2;
$url2 = '../../images/parents/' . $img2;

if ($type == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please choose  an image ! ";
} else {

    if ($father_name == '') {
        $valid['success'] = false;
        $valid['messages'] = "Please enter father's name  ";
    } else {

        if ($father_nid == '') {
            $valid['success'] = false;
            $valid['messages'] = "Please enter father's NID  ";
        } else {
            if ($mother_name == '') {
                $valid['success'] = false;
                $valid['messages'] = "Please enter mother's name  ";
            } else {
                if ($mother_nid == '') {
                    $valid['success'] = false;
                    $valid['messages'] = "Please enter mother's NID  ";
                } else {
                    if ($type2 == '') {
                        $valid['success'] = false;
                        $valid['messages'] = "Please choose mother's image   ";
                    } else {
                        if ($email == '') {
                            $valid['success'] = false;
                            $valid['messages'] = "Please enter email  ";
                        } else {
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $valid['success'] = false;
                                $valid['messages'] = "Invalid email address ";
                            } else {
                                if (preg_match("/^[a-zA-Z ]*$/", $phone)) {
                                    $valid['success'] = false;
                                    $valid['messages'] = "Phone number must not contain charachers and white spaces ";
                                } else {
                                    $pn = substr($phone, 0, 3);
                                    if (!($pn == '078' || $pn == '072' || $pn == '073')) {
                                        $valid['success'] = false;
                                        $valid['messages'] = "Invalid first phone number , a valid phone number must start with [078,073 or 072 ] and must be 10 in total ";
                                    } else {
                                        if (strlen($phone) > 10 || strlen($phone) < 10) {
                                            $valid['success'] = false;
                                            $valid['messages'] = "Invalid  phone number , must be ten numbers  ";
                                        } else {
                                            if (preg_match("/^[a-zA-Z ]*$/", $phone2)) {
                                                $valid['success'] = false;
                                                $valid['messages'] = "Phone number must not contain charachers and white spaces ";
                                            } else {
                                                $pn = substr($phone2, 0, 3);
                                                if (!($pn == '078' || $pn == '072' || $pn == '073' || $pn == '079')) {
                                                    $valid['success'] = false;
                                                    $valid['messages'] = "Invalid first phone number , a valid phone number must start with [078,073 or 072,079 ] and must be 10 in total ";
                                                } else {
                                                    if (strlen($phone2) > 10 || strlen($phone2) < 10) {
                                                        $valid['success'] = false;
                                                        $valid['messages'] = "Invalid  phone number , must be ten numbers  ";
                                                    } else {



                                                        if (in_array($type, array('gif', 'jpg', 'jpeg', 'png')) && in_array($type2, array('gif', 'jpg', 'jpeg', 'png'))) {

                                                            if (is_uploaded_file($_FILES['father_image']['tmp_name']) && is_uploaded_file($_FILES['mother_image']['tmp_name'])) {
                                                                if (move_uploaded_file($_FILES['father_image']['tmp_name'], $url) && move_uploaded_file($_FILES['mother_image']['tmp_name'], $url2)) {
                                                                    // insert into database                           
                                                                    $date = time();
                                                                    $sql = "UPDATE `parents` SET `mothers_names`='$mother_name',`fathers_names`='$father_name',`fathers_NID`='$father_nid',`mothers_NID`='$mother_nid',`email`='$email',`phone_number1`='$phone',`phone_number2`='$phone2',`fathers_img`='$img1',`mothers_img`='$img2' WHERE parent_ID='$parent_ID' ";

                                                                    if ($conn->query($sql) === TRUE) {
                                                                        $valid['success'] = true;
                                                                        $valid['messages'] = "Parent profile sucessfuly updated  ";
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
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
echo json_encode($valid);
	// upload the file 
