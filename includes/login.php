<?php
session_start();
include 'db_conn.php';
if ($_GET['category']=='driver') {
$email=   $_POST['demail'];
$password=$_POST['dpassword'];

$email=mysqli_escape_string($conn,$email);
$password=mysqli_escape_string($conn,$password);
$pass=md5($password);
$sql="SELECT * FROM drivers WHERE email='$email' AND password='$pass'";
$exe=$conn->query($sql);
if ($exe->num_rows>0) {	
while ($row=$exe->fetch_array()) {
	$id=$row['driver_ID'];
	$status=$row['status'];
}
if ($status==1) {
	$_SESSION["driver_ID"] = $id;
	$_SESSION["driver_email"] = $email;
	?>
<script type="text/javascript">
	window.location="driver/";
</script>
<?php
}
else if($status==0){
	?>
<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 Your account has been  restricted to access this system, contact us for more information !
</div>

	<?php
}

}
else{
	?>
<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 Username or password wrong !
</div>

	<?php
}
	
}
if ($_GET['category']=='parent') {
$email= $_POST['email'];
$password=$_POST['password'];

$email=mysqli_escape_string($conn,$email);
$password=mysqli_escape_string($conn,$password);
$pass=md5($password);
$sql="SELECT * FROM parents WHERE email='$email' AND password='$pass'";
$exe=$conn->query($sql);
if ($exe->num_rows>0) {	
while ($row=$exe->fetch_array()) {
	$id=$row['parent_ID'];
	$status=$row['status'];
}
if ($status==1) {
	$_SESSION["parent_ID"] = $id;
	$_SESSION["parent_email"] = $email;
	?>
<script type="text/javascript">
	window.location="parents/";
</script>
<?php
}
else if($status==0){
	?>
<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 Your account has been  restricted to access this system, contact us for more information !
</div>

	<?php
}

}
else{
	?>
	<br>
<div class="alert alert-danger alert-dismissible">
 
 Username or password wrong !
</div>

	<?php
}
	
}


if ($_GET['category']=='school') {
$email=   $_POST['semail'];
$password=$_POST['spassword'];

$email=mysqli_escape_string($conn,$email);
$password=mysqli_escape_string($conn,$password);
$pass=md5($password);
$sql="SELECT * FROM admin WHERE email='$email' AND password='$pass'";
$exe=$conn->query($sql);
if ($exe->num_rows>0) {	
while ($row=$exe->fetch_array()) {
	$id=$row['admin_ID'];
	$status=$row['status'];
}
if ($status==1) {
	$_SESSION["admin_ID"] = $id;
	$_SESSION["email"] = $email;
	?>
<script type="text/javascript">
	window.location="admin/";
</script>
<?php
}
else if($status==0){
	?>
<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 Your account has been  restricted to access this system, contact us for more information !
</div>

	<?php
}

}
else{
	?>
	<br>
<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fas fa-times"></i></a>
 Username or password wrong !
</div>

	<?php
}
	
}
?>