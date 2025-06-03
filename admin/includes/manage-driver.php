<?php
include '../../includes/db_conn.php';

if ($_GET['t'] == 'd') {
  $driver_id = $_GET['i'];
  $sql = "UPDATE `drivers` SET `status` = '0' WHERE `driver_ID` = '$driver_id'";
  $exe = $conn->query($sql);
  if ($exe) {
?>
    <script>
      $(".re-load").load("includes/manage-driver.php?t=re_load");
      toastr.success('Driver deleted successfuly ');
    </script>
  <?php
  } else {
  ?>
    <script>
      toastr.error('Failed to delete driver, try again ! ')
    </script>
  <?php
  }
}
if ($_GET['t'] == 'r') {
  $driver_id = $_GET['i'];
  $sql = "UPDATE drivers SET `status` = '1' WHERE `driver_ID` = '$driver_id'";
  $exe = $conn->query($sql);
  if ($exe) {
  ?>
    <script>
      $(".re-load").load("includes/manage-driver.php?t=re_load");
      toastr.success('Driver successfuly restored  ');
    </script>
  <?php
  } else {

  ?>
    <script>
      toastr.error('Failed to restore Driver, try again ! ')
    </script>
  <?php

  }
}
if ($_GET['t'] == 're_load') {

  ?>

  <div class="card">
    <div class="card-header">

      <a href="add-driver.php" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add new driver</a>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-sm ">
        <thead>
          <tr>
            <th>Profile </th>
            <th>names </th>
            <th>NID</th>
            <th>Email</th>
            <th>Phone number</th>
            <th>Bus</th>
            <th>Edit</th>
            <th>Trash</th>

          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM drivers WHERE status='1'";
          $exe = $conn->query($sql);
          while ($row = $exe->fetch_array()) {
            $bus_ID = $row['bus_ID'];
            $sql_select_parent = "SELECT *  FROM bus WHERE bus_ID='$bus_ID'";
            $exe_parent = $conn->query($sql_select_parent);
            while ($parent_row = $exe_parent->fetch_array()) {

              $plate_number = $parent_row['plate_number'];
            }
          ?>
            <tr>
              <td><img src="../images/driver/<?php echo $row['driver_image'] ?>" class="img-circle img " height="50" width="50"></td>
              <td><?php echo $row['driver_names']; ?></td>
              <td><?php echo $row['driver_NID']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['phone_number1'] . "/" . $row['phone_number1']; ?></td>
              <td><?php echo $plate_number ?></td>

              <td>
                <a href="edit-driver.php?id=<?php echo $row['driver_ID']; ?>" class="btn btn-sm text-info" style="float: right;margin-right: 5px;"> <i class="fas fa-pencil-alt mr-1"></i></a>
              </td>
              <td>
                <b class="btn btn-sm text-danger d-d" id="<?php echo $row['driver_ID']; ?>" style="float: right;"> <i class="fas fa-trash-alt"></i></b>

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
  <div class="card">
    <div class="card-header">

      Deleted drivers

    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example2" class="table table-bordered table-sm ">
        <thead>
          <tr>
            <th>Profile </th>
            <th>names </th>
            <th>NID</th>
            <th>Email</th>
            <th>Phone number</th>
            <th>Bus</th>
            <th>Restore</th>

          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM drivers WHERE status='0'";
          $exe = $conn->query($sql);
          while ($row = $exe->fetch_array()) {
            $bus_ID = $row['bus_ID'];
            $sql_select_parent = "SELECT *  FROM bus WHERE bus_ID='$bus_ID'";
            $exe_parent = $conn->query($sql_select_parent);
            while ($parent_row = $exe_parent->fetch_array()) {

              $plate_number = $parent_row['plate_number'];
            }
          ?>
            <tr>
              <td><img src="../images/driver/<?php echo $row['driver_image'] ?>" class="img-circle img " height="50" width="50"></td>
              <td><?php echo $row['driver_names']; ?></td>
              <td><?php echo $row['driver_NID']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['phone_number1'] . "/" . $row['phone_number1']; ?></td>
              <td><?php echo $plate_number ?></td>


              <td>
                <b class="btn btn-sm text-danger r-d" id="<?php echo $row['driver_ID']; ?>" style="float: right;"> <i class=" fas  fa-recycle"></i></b>

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
      $(".d-d").click(function() {
        var get_id = $(this).attr("id");
        $(".load-includes").load("includes/manage-driver.php?t=d&i=" + get_id);
      });
      $(".r-d").click(function() {
        var get_id = $(this).attr("id");
        $(".load-includes").load("includes/manage-driver.php?t=r&i=" + get_id);

      });



    });
  </script>
<?php

}


?>