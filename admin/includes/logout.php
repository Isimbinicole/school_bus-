<?php
session_start();
unset($_SESSION['admin_ID']);
unset($_SESSION['admin_email']);
?>
<script type="text/javascript">
window.location="../../sign-in.php";	
</script>