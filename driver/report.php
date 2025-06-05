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
						<li class="nav-item ">
							<a href="index.php" class="nav-link ">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									Dashboard
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="report.php" class="nav-link active">
								<i class="nav-icon fab  fa-sellsy"></i>
								<p>
									Report


								</p>
							</a>

						</li>

						<li class="nav-item active">
							<a href="profile.php" class="nav-link ">
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
								<li class="breadcrumb-item active">Report </li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="card report-view">
						<div class="row  justify-content-center " style="padding: 20px;">
							<div class="col-md-9 col-lg-9">
							</div>
							<div class="col-md-3 col-lg-3">
								<input type="text" id="picker" class=" form-control form-control-sm picker" placeholder="Enter date " name="" style="float: right;height: 45px;border-radius: 10px;font-weight: 600;">



							</div>
							<div class="col-md-12 col-lg-12 " style="margin-top: 20px;">
								<!-- the division that contains the report results -->
								<?php
								$search_date = strtotime("today");
								$end_date = $search_date + (60 * 60 * 24);

								$sql = "SELECT * FROM data INNER JOIN students WHERE board_time>$search_date AND board_time<$end_date AND driver_ID='$driver_ID' AND data.student_ID=students.student_ID ";
								$exe = $conn->query($sql);

								?>
								<table id="example1" class="table table-bordered table-sm " style="font-size: 13px;">
									<thead>
										<tr>
											<th>Profile</th>
											<th>Student names</th>

											<th>Board time</th>
											<th>Arrival time</th>
											<th>view location</th>
										</tr>
									<tbody>
										<?php
										$cc = 1;
										while ($row = $exe->fetch_array()) {

											$student_names = $row['student_names'];
											$student_img = $row['profile_image'];
											$parent_ID = $row['parent_ID'];
											$board_time = $row['board_time'];
											$arrival_time = $row['arrival_time'];
											$long = $row['longitude_d'];
											$lat = $row['latitude_d'];
											$sql_select_parent_info = "SELECT * FROM parents WHERE parent_ID='$parent_ID'";
											$exe_parent_query = $conn->query($sql_select_parent_info);
											while ($fetch_data = $exe_parent_query->fetch_array()) {
												$latitude = $fetch_data['latitude'];
												$longitude = $fetch_data['longitude'];
											}


										?>

											<tr>

												<td><img src="../images/students/<?php echo $student_img; ?>" style="width: 50px;height: 50px;border-radius: 50%;"></td>
												<td><?php echo $student_names; ?></td>

												<td><?php echo date("d-m-Y h:i:s", $board_time); ?></td>
												<td><?php if ($arrival_time != "") {
														echo  date("d-m-Y h:i:s", $arrival_time);
													}
													?></td>
												<td><button class="btn btn-sm btn-dark map" id="lat=<?php echo $lat; ?>&long=<?php echo $long; ?>" style="float: right;margin-right: 5px;"><i class="fas  fa-map-marker-alt"></i> View drop location</button></td>

											</tr>

										<?php
										}
										?>
									</tbody>
								</table>

							</div>


						</div>

						<!-- /.row -->

					</div>
					<div class="row ">
						<div class="col-md-12 col-lg-12 location-view" style="margin-top: 20px;display: none;">
							<div class=" alert bg-white " style="box-shadow: 1px 1px 5px grey;">
								<b class="header-map"></b>
								<i class="fa fa-times close-location" style="float: right;padding: 10px;cursor: pointer;"></i>

								<br>
								<hr>
								<div class="load-map" style="width: 100%;height: 100%;">

								</div>

							</div>
						</div>

					</div>
				</div><!-- /.container-fluid -->


			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<strong>Copyright &copy;2025 .</strong>
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


		});
	</script>
	<script type="text/javascript">
		$('#picker').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			autoApply: true,
			linkedCalendars: false,

		});
	</script>
	<script type="text/javascript">
		$("#picker").change(function() {
			var picker = $("#picker").val();
			$.post('includes/report-handler.php?t=d', {
				picker: picker
			}, function(data) {
				$(".report-view").html(data);
			});
		});
	</script>
	<script type="text/javascript">
		$(".map").click(function() {
			var mapz = $(this).attr('id');
			$(".load-map").load("includes/load-map.php?" + mapz);
			$(".report-view").slideToggle();
			$(".location-view").slideToggle();

		});
	</script>
	<script type="text/javascript">
		$(".close-location").click(function() {
			$(".report-view").slideToggle();
			$(".location-view").slideToggle();
		});
	</script>
</body>

</html>