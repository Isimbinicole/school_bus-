<?php 
	// database connection
include '../../includes/db_conn.php';
$valid = array('success' => false, 'messages' => array());
$student_name=mysqli_escape_string($conn,$_POST['student_name']);
$card=mysqli_escape_string($conn,$_POST['card']);
$sex=mysqli_escape_string($conn,$_POST['sex']);
$bod=mysqli_escape_string($conn,$_POST['bod']);
$type = explode('.', $_FILES['student_image']['name']);
$type = $type[count($type) - 1];
$img1= uniqid(rand()) . '.' . $type;
$url = '../../images/students/' .$img1;


if ($type=='') {
	$valid['success'] = false;
	$valid['messages'] = "Please choose  an image ! ";
}
else{

	if ($student_name=='') {
		$valid['success'] = false;
		$valid['messages'] = "Please enter student's name  ";
	}
	else{

		if ($sex=='-- choose sex --') {
			$valid['success'] = false;
			$valid['messages'] = "Please choose sex  ";
		}
		else{
			
			if (!strtotime($bod)) {
				$valid['success'] = false;
				$valid['messages'] = "Enter a valid date";
			}
			else {
				

				if ($card=='') {
					$valid['success'] = false;
					$valid['messages'] = "Please enter card number  ";
				}
				else{


					if(in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {

						if(is_uploaded_file($_FILES['student_image']['tmp_name'])) {
							if(move_uploaded_file($_FILES['student_image']['tmp_name'], $url)) {
								 $parent_ID=urldecode(base64_decode($_GET['p'])/2021);
								 $bod=strtotime($bod);
 
				// insert into database                              
$time=time();

								$sql = "INSERT INTO `students`(`student_ID`, `student_names`, `profile_image`, `DOB`, `sex`, `card_number`, `parent_ID`,`date_added`, `status`) VALUES (NULL,'$student_name','$img1','$bod','$sex','$card','$parent_ID','$time','1')";

								if($conn->query($sql) === TRUE) {
									$valid['success'] = true;
									$valid['messages'] = "student sucessfully registered ";
								} 
								else {
									$valid['success'] = false;
									$valid['messages'] = "Error while recording the data ";
								}



							}
							else {
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
