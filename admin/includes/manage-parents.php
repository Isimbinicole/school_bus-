<?php
include '../../includes/db_conn.php';

if ($_GET['t'] == 'd') {
    $parent_id = $_GET['i'];
    $sql = "UPDATE `parents` SET `status` = '0' WHERE parent_ID = '$parent_id'";
    $exe = $conn->query($sql);
    if ($exe) {
        ?>
        <script>
            $(".re-load").load("includes/manage-parents.php?t=re_load");
            toastr.success('Parent deleted successfully');
        </script>
        <?php
    } else {
        ?>
        <script>
            toastr.error('Failed to delete parent, try again!');
        </script>
        <?php
    }
}

if ($_GET['t'] == 'r') {
    $parent_id = $_GET['i'];
    $sql = "UPDATE `parents` SET `status` = '1' WHERE parent_ID = '$parent_id'";
    $exe = $conn->query($sql);
    if ($exe) {
        ?>
        <script>
            $(".re-load").load("includes/manage-parents.php?t=re_load");
            toastr.success('Parent successfully restored');
        </script>
        <?php
    } else {
        ?>
        <script>
            toastr.error('Failed to restore parent, try again!');
        </script>
        <?php
    }
}

if ($_GET['t'] == 're_load') {
?>

<div class="card">
    <div class="card-header">
        <a href="add-parent.php" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add new parent</a>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-sm" style="font-size: 13px;">
            <thead>
                <tr>
                    <th>Father's name</th>
                    <th>Mother's name</th>
                    <th>Phone No</th>
                    <th>Email</th>
                    <th>Students</th>
                    <th>Guardians</th>
                    <th>View</th>
                    <th>Trash</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM parents WHERE status='1'";
                $exe = $conn->query($sql);
                while ($row = $exe->fetch_array()) {
                    $parent_ID = $row['parent_ID'];
                    $students = $conn->query("SELECT * FROM students WHERE parent_ID='$parent_ID'")->num_rows;
                    $guardians = $conn->query("SELECT * FROM legal_guardians WHERE parent_ID='$parent_ID'")->num_rows;
                    ?>
                    <tr>
                        <td><?php echo $row['fathers_names']; ?></td>
                        <td><?php echo $row['mothers_names']; ?></td>
                        <td><?php echo $row['phone_number1'] . "/" . $row['phone_number2']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $students; ?></td>
                        <td><?php echo $guardians; ?></td>
                        <td>
                            <a href="#" class="btn btn-sm text-info v-p" id="<?php echo $row['parent_ID']; ?>" style="float: right;margin-right: 5px;"> <i class="fas fa-eye"></i></a>
                        </td>
                        <td>
                            <b class="btn btn-sm text-danger d-p" id="<?php echo $row['parent_ID']; ?>" style="float: right;"> <i class="fas fa-trash-alt"></i></b>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Deleted Parents</h5>
    </div>
    <div class="card-body">
        <table id="example2" class="table table-bordered table-sm" style="font-size: 13px;">
            <thead>
                <tr>
                    <th>Father's name</th>
                    <th>Mother's name</th>
                    <th>Phone No</th>
                    <th>Email</th>
                    <th>Students</th>
                    <th>Guardians</th>
                    <th>Restore</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM parents WHERE status='0'";
                $exe = $conn->query($sql);
                while ($row = $exe->fetch_array()) {
                    $parent_ID = $row['parent_ID'];
                    $students = $conn->query("SELECT * FROM students WHERE parent_ID='$parent_ID'")->num_rows;
                    $guardians = $conn->query("SELECT * FROM legal_guardians WHERE parent_ID='$parent_ID'")->num_rows;
                    ?>
                    <tr>
                        <td><?php echo $row['fathers_names']; ?></td>
                        <td><?php echo $row['mothers_names']; ?></td>
                        <td><?php echo $row['phone_number1'] . "/" . $row['phone_number2']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $students; ?></td>
                        <td><?php echo $guardians; ?></td>
                        <td>
                            <b class="btn btn-sm text-danger p-r" id="<?php echo $row['parent_ID']; ?>" style="float: right;"> <i class="fas fa-recycle"></i></b>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(function () {
    $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
</script>

<script>
$(document).ready(function(){
    $(".d-p").click(function(){
        var get_id = $(this).attr("id");
        $(".load-includes").load("includes/manage-parents.php?t=d&i=" + get_id);
    });

    $(".p-r").click(function(){
        var get_id = $(this).attr("id");
        $(".load-includes").load("includes/manage-parents.php?t=r&i=" + get_id);
    });

    $(".v-p").click(function(){
        var get_id = $(this).attr("id");
        $(".load-parent-info").slideToggle();
        $(".re-load").slideToggle();
        $(".load-parent-info").load("includes/manage-parents.php?t=v-p&i=" + get_id);
    });
});
</script>

<?php
}

if ($_GET['t'] == 'v-p') {
    $parent_ID = $_GET['i'];
    $sql = "SELECT * FROM parents WHERE parent_ID = '$parent_ID'";
    $exe = $conn->query($sql);

    while ($row = $exe->fetch_array()) {
        $mothers_names = $row['mothers_names'];
        $fathers_names = $row['fathers_names'];
        $fathers_NID = $row['fathers_NID'];
        $mothers_NID = $row['mothers_NID'];
        $email = $row['email'];
        $phone1 = $row['phone_number1'];
        $phone2 = $row['phone_number2'];
        $latitude = $row['latitude'];
        $longitude = $row['longitude'];
    }
?>

<script type="text/javascript">
$(".close-parent-info").click(function(){
    $(".load-parent-info").slideToggle();
    $(".re-load").slideToggle();
});
</script>

<div class="card col-12">
    <div class="card-header text-primary">
        Parent Profile
        <button class="close-parent-info btn btn-danger btn-sm" style="float:right;" title="Close">
            <i class="fas fa-close"></i>
        </button>
    </div>
    <div class="card-body">
        <table class="table table-sm table-bordered">
            <tr>
                <th>Father's Name</th><td><?php echo $fathers_names; ?></td>
                <th>Mother's Name</th><td><?php echo $mothers_names; ?></td>
            </tr>
            <tr>
                <th>Father's NID</th><td><?php echo $fathers_NID; ?></td>
                <th>Mother's NID</th><td><?php echo $mothers_NID; ?></td>
            </tr>
            <tr>
                <th>Phone Numbers</th><td><?php echo $phone1 . " / " . $phone2; ?></td>
                <th>Email</th><td><?php echo $email; ?></td>
            </tr>
            <tr>
                <th>Latitude</th><td><?php echo $latitude; ?></td>
                <th>Longitude</th><td><?php echo $longitude; ?></td>
            </tr>
        </table>
    </div>
</div>

<?php } ?>
