<?php
session_start();
if (!isset($_SESSION['driver_ID'])) {
	header("location:../index.php");
} else {
	$driver_ID = $_SESSION['driver_ID'];
}
include '../includes/db_conn.php'; // the  connection to the database

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>School bus tracking system</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../dist/css/adminlte.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
	<!-- summernote -->
	<link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
	<style type="text/css">
		.card-title {
			font-weight: 500 !important;
			font-size: 15px;
		}
	</style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<!-- Preloader
		<div class="preloader flex-column justify-content-center align-items-center">

			<img class="img img-circle bg-info" src="../images/development/loader.SVG" alt="Enlighten tech" height="50" width="50">
		</div> -->

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>


			</ul>

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">


				<li class="nav-item">
					<a class="nav-link" data-widget="fullscreen" href="#" role="button">
						<i class="fas fa-expand-arrows-alt"></i>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="includes/logout.php" role="button">
						<i class="fa fa-power-off"></i>
					</a>
				</li>

			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="index.html" class="brand-link">
				<i class="fa fa-bus  img-circle elevation-3" style="opacity: .8;"></i>
				<!--      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">-->
				<span class="brand-text font-weight-light">SBM</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<?php    // to select the admin information       
						$sql = $conn->query("SELECT * FROM drivers WHERE driver_ID='$driver_ID'");
						while ($row = $sql->fetch_array()) {
							$driver_names = $row['driver_names'];
							$profile = $row['driver_image'];
						}
						?>
						<!-- end for the php script -->

						<img src="../images/driver/<?php echo $profile; ?>" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="#" class="d-block">
							<?php echo $driver_names; ?>
							<!-- to display the admin name -->
						</a>
					</div>
				</div>
				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item menu-open">
							<a href="index.php" class="nav-link active">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									Dashboard
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="report.php" class="nav-link">
								<i class="nav-icon fab  fa-sellsy"></i>
								<p>
									Report
								</p>
							</a>

						</li>

						<li class="nav-item">
							<a href="profile.php" class="nav-link">
								<i class="nav-icon fa fa-user"></i>
								<p>
									Profile

								</p>
							</a>

						</li>
					</ul>

				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h5 class="m-0">Dashboard</h5>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Dashboard </li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<!-- Small boxes (Stat box) -->
					<div class="row">
						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-light">
								<div class="inner">

									<h4 class="digital-clocks"></h4>

									<p><?php echo date("D d-m-Y"); ?></p>
								</div>
								<div class="icon">
									<i class="fas fa-clock"></i>
								</div>

							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-info">
								<div class="inner">
									<?php
									$sql = $conn->query("SELECT *  FROM drivers WHERE driver_ID='$driver_ID' AND status='1'");
									while ($row = $sql->fetch_array()) {
										$bus_ID = $row['bus_ID'];
									}
									$sql = $conn->query("SELECT *  FROM bus WHERE bus_ID='$bus_ID' AND status='1'");
									while ($row = $sql->fetch_array()) {
										$plate_number = $row['plate_number'];
										$seats = $row['seats'];
									}
									?>
									<h4><?php echo $plate_number; ?></h4>

									<p>Plate number</p>
								</div>
								<div class="icon">
									<i class="fas fa-flag"></i>
								</div>

							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-success">
								<div class="inner">

									<h4><?php echo $seats; ?></h4>

									<p>Seats</p>
								</div>
								<div class="icon">
									<i class="fas fa-chair"></i>
								</div>

							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-warning">
								<div class="inner">
									<?php
									$search_date = strtotime("today");
									$end_date = $search_date + (60 * 60 * 24);

									$sql = "SELECT * FROM data INNER JOIN students WHERE driver_ID='$driver_ID' AND data.status!='0' AND data.student_ID=students.student_ID  ";
									$exe = $conn->query($sql);
									$total_b = $exe->num_rows;

									?>
									<h4 class="on-board"><?php echo $total_b; ?></h4>

									<p>On board students</p>
								</div>
								<div class="icon">
									<i class="fa fa-users"></i>
								</div>

							</div>
						</div>

						<!-- ./col -->
					</div>
					<!-- /.row -->
					<!-- Main row -->
					<div class="row">

						<section class="col-lg-12 connectedSortable">
							<?php
							$sql = "SELECT * FROM  mode LIMIT 1";
							$exe = $conn->query($sql);
							while ($row = $exe->fetch_array()) {
								if ($row['mode'] == 0) {
							?>
									<b>Mode:</b> &nbsp&nbsp<button class="btn btn-danger change-mode ">Entry</button>
								<?php
								} else {
								?>
									<b>Mode:</b> &nbsp&nbsp<button class="btn btn-danger change-mode ">Exit </button>
							<?php
								}
							}

							?>


							<div class="modal fade" id="modal-lg">
								<div class="modal-dialog modal-lg">
									<div class="modal-content bg-gradient-light ">
										<div class="modal-header">
											<h6 class="modal-title">Recent tapped card info</h6>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">






											<div class="recent-info">
												<?php
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
											</div>



										</div>

									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>

						</section>


						<!-- Left col -->
						<section class="col-lg-6 connectedSortable">


							<!-- Map card -->

							<!-- Map card -->
							<div class="card bg-gradient-light">
								<div class="card-header border-0">
									<h3 class="card-title">
										<i class="fas fa-map-marker-alt mr-1"></i>
										Bus location
									</h3>
									<!-- card tools -->
									<div class="card-tools">

										<button type="button" class="btn  btn-sm" data-card-widget="collapse" title="Collapse">
											<i class="fas fa-minus"></i>
										</button>
									</div>
									<!-- /.card-tools -->
								</div>
								<div class="card-body " style="height: 450px;">
									<iframe src="./map-bus.php" width="100%" height="100%" frameborder="0"></iframe>
								</div>

							</div>
							<!-- /.card -->
						</section>
						<section class="col-lg-6 connectedSortable">
							<!-- Custom tabs (Charts with tabs)-->
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">
										<i class="fas fa-bus mr-1"></i>
										On board students
									</h3>
									<div class="card-tools">

										<button type="button" class="btn btn-tool" data-card-widget="collapse">
											<i class="fas fa-minus"></i>
										</button>

										<button type="button" class="btn btn-tool" data-card-widget="remove">
											<i class="fas fa-times"></i>
										</button>
									</div>
								</div><!-- /.card-header -->
								<div class="card-body load-table">
									<table id="example1" class="table table-bordered table-sm " style="font-size: 13px;">
										<thead>
											<tr>
												<!-- <th>Profile </th> -->
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

													<!-- <td>
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


													</td> -->
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
								</div><!-- /.card-body -->
							</div>
							<!-- /.card -->
							<!-- Map card -->
							<div class="card bg-gradient-light">
								<div class="card-header border-0">
									<h3 class="card-title">
										<i class="fas fa-map-marker-alt mr-1"></i>
										Students bus stop location
									</h3>
									<!-- card tools -->
									<div class="card-tools">

										<button type="button" class="btn  btn-sm" data-card-widget="collapse" title="Collapse">
											<i class="fas fa-minus"></i>
										</button>
									</div>
									<!-- /.card-tools -->
								</div>
								<div class="card-body students-map " style="height: 450px;">
									<iframe src="./map.php" width="100%" height="100%" frameborder="0"></iframe>
								</div>

							</div>
							<!-- /.card -->
						</section>
						<!-- /.Left col -->
						<!-- right col (We are only adding the ID to make the widgets sortable)-->

						<!-- right col -->
					</div>
					<!-- /.row (main row) -->
				</div><!-- /.container-fluid -->
				<div class="col-md-12 col-lg-12">
					<?php
					$sql = "SELECT * FROM data WHERE driver_ID='$driver_ID' and status='1' ";
					$exe = $conn->query($sql);
					$count = $exe->num_rows;
					?>
					<div class="check-refresh" style="display: none;"><?php echo $count; ?></div>
					<div class="delete-load" style="display: none;"></div>

				</div>

			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<strong>Copyright &copy; 2025 </strong>
			All rights reserved.

		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="../plugins/jquery/jquery.js"></script>
	<script src="../plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- ChartJS -->
	<script src="../plugins/chart.js/Chart.min.js"></script>
	<!-- Sparkline -->
	<script src="../plugins/sparklines/sparkline.js"></script>
	<!-- JQVMap -->
	<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="../plugins/moment/moment.min.js"></script>
	<script src="../plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Summernote -->
	<script src="../plugins/summernote/summernote-bs4.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="../dist/js/adminlte.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="../dist/js/demo.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="../dist/js/pages/dashboard.js"></script>

	<!-- DataTables  & Plugins -->
	<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
	<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="../plugins/jszip/jszip.min.js"></script>
	<script src="../plugins/pdfmake/pdfmake.min.js"></script>
	<script src="../plugins/pdfmake/vfs_fonts.js"></script>
	<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
	<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
	<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
	<!-- Toastr -->
	<script src="../plugins/toastr/toastr.min.js"></script>
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
		$(document).ready(function() {
			//$(".map").load("./map.php");
			setInterval(function() {
				//$(".map").load("./map.php");
			}, 20000);
		});
	</script>
	<script type="text/javascript">
		setInterval(function() {

			var htmlcontent = $('.check-refresh').text();
			$.ajax({
				type: "GET",
				datatype: "text",
				url: "includes/update-check.php",
				success: function(data) {
					if (htmlcontent != data) {
						$(".students-map").html(`<iframe src="./map.php" width="100%" height="100%" frameborder="0"></iframe>`);
						$('#modal-lg').modal('show');
						$('.check-refresh').text(data);
						$(".recent-info").load("includes/load-update.php?t=card");
						$(".load-table").load("includes/load-update.php?t=table");

					}
				}
			});

		}, 1000);
	</script>
	<script type="text/javascript">

	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			clockUpdate();
			setInterval(clockUpdate, 1000);
		})


		let userLocation = navigator.geolocation;

		function myGeolocator() {
			if (userLocation) {
				userLocation.getCurrentPosition(success);
			} else {
				"The geolocation API is not supported by your browser.";
			}
		}

		function success(data) {
			let lat = data.coords.latitude;
			let long = data.coords.longitude;
			//insert the driver location in the maps 
			fetch(`./includes/insert-coords.php?lat=${lat}&long=${long}`)
				.then((resp) => {
					return resp.json();
				}).then((backData) => {
					const gotData = backData;



				})

		}
		myGeolocator();
		setInterval(() => {
			myGeolocator();
		}, 10000);

		$(".change-mode").click(function() {
			fetch("./includes/change-mode.php")
				.then((resp) => {
					return resp.json();
				}).then((backData) => {
					const gotData = backData;
					if (gotData.success == true) {
						$(document).Toasts('create', {
							class: 'bg-success',
							title: 'success',
							subtitle: '',
							body: gotData.messages
						});
						if (gotData.mode == 1) {
							$(".change-mode").text(`exit`);
						} else {
							$(".change-mode").text(`entry`);
						}
					} else {
						toastr.error(response.messages);
					}


				})
		})

		function clockUpdate() {
			var date = new Date();

			function addZero(x) {
				if (x < 10) {
					return x = '0' + x;
				} else {
					return x;
				}
			}


			var h = addZero(date.getHours());
			var m = addZero(date.getMinutes());
			var s = addZero(date.getSeconds());

			$('.digital-clocks').text(h + ':' + m + ':' + s)
		}
	</script>
</body>

</html>