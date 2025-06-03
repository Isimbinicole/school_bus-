<?php
include '../../includes/db_conn.php';
if ($_GET['t']=='e') {
	$seats=$_GET['val'];
	$bus_ID=$_GET['id'];
	$sql="UPDATE bus SET seats='$seats' WHERE bus_ID='$bus_ID'";
	$exe=$conn->query($sql);
	if ($exe==true) {
		
		?>

<script type="text/javascript">
	 toastr.success('Bus seats updated successfuly ');
	window.location="";
</script>
	<?php
	}
	else{
	?>

<script type="text/javascript">
	toastr.error('failed please try again !');
</script>
	<?php

	}

}
 if ($_GET['t']=='d') {

	$bus_ID=$_GET['id'];
	$sql=$conn->query("DELETE FROM data WHERE bus_ID='$bus_ID'");
    $sql=$conn->query("DELETE FROM `drivers` WHERE bus_ID='$bus_ID'");
    $sql="DELETE FROM `bus` WHERE bus_ID='$bus_ID'";
	$exe=$conn->query($sql);
	if ($exe==true) {		
		?>

<script type="text/javascript">
	 toastr.success('Bus deleted successfuly');
	window.location="";
</script>
	<?php
	}
	else{
	?>

<script type="text/javascript">
	toastr.error('failed please try again !');
</script>
	<?php

	}

}
?>