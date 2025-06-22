<!DOCTYPE html>
<html lang="en">
<html>

<head>
	<title>School bus tracking system</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/scroll.css">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
	<!-- <link rel="shortcut icon" href="imgs/web_development_imgs/a.png" type="image/x-icon" /> -->
	<!-- Toastr -->
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">



	<style type="text/css">
		ul li {

			float: left;
			padding: 10px;
			list-style: none;
			margin: 10px;
			cursor: pointer;
			margin-top: -30px;
			font-size: 14px;
			box-shadow: 1px 1px 20px #f8f9fa;
			border: solid #f8f9fa;
			text-align: center;
			border-radius: 10px;
			font-weight: bold;
		}

		ul {
			margin-left: 0px;
		}

		form i {

			color: gray;
			font-size: 1.5rem !important;
			margin: 10px;

		}

		form input {
			border-radius: 20px !important;
			height: 45px !important;
			font-weight: bold !important;
			color: gray;
		}

		.active {
			/*background-color:  #17a2b8 !important;
			color: white;*/
			background-color: white !important;
			border: none;
			box-shadow: none !important;
			border-top: solid 4px #007bff;
			margin-top: -10px !important;

			transition: margin-top 1s;

		}

		@media (max-width: 576px) {

			.bck-g {

				height: 80vh !important;


			}

			.top-div .h5 {
				font-size: 14px !important;
			}

			.link-l {
				font-size: 8px !important;
				margin-right: 5px !important;
				margin-top: -10px !important;

			}

			ul {
				margin-left: -20px !important
			}
		}
	</style>

</head>

