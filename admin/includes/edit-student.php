<?php
// database connection
include '../../includes/db_conn.php';
$student_ID = $_GET['id'];
$valid = array('success' => false, 'messages' => array());
$student_name = mysqli_escape_string($conn, $_POST['student_name']);
$card = mysqli_escape_string($conn, $_POST['card']);
$sex = mysqli_escape_string($conn, $_POST['sex']);
$bod = mysqli_escape_string($conn, $_POST['bod']);
$type = explode('.', $_FILES['student_image']['name']);
$type = $type[count($type) - 1];
$img1 = uniqid(rand()) . '.' . $type;
$url = '../../images/students/' . $img1;


if ($type == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please choose  an image ! ";
} else {

    if ($student_name == '') {
        $valid['success'] = false;
        $valid['messages'] = "Please enter student's name  ";
    } else {

        if ($sex == '-- choose sex --') {
            $valid['success'] = false;
            $valid['messages'] = "Please choose sex  ";
        } else {

            if (!strtotime($bod)) {
                $valid['success'] = false;
                $valid['messages'] = "Enter a valid date";
            } else {


                if ($card == '') {
                    $valid['success'] = false;
                    $valid['messages'] = "Please enter card number  ";
                } else {


                    if (in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {

                        if (is_uploaded_file($_FILES['student_image']['tmp_name'])) {
                            if (move_uploaded_file($_FILES['student_image']['tmp_name'], $url)) {

                                $bod = strtotime($bod);

                                // insert into database                              
                                $time = time();

                                $sql = "UPDATE `students` SET `student_names`='$student_name',`profile_image`='$img1',`DOB`='$bod',`sex`='$sex',`card_number`='$card' WHERE student_ID='$student_ID'";

                                if ($conn->query($sql) === TRUE) {
                                    $valid['success'] = true;
                                    $valid['messages'] = "student profile sucessfully updated ";
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


echo json_encode($valid);
	// upload the file 
