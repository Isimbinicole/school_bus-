<?php
session_start();
if (!isset($_SESSION['admin_ID'])) {
    header("location:../index.php");
} else {
    $admin_ID = $_SESSION['admin_ID'];
}
include '../includes/db_conn.php'; // the  connection to the database

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School bus tracking system</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
    <!-- file input css -->
    <link rel="stylesheet" type="text/css" href="../assets/fileinput/css/fileinput.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">



        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>


            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">


                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="includes/logout.php" role="button">
                        <i class="fa fa-power-off"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.html" class="brand-link">
                <i class="fa fa-bus  img-circle elevation-3" style="opacity: .8;"></i>
                <!--      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">-->
                <span class="brand-text font-weight-light">SBTS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <?php    // to select the admin information       
                        $sql = $conn->query("SELECT * FROM admin WHERE admin_ID='$admin_ID'");
                        while ($row = $sql->fetch_array()) {
                            $admin_names = $row['admin_names'];
                            $profile = $row['profile'];
                        }
                        ?>
                        <!-- end for the php script -->

                        <img src="../images/admin/<?php echo $profile; ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            <?php echo $admin_names; ?>
                            <!-- to display the admin name -->
                        </a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link ">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fab  fa-sellsy"></i>
                                <p>
                                    Report
                                    <i class="fas fa-angle-left right"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="student-report.php" class="nav-link">
                                        <i class="fa fa-graduation-cap nav-icon"></i>
                                        <p>Students report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="driver-report.php" class="nav-link">
                                        <i class="fa fa-car  nav-icon"></i>
                                        <p>Drivers report</p>
                                    </a>
                                </li>


                            </ul>
                        </li>
                        <!-- <li class="nav-item ">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fa fa-graduation-cap"></i>
                                <p>
                                    Students
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item ">
                                    <a href="add-student.php" class="nav-link ">
                                        <i class="fa fa-user-plus nav-icon"></i>
                                        <p>Add student</p>
                                    </a>
                                </li>
                                <li class="nav-item menu-open ">
                                    <a href="manage-students.php" class="nav-link">
                                        <i class="fa fa-edit nav-icon"></i>
                                        <p>Manage students</p>
                                    </a>
                                </li>

                            </ul>
                        </li> -->
                        <li class="nav-item ">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    Parents
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="add-parent.php" class="nav-link ">
                                        <i class="fa fa-user-plus nav-icon"></i>
                                        <p>Add parent</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="manage-parents.php" class="nav-link">
                                        <i class="fa fa-edit nav-icon"></i>
                                        <p>Manage parents</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fa fa-car"></i>
                                <p>
                                    Bus drivers
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="add-driver.php" class="nav-link ">
                                        <i class="fa fa-user-plus nav-icon"></i>
                                        <p>Add driver</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="manage-driver.php" class="nav-link active">
                                        <i class="fa fa-edit nav-icon"></i>
                                        <p>Manage driver</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-bus"></i>
                                <p>
                                    School buses
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="add-bus.php" class="nav-link">
                                        <i class="fa fa-plus"></i>
                                        <p>Add bus</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="manage-bus.php" class="nav-link">
                                        <i class="fa fa-edit nav-icon"></i>
                                        <p>Manage buses</p>
                                    </a>
                                </li>


                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="profile.php" class="nav-link">
                                <i class="nav-icon fa fa-user"></i>
                                <p>
                                    Profile

                                </p>
                            </a>

                        </li>
                    </ul>

                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h5 class="m-0">Edit-driver</h5>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Driver</a></li>
                                <li class="breadcrumb-item active">edit-driver </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
             <?php
        // include '../../includes/db_conn.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid or missing driver ID.");
}

$driver_id = intval($_GET['id']);

// Fetch driver and assigned bus info
$sql = "SELECT * FROM drivers d 
        INNER JOIN bus b ON d.bus_ID = b.bus_ID 
        WHERE driver_ID = $driver_id";
$exe = $conn->query($sql);

if ($exe->num_rows === 0) {
    die("Driver not found.");
}

