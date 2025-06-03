<?php
include '../../includes/db_conn.php';
$modal=$_POST['bus_model'];
$plate_number=$_POST['plate_number'];
$number_of_seats=$_POST['number_of_seats'];
$sql=$conn->query("SELECT * FROM bus WHERE plate_number='$plate_number'");
if ($sql->num_rows>0) {
		?>

<script type="text/javascript">
	toastr.error('A bus with such plate number already exists !');
</script>
	<?php
}
else{
$sql=$conn->query("INSERT INTO `bus`(`bus_ID`, `model`, `plate_number`, `seats`, `longitude`, `latitude`, `status`) VALUES (NULL,'$modal','$plate_number','$number_of_seats','0.000000','0.000000','1')");
if ($sql==true) {
	?>
<script type="text/javascript">
	 toastr.success('Bus succesfully added ');
	 $("#bus_model,#plate_number,#number_of_seats").val('');
</script>
	<?php
}
else{
	?>

<script type="text/javascript">
	toastr.error('Failed try again later !');
</script>
	<?php
}}
?>