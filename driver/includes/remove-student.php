<?php
include '../../includes/db_conn.php';
$data_ID= $_GET['student'];
$sql="DELETE FROM data WHERE data_ID='$data_ID'";
$exe=$conn->query($sql);
if ($exe) {
	?>
<script type="text/javascript">
	$(".load-table").load("includes/load-update.php?t=table");

</script>
	<?php
}

?>