$row = $exe->fetch_assoc();
$driver_names = $row['driver_names'];
$driver_NID = $row['driver_NID'];
$email = $row['email'];
$phone_number1 = $row['phone_number1'];
$phone_number2 = $row['phone_number2'];
$plate_number = $row['plate_number'];
?>     
  <section class="content">
    <div class="container-fluid">
        <div class="row">
            <form action="includes/edit-driver.php?id=<?= $driver_id ?>" method="POST" enctype="multipart/form-data" id="add_record">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="row">
                            <div class="col-md-12" style="font-size: 13px; padding: 20px;">
                                <p style="font-weight: bold;">Driver Edit Form</p>
                                <hr class="bg-primary">

                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Driver's Name:</label>
                                            <input type="text" class="form-control" name="driver_name" value="<?= $driver_names ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Driver's NID:</label>
                                            <input type="text" class="form-control" name="driver_nid" value="<?= $driver_NID ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>School Bus:</label>
                                            <select class="form-control" name="plate_number">
                                                <option selected><?= $plate_number ?></option>
                                                <option disabled>-- choose another bus --</option>
                                                <?php
                                                $bus_sql = $conn->query("SELECT plate_number FROM bus WHERE plate_number != '$plate_number'");
                                                while ($bus = $bus_sql->fetch_assoc()) {
                                                    echo "<option>{$bus['plate_number']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Email:</label>
                                            <input type="email" class="form-control" name="email" value="<?= $email ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number 1:</label>
                                            <input type="text" class="form-control" name="phone" value="<?= $phone_number1 ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number 2:</label>
                                            <input type="text" class="form-control" name="phone2" value="<?= $phone_number2 ?>">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary float-right" style="margin-right: 20px;">
                                    <i class="fas fa-save"></i> Save
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2024-2025 <a href="#">Enlighten tech</a>.</strong>
        All rights reserved.

    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.js"></script>
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>

    <!-- file input -->
    <script src="../assets/fileinput/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
    <script src="../assets/fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>
    <script src="../assets/fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
    <script src="../assets/fileinput/js/fileinput.min.js"></script>

    <!-- Toastr -->
    <script src="../plugins/toastr/toastr.min.js"></script>

    <script type="text/javascript">
        var btnCust = '';
        $("#avatar-2").fileinput({
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            showBrowse: false,
            browseOnZoneClick: true,
            removeLabel: '',
            removeIcon: '<i class="fas fa-trash-alt"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-2',
            msgErrorClass: 'alert  alert-danger',
            defaultPreviewContent: '<img src="../images/parents/<?php echo $driver_image; ?>" alt="Your Avatar" style="width:160px"><h6 class="text-muted">Click to select</h6>',
            layoutTemplates: {
                main2: '{preview} ' + btnCust + ' {remove} {browse}'
            },
            allowedFileExtensions: ["jpg", "png", "gif"]
        });
        $("#avatar-1").fileinput({
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            showBrowse: false,
            browseOnZoneClick: true,
            removeLabel: '',
            removeIcon: '<i class="fas fa-trash-alt "></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            msgErrorClass: 'alert  alert-danger',
            defaultPreviewContent: '<img src="../images/parents/mother.png" alt="Your Avatar" style="width:160px"><h6 class="text-muted">Click to select</h6>',
            layoutTemplates: {
                main2: '{preview} ' + btnCust + ' {remove} {browse}'
            },
            allowedFileExtensions: ["jpg", "png", "gif"]
        });

        $(document).ready(function() {
            $("#add_record").unbind('submit').bind('submit', function() {
                var form = $(this);
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    async: false,
                    success: function(response) {
                        if (response.success == true) {

                            $(document).Toasts('create', {
                                class: 'bg-success',
                                title: '',
                                subtitle: '',
                                body: response.messages
                            });

                            $('input[type="text"]').val('');
                            $(".fileinput-remove-button").click();
                        } else {
                            toastr.error(response.messages);
                        }
                    }
                });

                return false;
            });
        });
    </script>

</body>

</html>