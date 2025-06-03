<?php
include '../../includes/db_conn.php';

if ($_GET['t']=='d') {
	$student_id=$_GET['i'];
	$sql="UPDATE `students` SET `status` = '0' WHERE `students`.`student_ID` = '$student_id'";
	$exe=$conn->query($sql);
	if ($exe) {
		?>
		<script>
			$(".re-load").load("includes/manage-students.php?t=re_load");
			toastr.success('Student deleted successfuly ');
			
		</script>
		<?php
	}
	else{
		?>
		<script>
			toastr.error('Failed to delete student, try again ! ')
		</script>
		<?php
	}
}
if ($_GET['t']=='r') {
	$student_id=$_GET['i'];
	$sql="UPDATE `students` SET `status` = '1' WHERE `students`.`student_ID` = '$student_id'";
	$exe=$conn->query($sql);
	if ($exe) {
		?>
		<script>
			$(".re-load").load("includes/manage-students.php?t=re_load");
			toastr.success('Student successfuly restored  ');
			
		</script>
		<?php
	}
	else{

		?>
		<script>
			toastr.error('Failed to restore student, try again ! ')
		</script>
		<?php

	}
}
if ($_GET['t']=='re_load') {

	?>

  <div class="card">
          <div class="card-header">

            <a href="add-student.php" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add new student</a>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-sm " >
              <thead>
                <tr>
                  <th >Profile </th>
                  <th >Student </th>                 
                  <th>Gender</th>
                  <th>DOB</th>
                  <th>Fathers name</th>
                  <th>Mothers name</th>
                  <th>Card N<sup><u>o</u></sup></th>
                  <th >Edit</th>
                  <th >Trash</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php
                $sql="SELECT * FROM students WHERE status='1'";
                $exe=$conn->query($sql);
                while($row=$exe->fetch_array()){
                  $parent_ID=$row['parent_ID'];
                  $sql_select_parent="SELECT *  FROM parents WHERE parent_ID='$parent_ID'";
                  $exe_parent=$conn->query($sql_select_parent);
                  while ($parent_row=$exe_parent->fetch_array()) {
                    $fathers_name=$parent_row['fathers_names'];
                    $mothers_name=$parent_row['mothers_names'];

                  }
                  ?>
                  <tr>
                    <td><img src="../images/students/<?php echo $row['profile_image']?>" class="img-circle img " height="50" width="50" ></td>
                    <td><?php echo $row['student_names']; ?></td>
                    <td><?php echo $row['sex']; ?></td>
                    <td><?php echo date("d-m-Y",$row['DOB']); ?></td>
                    <td><?php echo $fathers_name; ?></td>
                    <td><?php echo $mothers_name; ?></td>
                    <td><?php echo $row['card_number']; ?></td>
                    <td>
                      <a href="#" class="btn btn-sm text-info" style="float: right;margin-right: 5px;"> <i class="fas fa-pencil-alt mr-1"></i></a>
                    </td>
                    <td>
                      <b class="btn btn-sm text-danger d-ss" id="<?php echo $row['student_ID']; ?>"  style="float: right;"> <i class="fas fa-trash-alt"></i></b>
                      
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

            <h5 class=""> Deleted  students</h5>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-sm " >
              <thead>
                <tr>
                  <th >Profile </th>
                  <th >Student </th>                 
                  <th>Gender</th>
                  <th>DOB</th>
                  <th>Fathers name</th>
                  <th>Mothers name</th>
                  <th>Card N<sup><u>o</u></sup></th>
                  <th >Restore</th>


                </tr>
              </thead>
              <tbody>
                <?php
                $sql="SELECT * FROM students WHERE status='0'";
                $exe=$conn->query($sql);
                while($row=$exe->fetch_array()){
                  $parent_ID=$row['parent_ID'];
                  $sql_select_parent="SELECT *  FROM parents WHERE parent_ID='$parent_ID'";
                  $exe_parent=$conn->query($sql_select_parent);
                  while ($parent_row=$exe_parent->fetch_array()) {
                    $fathers_name=$parent_row['fathers_names'];
                    $mothers_name=$parent_row['mothers_names'];

                  }
                  ?>
                  <tr>
                    <td><img src="../images/students/<?php echo $row['profile_image']?>" class="img-circle img " height="50" width="50" ></td>
                    <td><?php echo $row['student_names']; ?></td>
                    <td><?php echo $row['sex']; ?></td>
                    <td><?php echo date("d-m-Y",$row['DOB']); ?></td>
                    <td><?php echo $fathers_name; ?></td>
                    <td><?php echo $mothers_name; ?></td>
                    <td><?php echo $row['card_number']; ?></td>

                    <td>
                      <a href="#" class="btn btn-sm text-danger recycle-d" id="<?php echo $row['student_ID']; ?>" style="float: right; margin-right: 15px; font-size: 1.2rem;"> <i class="fas  fa-recycle"></i></a>
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
        <script >
  $(document).ready(function(){
   $(".d-ss").click(function(){
     var get_id=$(this).attr("id");
     $(".load-includes").load("includes/manage-students.php?t=d&i="+get_id);
   });
    $(".recycle-d").click(function(){
     var get_id=$(this).attr("id");
     $(".load-includes").load("includes/manage-students.php?t=r&i="+get_id);
   });
 });
  

</script>
	<?php

	}


?>