<?php
session_start();
$admin_ID = $_SESSION['admin_ID'];
include '../../includes/db_conn.php';
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password1'];
$current_password = md5($current_password);
$new_password = md5($new_password);
$sql = "SELECT * FROM admin WHERE admin_ID='$admin_ID' AND password='$current_password'";
$exe = $conn->query($sql);
if ($exe->num_rows > 0) {
    $sql = "UPDATE admin  SET password='$new_password' WHERE admin_ID='$admin_ID' ";
    $exe = $conn->query($sql);
    if ($exe == true) {
?>
        <script type="text/javascript">
            toastr.success(" Password updated successfuly");
            $('input[type="password"]').val('');
        </script>
    <?php
    }
} else {
    ?>
    <script type="text/javascript">
        toastr.error(" incorrect current password !");
    </script>
<?php
}
?>