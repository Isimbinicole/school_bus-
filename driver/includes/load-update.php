	<?php
	session_start();
	$driver_ID = $_SESSION['driver_ID'];
	include '../../includes/db_conn.php';
	if ($_GET['t'] == 'card') {


		$sql = "SELECT * FROM data WHERE driver_ID='$driver_ID'  ORDER BY data_ID DESC LIMIT 0,1";
		$exe = $conn->query($sql);
		$student_ID = $ontime = $offtime = $latitude = $longitude = $last_id = "";
		$mothers_names = $fathers_names = $stop_address = $home_address = $phone_number1p = $phone_number2p = $fathers_image = $mothers_image = "";
		$student_names = $student_image = $parent_ID = "";
		$fathers_image = 'father.png';
		$mothers_image = 'mother.png';
		$student_image = 'icon.png';
		if ($exe->num_rows > 0) {
			while ($row = $exe->fetch_array()) {
				$student_ID = $row['student_ID'];
				$ontime = $row['board_time'];
				$offtime = $row['arrival_time'];
				$latitude = $row['latitude_d'];
				$longitude = $row['longitude_d'];
				$last_id = $row['data_ID'];
			}
			$sql = "SELECT * FROM students WHERE student_ID='$student_ID'";
			$exe = $conn->query($sql);
			while ($row = $exe->fetch_array()) {
				$student_names = $row['student_names'];
				$student_image = $row['profile_image'];
				$parent_ID = $row['parent_ID'];
			}
			$sql = "SELECT * FROM parents WHERE parent_ID='$parent_ID'";
			$exe = $conn->query($sql);
			while ($row = $exe->fetch_array()) {
				$mothers_names = $row['mothers_names'];
				$fathers_names = $row['fathers_names'];


				$phone_number1p = $row['phone_number1'];
				$phone_number2p = $row['phone_number2'];
				$fathers_image = $row['fathers_img'];
				$mothers_image = $row['mothers_img'];

				if ($fathers_image == '') {
					$fathers_image = 'father.png';
				}
				if ($mothers_image == '') {
					$mothers_image = 'mother.png';
				}
			}
		} else {
		}
	?>
		<div class="row">
			<div class="col-md- col-lg-3">
				<div class="row">
					<div class="col-lg-12">
						<img src="../images/students/<?php echo $student_image; ?>" style="width: 150px;height:150px;border-radius: 50%;">
					</div>
					<div class="col-md-12 col-lg-12 " style=" font-size: 13px;margin-top:20px;">
						<b style="margin-top: 30px;">STUDENT NAMES : <?php echo $student_names; ?></b>
						<hr style="margin-top: 5px; margin-bottom: 5px;" class="bg-light">

						<br>
						<div class="col-md-12 col-lg-12 " style="font-weight: 500; margin-top:10px; font-size:12px !important; ">

							Entry time : <b><?php
											if ($ontime == "") {
												echo  "--:--";
											} else {
												echo date("H:m:i", $ontime);
											}


											?></b>
							<hr>

							&nbsp &nbsp&nbsp&nbsp

							Arrival time :
							<b><?php
								if (!($offtime == 0 || $offtime == '')) {

									echo date("H:m:i", $offtime);
								} else {
									echo "-----";
								}


								?></b>
							<br>
							<br>

						</div>

					</div>

				</div>
			</div>



			<div class="col-lg-9 col-md-9" style="font-size: 13px; font-weight: 300px;">
				<div class="row">
					<div class="col-lg-6">
						<b>Parents</b>
						<hr style="border-width: 2px ; margin-top: 5px;margin-bottom: 10px; " class="bg-light">
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="alert " style="font-size: 10px;font-weight:bold;">
									Father
									<hr>
									<img src="../images/parents/<?php echo $fathers_image; ?>" style="width:80px;height: 80px;border-radius: 50%;">
									<br>
									<?php echo $fathers_names; ?>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="alert " style="font-size: 10px; font-weight:bold;">
									Mother
									<hr>
									<img src="../images/parents/<?php echo $mothers_image; ?>" style="width:80px;height: 80px;border-radius: 50%;"><br>

									<?php echo $mothers_names; ?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6" style="font-size: 13px; font-weight: bold;">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<b>Guardians</b>
								<hr style=" margin-top: 5px;margin-bottom: 10px; " class="bg-light">
							</div>

							<?php
							$sql = "SELECT * FROM legal_guardians WHERE parent_ID='$parent_ID'";
							$exe = $conn->query($sql);
							if ($exe->num_rows > 0) {
								while ($row = $exe->fetch_array()) {
							?>
									<div class="col-md-12 col-lg-12">
										<div class="alert ">

											<img src="../images/guardians/<?php echo $row['g_profile_img']; ?>" style="width:80px;height: 80px;border-radius: 50%;">
											<br>
											<?php echo $row['g_names']; ?>
										</div>
									</div>
								<?php
								}
							} else {

								?>
								<p class="text-danger">No guardians registered </p>
							<?php
							}
							?>
						</div>
					</div>

				</div>
			</div>


		</div>


	<?php
	}
	if ($_GET['t'] == 'table') {

		$sql = $conn->query("SELECT *  FROM drivers WHERE driver_ID='$driver_ID' AND status='1'");
		while ($row = $sql->fetch_array()) {
			$bus_ID = $row['bus_ID'];
		}
		$sql = $conn->query("SELECT *  FROM bus WHERE bus_ID='$bus_ID' AND status='1'");
		while ($row = $sql->fetch_array()) {
			$plate_number = $row['plate_number'];
			$seats = $row['seats'];
		}
		$search_date = strtotime("today");
		$end_date = $search_date + (60 * 60 * 24);

		$sql = "SELECT * FROM data INNER JOIN students WHERE board_time>$search_date AND board_time<$end_date AND driver_ID='$driver_ID' AND data.status=!'0' AND data.student_ID=students.student_ID  ";
		$exe = $conn->query($sql);
		$total_b = $exe->num_rows;


	?>

		<table id="example1" class="table table-bordered table-sm " style="font-size: 13px;">
			<thead>
				<tr>
					<th>Profile </th>
					<th>Student </th>

					<th>Guardian Tel</th>



				</tr>
			</thead>
			<tbody>
				<?php
				$sql = "SELECT * FROM data WHERE status!='0' AND driver_ID='$driver_ID' ORDER BY data_ID DESC";
				$exe = $conn->query($sql);
				$count_seats = $exe->num_rows;
				$remaining_seats = $seats - $count_seats;
				$percentage = round(($remaining_seats * 100) / $seats);
				$percentage = 100 - $percentage;

				while ($row = $exe->fetch_array()) {
				?>
					<tr>

						<td>
							<?php
							$data_ID = $row['data_ID'];
							$student_ID = $row['student_ID'];
							$sql_select_student_info = "SELECT * FROM students WHERE student_ID='$student_ID'";
							$exe_select_student_info = $conn->query($sql_select_student_info);
							while ($row_student = $exe_select_student_info->fetch_array()) {
								$student_image = $row_student['profile_image'];
								$student_names = $row_student['student_names'];
								$parent_ID = $row_student['parent_ID'];
							}
							?>
							<img src="../images/students/<?php echo $student_image; ?>" style="width: 50px; height: 50px;border-radius: 50%;">


						</td>
						<td><?php echo $student_names; ?></td>


						<?php
						$sql_select_parent = "SELECT * FROM parents WHERE parent_ID='$parent_ID'";
						$exe_parent = $conn->query($sql_select_parent);
						while ($row_parent = $exe_parent->fetch_array()) {

							$tel1 = $row_parent['phone_number1'];
							$tel2 = $row_parent['phone_number2'];
						}


						?>




						<td><?php echo $tel1 . "<br>" . $tel2; ?></td>



					</tr>
				<?php
				}



				?>

			</tbody>

		</table>
		<script>
			$(function() {

				$("#example1").DataTable({
					"responsive": true,
					"lengthChange": true,
					"autoWidth": false,

				}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
				$('#example2').DataTable({
					"paging": true,
					"lengthChange": true,
					"searching": true,
					"ordering": true,
					"info": true,
					"autoWidth": false,
					"responsive": true,
				});

			});
		</script>

		<script type="text/javascript">
			$(".on-board").text("<?php echo $count_seats; ?>");
			$(".on-board-total").text("<?php echo $total_b; ?>");
		</script>

	<?php
	}
	?>