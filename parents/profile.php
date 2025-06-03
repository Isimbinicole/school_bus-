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
            <li class="nav-item  ">
              <a href="#" class="nav-link ">
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
                  <a href="manage-guardian.php" class="nav-link ">
                    <i class="fa fa-edit nav-icon"></i>
                    <p>Manage guardians</p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item">
              <a href="profile.php" class="nav-link active">
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
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Profile </li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <?php
            $sql = "SELECT * FROM parents WHERE parent_ID='$parent_ID'";
            $exe = $conn->query($sql);
            while ($row = $exe->fetch_array()) {
              $mothers_names = $row['mothers_names'];
              $fathers_names = $row['fathers_names'];
              $fathers_NID = $row['fathers_NID'];
              $mothers_NID = $row['mothers_NID'];
              $fathers_NID = $row['fathers_NID'];
              $latitude = $row['latitude'];
              $longitude = $row['longitude'];
              $email = $row['email'];
              $phone = $row['phone_number1'];
              $phone2 = $row['phone_number2'];
              $father_img = $row['fathers_img'];
              $mother_img = $row['mothers_img'];
            }
            if ($father_img == '') {
              $father_img = "father.png";
            }
            if ($mother_img == '') {
              $mother_img = "mother.png";
            }
            ?>
            <div class="col-md-10">
              <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>&nbsp &nbsp &nbsp For security purpose , if you need to change the contents in your profile info , contact the system administrator
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-2">
              <button class="btn btn-sm btn-outline-primary " data-toggle="modal" data-target="#modal-default" style="float: right;"> <i class="fa fa-key"></i> Change password</button>
            </div>
            <!-- /.col -->
            <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">

                  <div class="modal-body">
                    <form action="includes/change-password.php" method="post" enctype="multipart/form-data" id="add_record">

                      <div class="col-md-12" style="font-size: 13px;padding: 20px;">
                        <p style="font-weight: bold;padding: 5px 0px 0px 5px;"> Change password <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button></p>


                        <hr class="bg-primary">
                        <div class="row">
                          <div class="col-md-12">

                            <div class="row">

                              <div class="col-md-12">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">

                                      <label>Current password :</label>
                                      <div class="input-group">

                                        <input type="password" class="form-control" placeholder="Enter current password" id="current_password" name="c_password">
                                      </div>
                                      <!-- /.input group -->
                                    </div>
                                  </div><!-- /.col-md-12 -->
                                  <div class="col-md-12">
                                    <div class="form-group">

                                      <label>New password :</label>
                                      <div class="input-group">

                                        <input type="password" class="form-control" placeholder="Enter new password" id="new_password1" name="n_password">
                                      </div>
                                      <!-- /.input group -->
                                    </div>
                                  </div><!-- /.col-md-12 -->
                                  <div class="col-md-12">
                                    <div class="form-group">

                                      <label>Confirm new password :</label>
                                      <div class="input-group">

                                        <input type="password" class="form-control" placeholder="confirm new password" id="new_password2" name="cn_password">
                                      </div>
                                      <!-- /.input group -->
                                    </div>
                                  </div><!-- /.col-md-12 -->
                                  <div class="col-md-12">
                                    <div class="pass-update"></div>

                                  </div><!-- /.col-md-12 -->


                                </div><!-- /.row -->

                              </div><!-- /.col-md-6 -->


                            </div> <!--  /.row    -->

                          </div><!-- /.col-md-6 -->


                        </div><!-- /.row -->



                        <button type="submit" class="btn btn-primary save" style="float: right;margin-right: 20px;"><i class="fas  fa-save  "></i> Save</button>

                      </div><!-- /.col-md-12 -->

                    </form>


                  </div>

                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <div class="col-md-6">
              <div class="row">
                <div class="card bg-gradient-white">
                  <div class="card-header bg-light text-dark "> <b>Profile info</b>
                    <div class="card-tools">

                      <button type="button" class="btn btn-tool " data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>

                    </div>
                  </div><!-- /.card-header -->
                  <div class="card-body ">
                    <div class="row">
                      <div class="col-md-6   card-primary ">
                        <div class="row justify-content-center">
                          <div class="col-md-3">
                            <img src="../images/parents/<?php echo $mother_img; ?>" class="img img-circle " style="height: 80px; width: 80px;">
                          </div>
                          <div class="col-md-12">
                            <div style="float: right; font-size: 12px;">
                              <p><b>Names :</b> <?php echo $mothers_names; ?></p>
                              <p><b>NID :</b> <?php echo $mothers_NID; ?></p>
                            </div>
                          </div>
                        </div>


                      </div>
                      <div class="col-md-6 ">
                        <div class="row justify-content-center">
                          <div class="col-md-3">
                            <img src="../images/parents/<?php echo $father_img; ?>" class="img img-circle " style="height: 80px; width: 80px;">
                          </div>
                          <div class="col-md-12">
                            <div style="float: right; font-size: 12px;">
                              <p><b>Names :</b> <?php echo $fathers_names; ?></p>
                              <p><b>NID :</b> <?php echo $fathers_NID; ?></p>
                            </div>
                          </div>
                        </div>


                      </div>
                    </div>


                  </div><!-- /.card-body -->
                </div>

                <div class="col-md-12">
                  <div class="card bg-gradient-white">
                    <div class="card-header bg-light text-dark "> <b>Students </b>
                      <div class="card-tools">

                        <button type="button" class="btn btn-tool " data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>

                      </div>
                    </div><!-- /.card-header -->
                    <div class="card-body ">
                      <div class="row">
                        <?php
                        $sql = "SELECT * FROM students WHERE parent_ID='$parent_ID'";
                        $exe = $conn->query($sql);
                        if ($exe->num_rows > 0) {
                          while ($row = $exe->fetch_array()) {
                        ?>
                            <div class="col-md-6">
                              <div class="card" style="padding: 0px;">
                                <div class="card-body" style="padding: 0px;">

                                  <img src="../images/students/<?php echo $row['profile_image']; ?>" class="img img-fluid">

                                </div>
                                <div class="card-footer" style="font-size: 12px;">
                                  <?php echo $row['student_names']; ?>
                                </div>
                              </div>
                            </div>
                        <?php
                          }
                        }
                        ?>

                      </div><!-- /.card-body -->
                    </div>
                  </div>
                  <!-- /.card -->
                </div>
                <div class="col-md-12">
                  <div class="card bg-gradient-white">
                    <div class="card-header bg-light text-dark "> <b>Guardians </b>
                      <div class="card-tools">

                        <button type="button" class="btn btn-tool " data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>

                      </div>
                    </div><!-- /.card-header -->
                    <div class="card-body ">
                      <div class="row">
                        <?php
                        $sql = "SELECT * FROM legal_guardians WHERE parent_ID='$parent_ID'";
                        $exe = $conn->query($sql);
                        if ($exe->num_rows > 0) {
                          while ($row = $exe->fetch_array()) {
                        ?>
                            <div class="col-md-6">
                              <div class="card" style="padding: 0px;">
                                <div class="card-body" style="padding: 0px;">

                                  <img src="../images/guardians/<?php echo $row['g_profile_img']; ?>" class="img img-fluid">

                                </div>
                                <div class="card-footer" style="font-size: 12px;">
                                  <?php echo $row['g_names']; ?>
                                </div>
                              </div>
                            </div>
                        <?php
                          }
                        }
                        ?>

                      </div><!-- /.card-body -->
                    </div>
                  </div>
                  <!-- /.card -->
                </div>
              </div>

              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="card bg-gradient-white">
                <div class="card-header bg-light text-dark "> <b>Bus stop location</b>
                  <div class="card-tools">

                    <button type="button" class="btn btn-tool " data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>

                  </div>
                </div><!-- /.card-header -->
                <div class="card-body ">
                  <button class="btn btn-danger update-loc"> <i class="fa fa-map-marker-alt" aria-hidden="true"></i> Update Bus stop cordinates</button>
                  <iframe width="100%" height="500" style="border: none; margin-top:15px;" src="https://maps.google.com/maps?q=<?php echo $latitude; ?>,<?php echo $longitude; ?>&output=embed"></iframe>


                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->


            <!-- /.col -->



          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
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


  <!-- Toastr -->
  <script src="../plugins/toastr/toastr.min.js"></script>
  <!-- change password -->
  <script src="../js/my_js/change_password.js"></script>

  <script type="text/javascript">
    $('.update-loc').click(() => {
      // navigator.geolocation.getCurrentPosition((position) => {
      //   let lat = position.coords.latitude;
      //   let long = position.coords.longitude;
      //   //insert the driver location in the maps 
      //   fetch(`./includes/insert-coords.php?lat=${lat}&long=${long}`)
      //     .then((resp) => {
      //       return resp.json();
      //     }).then((backData) => {
      //       const gotData = backData;
      //       if (gotData.success == true) {
      //         toastr.success(`New cordinated saved successfuly`);
      //       } else {
      //         toastr.error(`Failed to load and register new cordinates `);
      //       }



      //     })

      // });

      getLocation();
    })

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        toastr.error(`Geolocation is not supported by this browser`);



      }
    }

    function showPosition(position) {


      let lat = position.coords.latitude;
      let long = position.coords.longitude;
      //insert the driver location in the maps 
      fetch(`../includes/insert-coords.php?lat=${lat}&long=${long}`)
        .then((resp) => {
          return resp.json();
        }).then((backData) => {
          const gotData = backData;
          if (gotData.success == true) {
            toastr.success(`New cordinated saved successfuly`);
          } else {
            toastr.error(`Failed to load and register new cordinates `);
          }



        })


    }
  </script>



</body>

</html>