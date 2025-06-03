<?php
session_start();
$driver_ID=$_SESSION['driver_ID'];
include '../../includes/db_conn.php';
$current_password=$_POST['current_password'];
$new_password=$_POST['new_password1'];
$current_password=md5($current_password);
$new_password=md5($new_password);
$sql="SELECT * FROM drivers WHERE driver_ID='$driver_ID' AND password='$current_password'";
$exe=$conn->query($sql);
if ($exe->num_rows>0) {
	$sql="UPDATE drivers SET password='$new_password' WHERE driver_ID='$driver_ID'";
	$exe=$conn->query($sql);
	if ($exe==true) {
		?>
<div class="bg-success text-white" style="padding: 10px; margin-top: 10px;"><i class="fa fa-check"></i>  Password updated successfuly</div>
<script type="text/javascript">
	$("#current_password,#new_password1,#new_password2").val('');
</script>
		<?php
	}
}
else{
	echo "Incorrent current password ";
}

?>