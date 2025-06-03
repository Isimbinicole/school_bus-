<?php
session_start();
if (!isset($_SESSION['parent_ID'])) {
	header("location:../index.php");
} else {
	$parent_ID = $_SESSION['parent_ID'];
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

			<img class=" img-circle bg-info" src="../images/development/loader.svg" alt="Enlighten tech" height="50" width="50">
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

				<span class="brand-text font-weight-light">SBM</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">

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
						<li class="nav-item ">
							<a href="#" class="nav-link ">
								<i class="nav-icon fas fa-users"></i>
								<p>
									Guardians
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item ">
									<a href="add-guardian.php" class="nav-link ">
										<i class="fa fa-user-plus nav-icon"></i>
										<p>Add Guardian</p>
									</a>
								</li>
								<li class="nav-item menu-open ">
									<a href="manage-guardian.php" class="nav-link">
										<i class="fa fa-edit nav-icon"></i>
										<p>Manage guardians</p>
									</a>
								</li>

							</ul>
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
						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-info">
								<div class="inner">
									<?php
									$sql = $conn->query("SELECT *  FROM students WHERE parent_ID='$parent_ID' AND status='1'");
									$count = $sql->num_rows;
									?>
									<h4><?php echo $count; ?></h4>

									<p>Students</p>
								</div>
								<div class="icon">
									<i class="fas fa-graduation-cap"></i>
								</div>

							</div>
						</div>
						<!-- ./col -->


						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-danger">
								<div class="inner">
									<?php
									$sql = "SELECT * FROM legal_guardians WHERE parent_ID='$parent_ID'";
									$exe = $conn->query($sql);
									$counts = $exe->num_rows;

									?>
									<h4><?php echo $counts; ?></h4>

									<p>Guardians</p>
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
						<?php
						$sql = "SELECT * FROM `data` as d inner join  students as s on d.student_ID=s.student_ID INNER JOIN drivers as dr on d.driver_ID=dr.driver_ID inner join bus as b on b.bus_ID=dr.bus_ID WHERE s.parent_ID='$parent_ID' AND d.status='1'";
						$exe = $conn->query($sql);
						while ($row = $exe->fetch_array()) {
							$student_ID = $row['student_ID'];
							$student_names = $row['student_names'];
							$student_profile = $row['profile_image'];
							$driver_names = $row['driver_names'];
							$driver_image = $row['driver_image'];
							$bus_ID  = $row['bus_ID'];
							$plate_number = $row['plate_number'];
							$longitude = $row['longitude'];
							$latitude = $row['latitude'];


						?>
							<section class="col-lg-6 connectedSortable">
								<!-- Custom tabs (Charts with tabs)-->
								<div class="card bg-gradient-light">
									<div class="card-header">
										<div class="card-title">
											<i class="fa fa-map-marker-alt"></i> Student real time track
										</div>


										<div class="card-tools">

											<button type="button" class="btn btn-tool" data-card-widget="collapse">
												<i class="fas fa-minus"></i>
											</button>

											<button type="button" class="btn btn-tool" data-card-widget="remove">
												<i class="fas fa-times"></i>
											</button>
										</div>
									</div><!-- /.card-header -->
									<div class="card-body ">
										<div class="row">
											<div class="col-md-6">
												<b><i class="fas fa-child"></i> <?php echo $student_names; ?></b>
												<hr>
												<div class="row">
													<div class="col-md-3">
														<img src="../images/students/<?php echo $student_profile; ?>" style="width: 50px;height: 50px;border-radius: 50%;">


													</div>
													<div class="col-md-9">


														<b>Board time :</b><br> <?php echo date("d-m-Y H:i:s ", $row['board_time']); ?>
													</div>
												</div>
											</div>


											<div class="col-md-6">
												<b><i class="fas fa-bus"></i> <?php echo $plate_number; ?></b>
												<hr>
												<div class="row">
													<div class="col-md-3">
														<img src="../images/driver/<?php echo $driver_image; ?>" style="width: 50px;height: 50px;border-radius: 50%;">


													</div>
													<div class="col-md-9">
														<?php echo $driver_names; ?>

													</div>
												</div>
											</div>
										</div>
										<iframe src="./map.php?bus_ID=<?php echo $bus_ID; ?>" width="100%" height="400px" frameborder="0"></iframe>

									</div><!-- /.card-body -->
								</div>
								<!-- /.card -->

							</section>

						<?php
						}




						?>





					</div>
					<!-- /.row (main row) -->
				</div><!-- /.container-fluid -->
				<div class="col-md-12 col-lg-12">
					<div class="check-refresh" style="display: none;"><?php echo $last_id; ?></div>
					<div class="delete-load" style="display: none;"></div>

				</div>

			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<?php
		include 'includes/footer.php'; // the footer of the page 
		?>

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
	<script type="text/javascript">
		$(document).ready(function() {
			clockUpdate();
			setInterval(clockUpdate, 1000);
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