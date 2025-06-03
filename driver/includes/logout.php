<?php
session_start();
unset($_SESSION['driver_ID']);
unset($_SESSION['driver_email']);
?>
<script type="text/javascript">
window.location="../../sign-in.php";	
</script>