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
																	$gensn = "";
																	$possible = "1234567890qwertyuiopasdfghjklzxcvbnm@#$^&QWERTYUIOPASDFGHJKLZXCVBNM";
																	$i = 0;
																	$length = 6;
																	while ($i < $length) {
																		$char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
																		if (!strstr($gensn, $char)) {
																			$gensn .= $char;
																			$i++;
																		}
																	}
																	$password = $gensn;
																	$password = md5($password);


																	// insert into database                           
																	$date = time();
																	$sql = "INSERT INTO `parents`(`parent_ID`, `mothers_names`, `fathers_names`, `fathers_NID`, `mothers_NID`, `email`, `phone_number1`, `phone_number2`, `password`, `fathers_img`, `mothers_img`,`date_added`, `status`) VALUES (NULL,'$mother_name','$father_name','$father_nid','$mother_nid','$email','$phone','$phone2','$password','$img1','$img2','$date','1')";

																	if ($conn->query($sql) === TRUE) {
																		$valid['success'] = true;
																		$valid['messages'] = "Parent sucessfully registered ";

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
																			CURLOPT_POSTFIELDS => array('to' => "+25" . $phone, 'from' => 'SMS 250', 'unicode' => '0', 'sms' => "Hello  ! Your account has been successfuly created, email: " . $email . " , password " . $gensn, 'action' => 'send-sms'),
																			CURLOPT_HTTPHEADER => array(
																				'x-api-key: a02c7aaa-48a7-974d-901d-d6476d221271-152d9ab3'
																			),
																		));

																		$response = curl_exec($curl);

																		curl_close($curl);
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
