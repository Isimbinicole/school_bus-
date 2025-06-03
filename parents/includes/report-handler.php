<?php
session_start();
if (!isset($_SESSION['parent_ID']) && !isset($_SESSION['parent_email'])) {
	header("location:../sign-in.php");
}
$parent_ID = $_SESSION['parent_ID'];
include '../../includes/db_conn.php';
$search_date = strtotime($_POST['picker']);
$end_date = $search_date + (60 * 60 * 24);

?>
<div class="row  justify-content-center " style="padding: 20px;">
	<div class="col-md-9 col-lg-9">
	</div>
	<div class="col-md-3 col-lg-3">
		<input type="text" id="picker" class=" form-control form-control-sm picker" value="<?php echo $_POST['picker']; ?>" placeholder="Enter date " name="" style="float: right;height: 45px;border-radius: 10px;font-weight: 600;">



	</div>
	<div class="col-md-12 col-lg-12 " style="margin-top: 20px;">
		<!-- the division that contains the report results -->
		<div class="alert alert-success"><i class="fa fa-check "></i> Report on <?php echo $_POST['picker'];  ?> generated successfuly</div>
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

				$sql_select_student_info = "SELECT * FROM students WHERE parent_ID='$parent_ID'";
				$exe_student_query = $conn->query($sql_select_student_info);
				while ($fetch_data = $exe_student_query->fetch_array()) {
					$student_names = $fetch_data['student_names'];
					$student_img = $fetch_data['profile_image'];
					$student_ID = $fetch_data['student_ID'];



					$sql = "SELECT * FROM data  WHERE board_time>$search_date AND board_time<$end_date  AND student_ID='$student_ID' and arrival_time!='' ";
					$exe = $conn->query($sql);



					while ($row = $exe->fetch_array()) {

						$board_time = $row['board_time'];
						$arrival_time = $row['arrival_time'];
						$long = $row['longitude_d'];
						$lat = $row['latitude_d'];


				?>

						<tr>

							<td><img src="../images/students/<?php echo $student_img; ?>" style="width: 50px;height: 50px;border-radius: 50%;"></td>
							<td><?php echo $student_names; ?></td>

							<td><?php echo date("d-m-Y h:i:s", $board_time); ?></td>
							<td><?php echo date("d-m-Y h:i:s", $arrival_time); ?></td>
							<td><button class="btn btn-sm btn-dark map" id="lat=<?php echo $lat; ?>&long=<?php echo $long; ?>" style="float: right;margin-right: 5px;"><i class="fas  fa-map-marker-alt"></i> View drop location</button></td>

						</tr>

				<?php
					}
				}
				?>
			</tbody>
		</table>

	</div>


</div>
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