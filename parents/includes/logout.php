<?php
session_start();
unset($_SESSION['parent_ID']);
unset($_SESSION['parent_email']);
?>
<script type="text/javascript">
window.location="../../sign-in.php";	
</script>