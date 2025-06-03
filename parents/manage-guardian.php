<?php
session_start();
if (!isset($_SESSION['parent_ID'])) {
  header("location:../index.php");
} else {
  $parent_ID = $_SESSION['parent_ID'];
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

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item ">
              <a href="index.php" class="nav-link ">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="report.php" class="nav-link">
                <i class="nav-icon fab  fa-sellsy"></i>
                <p>
                  Report


                </p>
              </a>

            </li>
            <li class="nav-item menu-open ">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Guardians
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item ">
                  <a href="add-guardian.php" class="nav-link ">
                    <i class="fa fa-user-plus nav-icon"></i>
                    <p>Add Guardian</p>
                  </a>
                </li>
                <li class="nav-item  ">
                  <a href="manage-guardian.php" class="nav-link active">
                    <i class="fa fa-edit nav-icon"></i>
                    <p>Manage guardians</p>
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
              <h5 class="m-0">Manage guardians</h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Guardians</a></li>
                <li class="breadcrumb-item active">Manage-guardians</li>
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
          if (!(@$_GET['g'])) {
          ?>
            <div class="row re-load">
              <div class="col-6 " style="font-size: 13px;">
                <div class="card">
                  <div class="card-header">

                    <a href="add-guardian.php" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add new guardian</a>

                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-sm ">
                      <thead>
                        <tr>
                          <th>Profile </th>
                          <th>names </th>

                          <th>Edit</th>
                          <th>Trash</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM legal_guardians WHERE parent_ID='$parent_ID' AND status='1'";
                        $exe = $conn->query($sql);
                        while ($row = $exe->fetch_array()) {

                        ?>
                          <tr>
                            <td><img src="../images/guardians/<?php echo $row['g_profile_img'] ?>" class="img-circle img " height="50" width="50"></td>
                            <td><?php echo $row['g_names']; ?></td>


                            <td>
                              <a href="?g=<?php echo $row['g_ID']; ?>" class="btn btn-sm text-info" style="float: right;margin-right: 5px;"> <i class="fas fa-pencil-alt mr-1"></i></a>
                            </td>
                            <td>
                              <b class="btn btn-sm text-danger d-g" id="<?php echo $row['g_ID']; ?>" style="float: right;"> <i class="fas fa-trash-alt"></i></b>

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
              <div class="col-6 " style="font-size: 13px;">

                <div class="card">
                  <div class="card-header">

                    Deleted guardians

                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example2" class="table table-bordered table-sm ">
                      <thead>
                        <tr>
                          <th>Profile </th>
                          <th>names </th>

                          <th>Restore</th>


                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM legal_guardians WHERE parent_ID='$parent_ID' AND status='0'";
                        $exe = $conn->query($sql);
                        while ($row = $exe->fetch_array()) {

                        ?>
                          <tr>
                            <td><img src="../images/guardians/<?php echo $row['g_profile_img'] ?>" class="img-circle img " height="50" width="50"></td>
                            <td><?php echo $row['g_names']; ?></td>


                            <td>
                              <b class="btn btn-sm text-danger r-g" id="<?php echo $row['g_ID']; ?>" style="float: right;"> <i class=" fas  fa-recycle"></i></b>

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

          } else {
          ?>


            <?php
            $sql = "SELECT * FROM legal_guardians WHERE parent_ID='$parent_ID' AND status='1'";
            $exe = $conn->query($sql);
            while ($row = $exe->fetch_array()) {
              $profileImg = $row['g_profile_img'];
              $name = $row['g_names'];
            }

            ?>
            <div class="row  justify-content-center">
              <form action="includes/update-guardian.php?g_ID=<?php echo $_GET['g']; ?>" method="post" enctype="multipart/form-data" id="add_record">
                <div class="col-md-12">
                  <div class="card card-primary card-outline">
                    <div class="row ">
                      <div class="col-md-12" style="font-size: 13px;padding: 20px;">
                        <p style="font-weight: bold;padding: 5px 0px 0px 5px;"> Guardian registration form</p>

                        <hr class="bg-primary">
                        <div class="row">
                          <div class="col-md-12">
                            <div id="kv-avatar-errors-2" class="center-block" style="width:100%;display:none"></div>
                            <div class="row">
                              <div class="col-md-12">


                                <div class="form-group">
                                  <label for="exampleInputPassword1">Photo</label>


                                  <div class="kv-avatar center-block" style="width:200px">
                                    <input id="avatar-2" name="guardian_image" type="file" class="file-loading">
                                  </div>
                                </div>
                              </div> <!-- /.col-md-6 -->
                              <div class="col-md-12">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">

                                      <label>Guardians's name :</label>
                                      <div class="input-group">

                                        <input type="text" class="form-control" placeholder="Enter guardians's names" id="guardian_name" value="<?php echo $name; ?>" name="guardian_name">
                                      </div>
                                      <!-- /.input group -->
                                    </div>
                                  </div><!-- /.col-md-12 -->



                                </div><!-- /.row -->

                              </div><!-- /.col-md-6 -->


                            </div> <!--  /.row    -->

                          </div><!-- /.col-md-6 -->


                        </div><!-- /.row -->



                        <button type="submit" class="btn btn-primary" style="float: right;margin-right: 20px;"><i class="fas  fa-save  "></i> Save</button>

                      </div><!-- /.col-md-12 -->

              </form>
            </div>

          <?php
          }
          ?>


          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>


    <!-- /.content-wrapper -->
    <?php
    include 'includes/footer.php'; // the footer of the page 
    ?>

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
  <!-- file input -->
  <script src="../assets/fileinput/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
  <script src="../assets/fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>
  <script src="../assets/fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
  <script src="../assets/fileinput/js/fileinput.min.js"></script>
  <script>
    $(function() {

      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ["excel", "pdf", "print"]
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
    $(".d-g").click(function() {
      var get_id = $(this).attr("id");
      $(".load-includes").load("includes/manage-guardian.php?t=d&i=" + get_id);
    });
    $(".r-g").click(function() {
      var get_id = $(this).attr("id");

      $(".load-includes").load("includes/manage-guardian.php?t=r&i=" + get_id);

    });



  });
</script>
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
    defaultPreviewContent: '<img src="../images/guardians/<?php echo $profileImg; ?>" alt="Your Avatar" style="width:160px"><h6 class="text-muted">Click to select</h6>',
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
              title: 'success',
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