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
        <span class="brand-text font-weight-light">SBM</span>
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
              <a href="report.php" class="nav-link  ">

                <i class="nav-icon fa fa-file"></i>
                <p>
                  Reports
                </p>
              </a>
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
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-car"></i>
                <p>
                  Bus drivers
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="add-driver.php" class="nav-link">
                    <i class="fa fa-user-plus nav-icon"></i>
                    <p>Add driver</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="manage-driver.php" class="nav-link">
                    <i class="fa fa-edit nav-icon"></i>
                    <p>Manage driver</p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fa fa-bus"></i>
                <p>
                  School buses
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="add-bus.php" class="nav-link ">
                    <i class="fa fa-plus"></i>
                    <p>Add bus</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="manage-bus.php" class="nav-link active">
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

            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Bus</a></li>
                <li class="breadcrumb-item active">Manage-bus </li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <div class="row  ">
            <div class="alert alert-danger alert-dismissible" style="font-size: 13px;margin-bottom: 50px;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h6><i class="icon fas fa-ban"></i> Alert!</h6>
              Keep in mind that deleting any of the bus will lead to permanent loss of data including the reports and the driver assigned to the bus, so care must be taken while deleting any of the busses
            </div>


            <?php
            $sql = "SELECT * FROM bus ";
            $exe = $conn->query($sql);
            if ($exe->num_rows > 0) {
              while ($row = $exe->fetch_array()) {
                $bus_ID = $row['bus_ID'];
                $sql_d = "SELECT * FROM drivers WHERE bus_ID='$bus_ID'";
                $exe_d = $conn->query($sql_d);
                $driver_image = '';
                while ($row_d = $exe_d->fetch_array()) {
                  $driver_image = $row_d['driver_image'];
                }
                $seats = $row['seats'];
                $plate_number = $row['plate_number'];
                $model = $row['model'];
                if ($driver_image == '') {
                  $driver_image = "image.png";
                }
            ?>

                <div class="col-md-3">

                  <div class="small-box bg-dark ">
                    <img src="../images/driver/<?php echo $driver_image; ?>" class="bg-white" style="height: 80px;width: 80px;border-radius: 50%;border:solid 1px gray;margin-top: -40px;position: relative;margin-left: 10px;">
                    <div class="header ">
                      <h5 style="margin-left: 20px;"> <?php echo $model; ?></h5>
                    </div>
                    <div class="inner">

                      <h3><?php echo $seats; ?></h3>
                      <h3>bus ID: <?php echo $bus_ID; ?><h3>
                          <b><?php echo $plate_number; ?></b>
                    </div>
                    <div class="icon">
                      <i class="fa fa-bus"></i>
                    </div>
                    <div class="small-box-footer" style="justify-content: space-between !important;">
                      <i class="fas fa-pencil-alt " data-toggle="modal" data-target="#modal-sm<?php echo $bus_ID; ?>" style="cursor: pointer;"></i> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <i class="fas fa-trash-alt " data-toggle="modal" data-target="#delete<?php echo $bus_ID; ?>" id="" style="cursor: pointer;"></i>
                    </div>
                  </div>
                </div> <!-- /.col-md-3 -->
                <!--  edit seats modal -->
                <div class="modal fade" id="modal-sm<?php echo $bus_ID; ?>">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title">Edit bus seats </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="post">
                          <input type="text" class="form-control" value="<?php echo $seats; ?>" id="seat<?php echo $bus_ID; ?>" name="" placeholder="Enter bus seats">
                        </form>
                        <div class="load-seat"></div>
                      </div>
                      <div class="modal-footer justify-content-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary save" id="<?php echo $bus_ID; ?>">Save changes</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!--  delet bus modal -->
                <div class="modal fade" id="delete<?php echo $bus_ID; ?>">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title">Delete </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure you want to detele <?php echo $model; ?> which has <?php echo $plate_number; ?> ?</p>
                        <div class="load-del"></div>
                      </div>
                      <div class="modal-footer justify-content-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger delete" id="<?php echo $bus_ID; ?>"><i class="fas fa-trash-alt"> </i> Delete</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            <?php
              }
            }
            ?>

          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->

            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">






            </section>
            <!-- right col -->
          </div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2022 .</strong>
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
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../dist/js/pages/dashboard.js"></script>
  <!-- Toastr -->
  <script src="../plugins/toastr/toastr.min.js"></script>

  <script type="text/javascript">
    $(".save").click(function() { // update the seats
      var id = $(this).attr('id');
      var input_name = "#seat" + id;
      var seats = $(input_name).val();
      $(".load-seat").load("includes/manage-bus.php?id=" + id + "&t=e&val=" + seats);
    });
    $(".delete").click(function() { // update the seats
      var id = $(this).attr('id');
      $(".load-del").load("includes/manage-bus.php?id=" + id + "&t=d");
    });
  </script>

</body>

</html>