<body>
	<div class=" container-fluid" style="overflow-x: hidden;">
		<div class="row">
			<div class="col-md-7 col-lg-7 bck-g" style="overflow: hidden;height: 100vh;">
				<div class="bg-light info-left" style="height: 1800px;width: 1800px;border-radius: 50%;margin-left: -120%;margin-top: 0px;position: absolute;"></div>
				<div class=" top-div" style="height: 400px; z-index: 1;position: relative;margin-top: 40px;margin-left: 40px;">
					<h2 class="h4  " style="font-weight: 600;" id="testimonial div">Welcome to wearable embedded <br> Tracking system</h2>
					<hr class="info-right" style="border-width: 2px; border-color: #007bff;width: 200px;margin-left: 0px;">
					<img src="images/development/undraw_education_f8ru.svg" class="showcase-right" style="width: 50%;">

					<!-- <p class=" info-right" style="margin-top: 30px;font-weight: 600;"><i class="fa  fa-map-marker-alt" style="margin-top: 10px;font-size: 2rem;"></i>
						Monitor the safety of your children by continously <br>
						tracking the school bus.
						<br>

					</p> -->
					<!-- <p class="info-left" style="font-weight: 600;"><i class="fa  fa-graduation-cap" style="margin-top: 10px;font-size: 2rem;"></i>
						Monitor the safety of students and ensure their <br> safe arrival at their respective places.
						<br>

					</p> -->
				</div>
			</div>
			<div class="col-lg-5 col-md-5">
				<div class="row">
					<div class="col-md-12 col-lg-12" style="margin-top: 40px;margin-left: 30px;">
						<h2 class="h4" style="font-weight: bold;text-transform: uppercase;">Sign In</h2>
						<hr style="width: 200px; border-color: #007bff;border-width: 2px;margin-left: 0px;">
					</div>

				</div>
				<div class="row " style="box-shadow: 1px 1px 20px #f8f9fa; border:solid 2px #f8f9fa;  margin-top: 20%;transform: translateY(-20%);margin-right: 20px;border-radius: 10px;margin-left: 20px;border-top: solid 4px #007bff;">
					<div class="col-md-12 col-lg-12 ">

						<ul class="selectors">
							<li class="bg-light active link-l  " id="parents"> <i class="fa fa-users"></i><br>&nbspParents&nbsp
							</li>
							<li class="bg-light link-l " id="driver"> <i class="fas fa-bus"></i><br>&nbsp &nbspDriver&nbsp&nbsp</li>
							<li class="bg-light link-l" id="school"> <i class="fas fa-school"></i><br>&nbsp&nbspInsititution&nbsp&nbsp</li>
						</ul>
					</div>


					<div class=" col-md-11 col-lg-11 col-xl-11  " id="parents_div" style="display: none;">

						<br>
						<form class="bs-example bs-example-form" method="post">
							<div class="input-group"><i class="fa fa-user"></i>
								<input type="email" class="form-control form-control-sm email" placeholder="Enter your email address" id="email">
							</div>
							<div class="email-error " style="font-size: 12px;color: red;margin-left: 60px;padding-bottom: 10px;padding-top: 5px;">&nbsp</div>
							<div class="input-group">
								<i class="fa fa-lock"></i> <input type="password" class="form-control form-control-sm password" placeholder="Enter your password" id="password">
							</div>
							<div class="password-error" style="font-size: 13px;margin-left: 60px;">&nbsp</div>

							<p class="check_error"></p>
							<div class="input-group ">
								<input type="submit" name="" value="Login" class=" p-submit  btn btn-primary btn-sm submit" style="width: 200px;margin-left: 60%;">
							</div>

							<p style="float: right;padding-top: 5px; font-size: 13px; cursor: pointer;" data-toggle="modal" data-target="#tech_forgot_modal">Forgot my password ?</p>

						</form>
					</div>
					<!-- driver login -->
					<div class=" col-md-11 col-lg-11 col-xl-11  " id="driver_div" style="display: none;">

						<br>
						<form class="bs-example bs-example-form" method="post">
							<div class="input-group"><i class="fa fa-user"></i>
								<input type="email" class="form-control form-control-sm demail" placeholder="Enter your email address" id="demail">
							</div>
							<span class="demail-error" style="font-size: 12px;color: red;margin-left: 60px;padding-bottom: 10px;padding-top: 5px;">&nbsp</span>
							<div class="input-group">
								<i class="fa fa-lock"></i> <input type="password" class="form-control form-control-sm dpassword" placeholder="Enter your password" id="dpassword">
							</div>
							<span class="dpassword-error" style="font-size: 12px;color: red;margin-left: 60px;padding-bottom: 10px;padding-top: 5px;">&nbsp</span>
							<div class="text-left">


							</div>
							<p class="dcheck_error" style="font-size: 13px; margin-left:30px;"></p>
							<div class="input-group ">
								<input type="submit" name="" value="Login" class=" d-submit  btn btn-primary btn-sm  submit" style="width: 200px;margin-left: 60%;">
							</div>

							<p style="float: right;padding-top: 5px; font-size: 13px; cursor: pointer;" data-toggle="modal" data-target="#tech_forgot_modal">Forgot my password ?</p>

						</form>


					</div>
					<!-- school login -->
					<div class=" col-md-11 col-lg-11 col-xl-11  " id="school_div" style="display: none;">

						<br>
						<form class="bs-example bs-example-form" method="post">
							<div class="input-group"><i class="fa fa-user"></i>
								<input type="email" class="form-control form-control-sm semail" placeholder="Enter your email address" id="semail">
							</div>
							<span class="semail-error" style="font-size: 12px;color: red;margin-left: 60px;padding-bottom: 10px;padding-top: 5px;">&nbsp</span>
							<div class="input-group">
								<i class="fa fa-lock"></i> <input type="password" class="form-control form-control-sm spassword" placeholder="Enter your password" id="spassword">
							</div>
							<span class="spassword-error" style="font-size: 12px;color: red;margin-left: 60px;padding-bottom: 10px;padding-top: 5px;">&nbsp</span>
							<div class="text-left">


							</div>
							<p class="scheck_error"></p>
							<div class="input-group ">
								<input type="submit" name="" value="Login" class=" s-submit  btn btn-primary btn-sm  submit" style="width: 200px;margin-left: 60%;">
							</div>

							<p style="float: right;padding-top: 5px; font-size: 13px; cursor: pointer;" data-toggle="modal" data-target="#tech_forgot_modal">Forgot my password ?</p>

						</form>


					</div>



				</div>




			</div>
		</div>
	</div>

	</div>
	<script src="js/popper.min.js"></script>

	<!-- jQuery -->
	<script src="plugins/jquery/jquery.js"></script>
	<script src="plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- ChartJS -->
	<script src="plugins/chart.js/Chart.min.js"></script>
	<!-- Sparkline -->
	<script src="plugins/sparklines/sparkline.js"></script>
	<!-- JQVMap -->
	<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
	<script src="js/scroll.min.js"></script>
	<script src="js/my_js/login.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#parents_div").slideToggle(500);
			$(".link-l").click(function() {

				$(".link-l").removeClass("active");
				$(this).addClass("active");
				var ids = $(this).attr("id");
				ids += '_div';
				var element_div = '#' + ids;
				$("#school_div,#parents_div,#driver_div").hide();
				$(element_div).slideToggle(500);


			});
		});
	</script>

</body>

</html>