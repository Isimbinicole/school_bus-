
<?php 

	session_start();
	$driver_ID=$_SESSION['driver_ID'];
	include '../../includes/db_conn.php';
// the script to select the driver information
$sql="SELECT * FROM drivers  INNER JOIN bus  WHERE driver_ID='$driver_ID'";
$exe=$conn->query($sql);
while ($row=$exe->fetch_array()) {

	$long=$row['longitude'];
	$lat=$row['latitude'];
}
?>

<iframe width="100%" height="400" style="margin-bottom: 10px;border-radius: 4px;padding: 4px;border: none; background-color: transparent;" src="https://maps.google.com/maps?q=<?php echo $lat; ?>,<?php echo $long; ?>&output=embed"></iframe>

