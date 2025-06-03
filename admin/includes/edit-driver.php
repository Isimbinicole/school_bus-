<?php
// database connection
include '../../includes/db_conn.php';
$driver_ID = $_GET['id'];
$valid = array('success' => false, 'messages' => array());
$driver_name = mysqli_escape_string($conn, $_POST['driver_name']);
$driver_nid = mysqli_escape_string($conn, $_POST['driver_nid']);
$plate_number = mysqli_escape_string($conn, $_POST['plate_number']);
$email = mysqli_escape_string($conn, $_POST['email']);
$phone = mysqli_escape_string($conn, $_POST['phone']);
$phone2 = mysqli_escape_string($conn, $_POST['phone2']);
$type = explode('.', $_FILES['driver_image']['name']);
$type = $type[count($type) - 1];
$img1 = uniqid(rand()) . '.' . $type;
$url = '../../images/driver/' . $img1;


if ($type == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please choose  an image ! ";
} else {

    if ($driver_name == '') {
        $valid['success'] = false;
        $valid['messages'] = "Please enter driver's name  ";
    } else {

        if ($driver_nid == '') {
            $valid['success'] = false;
            $valid['messages'] = "Please enter father's NID  ";
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
                        if (!($pn == '078' || $pn == '072' || $pn == '073' || $pn == '079')) {
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
                                        $valid['messages'] = "Invalid first phone number , a valid phone number must start with [078,073 or 072 ] and must be 10 in total ";
                                    } else {
                                        if (strlen($phone2) > 10 || strlen($phone2) < 10) {
                                            $valid['success'] = false;
                                            $valid['messages'] = "Invalid  phone number , must be ten numbers  ";
                                        } else {

                                            if ($plate_number == '-- choose bus --') {
                                                $valid['success'] = false;
                                                $valid['messages'] = "Please choose plate number ";
                                            } else {


                                                if (in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {

                                                    if (is_uploaded_file($_FILES['driver_image']['tmp_name'])) {
                                                        if (move_uploaded_file($_FILES['driver_image']['tmp_name'], $url)) {

                                                            // insert into database                              

                                                            $sql = "SELECT * FROM bus WHERE plate_number='$plate_number'";
                                                            $exe = $conn->query($sql);
                                                            while ($row = $exe->fetch_array()) {
                                                                $bus_ID = $row['bus_ID'];
                                                            }
                                                            $time = time();

                                                            $sql = "UPDATE `drivers` SET `driver_names`='$driver_name',`driver_NID`='$driver_nid',`driver_image`='$img1',`email`='$img1',`phone_number1`='$phone',`phone_number2`='$phone2',`bus_ID`='$bus_ID' WHERE driver_ID='$driver_ID'";

                                                            if ($conn->query($sql) === TRUE) {
                                                                $valid['success'] = true;
                                                                $valid['messages'] = "Driver profile  sucessfully updated  ";
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
echo json_encode($valid);
	// upload the file 
