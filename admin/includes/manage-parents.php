<?php
include '../../includes/db_conn.php';

if ($_GET['t']=='d') {
	$parent_id=$_GET['i'];
	$sql="UPDATE `parents` SET `status` = '0' WHERE parent_ID = '$parent_id'";
	$exe=$conn->query($sql);
	if ($exe) {
		?>
		<script>
			$(".re-load").load("includes/manage-parents.php?t=re_load");
			toastr.success('Parent deleted successfuly ');
			
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
	$parent_id=$_GET['i'];
	$sql="UPDATE `parents` SET `status` = '1' WHERE parent_ID = '$parent_id'";
	$exe=$conn->query($sql);
	if ($exe) {
		?>
		<script>
			$(".re-load").load("includes/manage-parents.php?t=re_load");
			toastr.success('Parent successfuly restored  ');
			
		</script>
		<?php
	}
	else{

		?>
		<script>
			toastr.error('Failed to restore parent, try again ! ')
		</script>
		<?php

	}
}
if ($_GET['t']=='re_load') {

	?>

     <div class="card">
          <div class="card-header">

            <a href="add-parent.php" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add new parent</a>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-sm " style="font-size: 13px;" >
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
                 
                  <th >view </th>
                  <th >Trash</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php
                $sql="SELECT * FROM parents WHERE status='1'";
                $exe=$conn->query($sql);
                while($row=$exe->fetch_array()){
                  $parent_ID=$row['parent_ID'];
                  $sql_select_parent="SELECT *  FROM students WHERE parent_ID='$parent_ID'";
                  $exe_parent=$conn->query($sql_select_parent);
                  $students_num=$exe_parent->num_rows;
                  $sql_select_parent="SELECT *  FROM legal_guardians WHERE parent_ID='$parent_ID'";
                  $exe_parent=$conn->query($sql_select_parent);
                  $guardian_num=$exe_parent->num_rows;
                  ?>
                  <tr>
                    <td><img src="../images/parents/<?php if($row['fathers_img']==''){ echo "father.png";} else{ echo $row['fathers_img'];}?>" class="img-circle img " height="50" width="50" ></td>
                    <td><?php echo $row['fathers_names']; ?></td>
                     <td><img src="../images/parents/<?php if($row['mothers_img']==''){ echo "mother.png";} else{ echo $row['mothers_img'];}?>" class="img-circle img " height="50" width="50" ></td>
                    <td><?php echo $row['mothers_names']; ?></td>
                    <td><?php echo $row['phone_number1']."/".$row['phone_number2']; ?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $students_num; ?></td>
                    <td><?php echo $guardian_num; ?></td>
                    <td>
                      <a href="#" class="btn btn-sm text-info v-p" id="<?php echo $row['parent_ID']; ?>" style="float: right;margin-right: 5px;"> <i class="fas fa-eye"></i></a>
                    </td>
                    <td>
                      <b class="btn btn-sm text-danger d-p" id="<?php echo $row['parent_ID']; ?>"  style="float: right;"> <i class="fas fa-trash-alt"></i></b>
                      
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

            <h5 class=""> Deleted  parents</h5>

          </div>
           <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-sm " style="font-size: 13px;" >
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
                 
                 
                  <th >Restore</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php
                $sql="SELECT * FROM parents WHERE status='0'";
                $exe=$conn->query($sql);
                while($row=$exe->fetch_array()){
                  $parent_ID=$row['parent_ID'];
                  $sql_select_parent="SELECT *  FROM students WHERE parent_ID='$parent_ID'";
                  $exe_parent=$conn->query($sql_select_parent);
                  $students_num=$exe_parent->num_rows;
                  $sql_select_parent="SELECT *  FROM legal_guardians WHERE parent_ID='$parent_ID'";
                  $exe_parent=$conn->query($sql_select_parent);
                  $guardian_num=$exe_parent->num_rows;
                  ?>
                  <tr>
                    <td><img src="../images/parents/<?php if($row['fathers_img']==''){ echo "father.png";} else{ echo $row['fathers_img'];}?>" class="img-circle img " height="50" width="50" ></td>
                    <td><?php echo $row['fathers_names']; ?></td>
                     <td><img src="../images/parents/<?php if($row['mothers_img']==''){ echo "mother.png";} else{ echo $row['mothers_img'];}?>" class="img-circle img " height="50" width="50" ></td>
                    <td><?php echo $row['mothers_names']; ?></td>
                    <td><?php echo $row['phone_number1']."/".$row['phone_number2']; ?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $students_num; ?></td>
                    <td><?php echo $guardian_num; ?></td>
                    
                    <td>
                      <b class="btn btn-sm text-danger p-r" id="<?php echo $row['parent_ID']; ?>"  style="float: right;"> <i class="fas fa-recycle"></i></b>
                      
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
   $(".d-p").click(function(){
     var get_id=$(this).attr("id");
     $(".load-includes").load("includes/manage-parents.php?t=d&i="+get_id);
   });
    $(".p-r").click(function(){
     var get_id=$(this).attr("id");
     $(".load-includes").load("includes/manage-parents.php?t=r&i="+get_id);
   });
      $(".v-p").click(function(){
     var get_id=$(this).attr("id");
     $(".load-parent-info").slideToggle();
     $(".re-load").slideToggle();
     $(".load-parent-info").load("includes/manage-parents.php?t=v-p&i="+get_id);

   });
    
 });
  

</script>
<script type="text/javascript">
 
</script>
	<?php

	}
  if ($_GET['t']=='v-p') {
    $parent_ID=$_GET['i'];
    $sql="SELECT * FROM parents WHERE parent_ID='$parent_ID' ";
    $exe=$conn->query($sql);
    while($row=$exe->fetch_array()){
      $mothers_names=$row['mothers_names'];
      $fathers_names=$row['fathers_names'];
      $fathers_img=$row['fathers_img'];
      $mothers_img=$row['mothers_img'];
      $home_address=$row['home_address'];
      $stop_address=$row['stop_address'];
     
      if ($fathers_img=='') {
        $fathers_img='father.png';
      }
      if ($mothers_img=='') {
        $mothers_img='mother.png';
      }


    }

?>
<script type="text/javascript">
  $(".close-parent-info").click(function(){
     
     $(".load-parent-info").slideToggle();
       $(".re-load").slideToggle();

   });
</script>
  <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
              src="../images/parents/<?php echo $fathers_img; ?>"
              alt="father profile picture">
            </div>

            <h3 class="profile-username text-center"><?php echo $fathers_names; ?></h3>

            <p class="text-muted text-center">Father</p>
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
              src="../images/parents/<?php echo $mothers_img; ?>"
              alt="father profile picture">
            </div>

            <h3 class="profile-username text-center"><?php echo $mothers_names; ?></h3>

            <p class="text-muted text-center">mother</p>
            
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->


      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card card-primary card-outline">
          <div class="card-header p-2">
           <b><i class="fas fa-file"></i> &nbsp Parents  info</b>
           <i class="fa fa-times close-parent-info " style="float: right; padding: 10px;cursor: pointer;" ></i>
         </div><!-- /.card-header -->
         <div class="card-body">
           <div class="row">
            <div class="col-md-4">

             <b><i class="fas fa-map-marker-alt"></i> Address info</b>
             <hr class="bg-primary">
            

             <p><b><i class="fas fa-home"></i>  Home address:</b> <?php echo $home_address; ?></p>
             <p><b> <i class="fas fa-bus"></i> Bus stop address:</b> <?php echo $stop_address; ?></p>    

           </div> <!-- /.col-md-4 -->
           <div class="col-md-8" style="border-left: solid 4px #007bff;">
             <b><i class="fas fa-child"></i> students</b>
             <hr class="bg-primary">
             <div class="row">
               <?php 
               $sql="SELECT * FROM students WHERE parent_ID='$parent_ID'";
               $exe=$conn->query($sql);
               if ($exe->num_rows>0) {
                 while ($row=$exe->fetch_array()) {
                  ?>
                  <div class="col-md-6">
                   
                    <div class="card-body box-profile" style="font-size: 13px;">
                      <div class="text-center">
                        <img class=" img-fluid"
                        src="../images/students/<?php echo $row['profile_image']; ?>"
                        alt="father profile picture"style="height: 200px;" >
                      </div>

                      <b class="text-center" ><?php echo $row['student_names']; ?></b>

                      <p class="text-muted text-center"><?php echo date("Y")-date('Y',$row['DOB']); ?> years</p>
                    </div>
                
                </div>
                  <?php
                }
              }

              ?>
            </div> <!-- /. row -->

          </div> <!-- /.col-md-8 -->
          <div class="col-md-12">
              <b><i class="fas fa-users"></i>   Legal guardians </b>
            <hr class="bg-primary">
            <div class="row">
               <?php 
               $sql="SELECT * FROM legal_guardians WHERE parent_ID='$parent_ID'";
               $exe=$conn->query($sql);
               if ($exe->num_rows>0) {
                 while ($row=$exe->fetch_array()) {
                  ?>
                  <div class="col-md-4 ">
                    <div class="card">
                    <div class="card-body " style="font-size: 13px;">
                      <div class="text-center">
                        <img class="img-fluid"
                        src="../images/guardians/<?php echo $row['g_profile_img']; ?>"
                        alt="father profile picture" >
                      </div>

                      <p class="text-center" ><b><?php echo $row['g_names']; ?></b></p>

                     
                    </div>
                  </div>
                </div>
                  <?php
                }
              }

              ?>
            </div> <!-- /. row -->
          </div><!-- /. col-md-12 -->


        </div> <!-- /. row -->
      </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->

<?php
  }


?>

 