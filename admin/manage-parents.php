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
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
            <li class="nav-item ">
              <a href="index.php" class="nav-link">
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
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fa fa-users"></i>
                <p>
                  Parents
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="add-parent.php" class="nav-link">
                    <i class="fa fa-user-plus nav-icon"></i>
                    <p>Add parent</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="manage-parents.php" class="nav-link active">
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
              <h5 class="m-0">Manage parents</h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Parents</a></li>
                <li class="breadcrumb-item active">Manage-parents</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <?php
          if (!@$_GET['p']) { ?>
            <div class="row">
              <div class="col-12 re-load">
                <div class="card">
                  <div class="card-header">

                    <a href="add-parent.php" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add new parent</a>

                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-sm " style="font-size: 13px;">
                      <thead>
                        <tr>
                          <!-- <th>Profile </th> -->
                          <th>Father's name </th>
                          <!-- <th>Profile </th> -->
                          <th>Mother's name</th>
                          <th>Phone N<sup><u>o</u></sup></th>
                          <th>Email</th>
                          <th>Students</th>
                          <th>Guardians</th>

                          <th>view </th>

                          <th>Actions</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM parents WHERE status='1'";
                        $exe = $conn->query($sql);
                        while ($row = $exe->fetch_array()) {
                          $parent_ID = $row['parent_ID'];
                          $sql_select_parent = "SELECT *  FROM students WHERE parent_ID='$parent_ID'";
                          $exe_parent = $conn->query($sql_select_parent);
                          $students_num = $exe_parent->num_rows;
                          $sql_select_parent = "SELECT *  FROM legal_guardians WHERE parent_ID='$parent_ID'";
                          $exe_parent = $conn->query($sql_select_parent);
                          $guardian_num = $exe_parent->num_rows;
                        ?>
                          <tr>
                            <!-- <td><img src="../images/parents/<?php if ($row['fathers_img'] == '') {
                                                              echo "father.png";
                                                            } else {
                                                              echo $row['fathers_img'];
                                                            } ?>" class="img-circle img " height="50" width="50"></td> -->
                            <td><?php echo $row['fathers_names']; ?></td>
                            <!-- <td><img src="../images/parents/<?php if ($row['mothers_img'] == '') {
                                                              echo "mother.png";
                                                            } else {
                                                              echo $row['mothers_img'];
                                                            } ?>" class="img-circle img " height="50" width="50"></td> -->
                            <td><?php echo $row['mothers_names']; ?></td>
                            <td><?php echo $row['phone_number1'] . "/" . $row['phone_number2']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $students_num; ?></td>
                            <td><?php echo $guardian_num; ?></td>
                            <td>
                              <a href="#" class="btn btn-sm text-info v-p" id="<?php echo $row['parent_ID']; ?>" style="float: right;margin-right: 5px;"> <i class="fas fa-eye"></i></a>
                            </td>
                            <td style="display: flex; gap: 8px;">
                              <a href="edit-parent.php?p=<?php echo $row['parent_ID']; ?>" class="btn btn-sm text-info v-p" id="<?php echo $row['parent_ID']; ?>">
                                <i class="fas fa-edit"></i>
                              </a>

                              <b class="btn btn-sm text-danger d-p" id="<?php echo $row['parent_ID']; ?>">
                                <i class="fas fa-trash-alt"></i>
                              </b>
                              <a href="add-student.php?p=<?php echo urlencode(base64_encode($row['parent_ID'] * 2025)); ?>" class="btn btn-sm btn-primary "><i class=" fas fa-user-plus"></i> Add student </a>
                            </td>


                            <!-- <td style="display:flex;">
                              <a href="edit-parent.php?p=<?php echo $row['parent_ID']; ?>" class="btn btn-sm text-info v-p" id="<?php echo $row['parent_ID']; ?>" style=""> <i class="fas fa-edit "></i></a>
                              <b class="btn btn-sm text-danger d-p" id="<?php echo $row['parent_ID']; ?>" style=""> <i class="fas fa-trash-alt"></i></b>
                              <a href="add-student.php" class="nav-link ">

                            </td> -->


                          </tr>

                        <?php
                        }


                        ?>

                      </tbody>

                    </table>

                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card">
                  <div class="card-header">

                    <h5 class=""> Deleted parents</h5>

                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example2" class="table table-bordered table-sm " style="font-size: 13px;">
                      <thead>
                        <tr>
                          <th>Profile </th>
                          <th>Father's name </th>
                          <th>Profile </th>
                          <th>Mother's name</th>
                          <th>Phone N<sup><u>o</u></sup></th>
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
                          $sql_select_parent = "SELECT *  FROM students WHERE parent_ID='$parent_ID'";
                          $exe_parent = $conn->query($sql_select_parent);
                          $students_num = $exe_parent->num_rows;
                          $sql_select_parent = "SELECT *  FROM legal_guardians WHERE parent_ID='$parent_ID'";
                          $exe_parent = $conn->query($sql_select_parent);
                          $guardian_num = $exe_parent->num_rows;
                        ?>
                          <tr>
                            <td><img src="../images/parents/<?php if ($row['fathers_img'] == '') {
                                                              echo "father.png";
                                                            } else {
                                                              echo $row['fathers_img'];
                                                            } ?>" class="img-circle img " height="50" width="50"></td>
                            <td><?php echo $row['fathers_names']; ?></td>
                            <td><img src="../images/parents/<?php if ($row['mothers_img'] == '') {
                                                              echo "mother.png";
                                                            } else {
                                                              echo $row['mothers_img'];
                                                            } ?>" class="img-circle img " height="50" width="50"></td>
                            <td><?php echo $row['mothers_names']; ?></td>
                            <td><?php echo $row['phone_number1'] . "/" . $row['phone_number2']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $students_num; ?></td>
                            <td><?php echo $guardian_num; ?></td>

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
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

              </div>
              <!-- /.col -->

              <div class="col-12">
                <div class=" load-includes">
                  <!-- to load the include files  -->

                </div>
                <div class=" load-texts">
                  <!-- to load the include files  -->

                </div>
                <!--    /.load-includes -->
              </div>
              <!-- /.col -->
            </div>
          <?php
          }
          ?>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->



        <div class="container-fluid">
          <div class="row load-parent-info" style="display: none;">

          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->



      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2025.</strong>
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
  <!-- DataTables  & Plugins -->
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../plugins/jszip/jszip.min.js"></script>
  <script src="../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- Toastr -->
  <script src="../plugins/toastr/toastr.min.js"></script>
  <script>
    $(function() {

      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
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
</body>

</html>
<script>
  $(document).ready(function() {
    $(".d-p").click(function() {
      var get_id = $(this).attr("id");
      $(".load-includes").load("includes/manage-parents.php?t=d&i=" + get_id);
    });
    $(".p-r").click(function() {
      var get_id = $(this).attr("id");
      $(".load-includes").load("includes/manage-parents.php?t=r&i=" + get_id);

    });
    $(".v-p").click(function() {
      var get_id = $(this).attr("id");
      $(".load-parent-info").slideToggle();
      $(".re-load").slideToggle();
      $(".load-parent-info").load("includes/manage-parents.php?t=v-p&i=" + get_id);

    });
    $(".close-parent-info").click(function() {

      $(".load-parent-info").slideToggle();
      $(".re-load").slideToggle();

    });


  });
</script>