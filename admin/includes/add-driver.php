<?php
// database connection
include '../../includes/db_conn.php';
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

															$sql = "SELECT * FROM bus WHERE plate_number='$plate_number'";
															$exe = $conn->query($sql);
															while ($row = $exe->fetch_array()) {
																$bus_ID = $row['bus_ID'];
															}
															$time = time();

															$sql = "INSERT INTO `drivers`(`driver_ID`, `driver_names`, `driver_NID`, `driver_image`, `email`, `phone_number1`, `phone_number2`, `bus_ID`, `password`,`date_added`, `status`) VALUES (NULL,'$driver_name','$driver_nid','$img1','$email','$phone','$phone2','$bus_ID','$password','$time','1')";

															if ($conn->query($sql) === TRUE) {
																$valid['success'] = true;
																$valid['messages'] = "Driver sucessfully registered ";
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
echo json_encode($valid);
	// upload the file 
