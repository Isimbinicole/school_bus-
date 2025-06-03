<?php
session_start();
$parent_ID=$_SESSION['parent_ID'];
include '../../includes/db_conn.php';
$current_password=$_POST['current_password'];
$new_password=$_POST['new_password1'];
$current_password=md5($current_password);
$new_password=md5($new_password);
$sql="SELECT * FROM parents WHERE parent_ID='$parent_ID' AND password='$current_password'";
$exe=$conn->query($sql);
if ($exe->num_rows>0) {
	$sql="UPDATE parents  SET password='$new_password' WHERE parent_ID='$parent_ID' ";
	$exe=$conn->query($sql);
	if ($exe==true) {
		?>
		<script type="text/javascript">
			toastr.success(" Password updated successfuly");
			$('input[type="password"]').val('');
		</script>
		<?php
	}
}
else{
	?>
	<script type="text/javascript">
		toastr.error(" incorrect current password !");
	</script>
	<?php
}
?>