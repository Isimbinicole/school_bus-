<?php
session_start();
if (!isset($_SESSION['driver_ID']) && !isset($_SESSION['driver_email'])) {
	header("location:../sign-in.php");
}
$driver_ID = $_SESSION['driver_ID'];
include '../../includes/db_conn.php';
$search_date = strtotime($_POST['picker']);
$end_date = $search_date + (60 * 60 * 24);

?>
<div class="row  justify-content-center " style="padding: 20px;">
	<div class="col-md-9 col-lg-9">
	</div>
	<div class="col-md-3 col-lg-3">
		<input type="text" id="picker" class=" form-control form-control-sm picker" placeholder="Enter date " name="" value="<?php echo $_POST['picker'];  ?>" style="float: right;height: 45px;border-radius: 10px;font-weight: 600;">



	</div>
	<div class="col-md-12 col-lg-12 " style="margin-top: 20px;">
		<!-- the division that contains the report results -->
		<div class="alert alert-success"><i class="fa fa-check "></i> Report on <?php echo $_POST['picker'];  ?> generated successfuly</div>
		<?php


		$sql = "SELECT * FROM data  WHERE board_time>='$search_date' AND board_time<='$end_date' AND driver_ID='$driver_ID' ";
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
					$student_ID = $row['student_ID'];
					$sql2 = "SELECT * FROM students WHERE student_ID='$student_ID'";
					$exe2 = $conn->query($sql2);
					while ($row2 = $exe2->fetch_array()) {
						$student_names = $row2['student_names'];
						$student_img = $row2['profile_image'];
						$parent_ID = $row2['parent_ID'];
					}

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
						<td><?php echo date("d-m-Y h:i:s", $arrival_time); ?></td>
						<td><button class="btn btn-sm btn-dark map" id="lat=<?php echo $lat; ?>&long=<?php echo $long; ?>" style="float: right;margin-right: 5px;"><i class="fas  fa-map-marker-alt"></i> View drop location</button></td>

					</tr>

				<?php
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