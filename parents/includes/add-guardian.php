<?php
session_start();
// database connection
include '../../includes/db_conn.php';
$parent_ID = $_SESSION['parent_ID'];
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
					$sql = "INSERT INTO `legal_guardians`(`g_ID`, `g_names`, `g_profile_img`, `parent_ID`,`date_added`, `status`) VALUES (NULL,'$guardian_name','$img1','$parent_ID','$time','1')";

					if ($conn->query($sql) === TRUE) {
						$valid['success'] = true;
						$valid['messages'] = "Guardian sucessfully registered ";
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

echo json_encode($valid);
	// upload the file 
