<?php
session_start();
$parent_ID=$_SESSION['parent_ID'];
include '../../includes/db_conn.php';

if ($_GET['t']=='d') {
	$g_ID=$_GET['i'];
	$sql="UPDATE `legal_guardians` SET `status` = '0' WHERE `g_ID` = '$g_ID'";
	$exe=$conn->query($sql);
	if ($exe) {
		?>
		<script>
			$(".re-load").load("includes/manage-guardian.php?t=re_load");
			toastr.success('Guardian  deleted successfuly ');
			
		</script>
		<?php
	}
	else{
		?>
		<script>
			toastr.error('Failed to delete guardian, try again ! ')
		</script>
		<?php
	}
}
if ($_GET['t']=='r') {
	$g_ID=$_GET['i'];
	$sql="UPDATE legal_guardians SET `status` = '1' WHERE `g_ID` = '$g_ID'";
	$exe=$conn->query($sql);
	if ($exe) {
		?>
		<script>
			$(".re-load").load("includes/manage-guardian.php?t=re_load");
			toastr.success('Guardian successfuly restored  ');
			
		</script>
		<?php
	}
	else{

		?>
		<script>
			toastr.error('Failed to restore guardian, try again ! ')
		</script>
		<?php

	}
}
if ($_GET['t']=='re_load') {

	?>
<div class="col-6 " style="font-size: 13px;">   
        <div class="card">
          <div class="card-header">

            <a href="add-guardian.php" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add new guardian</a>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-sm " >
              <thead>
                <tr>
                  <th >Profile </th>
                  <th >names </th>                 
                  
                  <th >Edit</th>
                  <th >Trash</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php
                $sql="SELECT * FROM legal_guardians WHERE parent_ID='$parent_ID' AND status='1'";
                $exe=$conn->query($sql);
                while($row=$exe->fetch_array()){
                  
                  ?>
                  <tr>
                    <td><img src="../images/guardians/<?php echo $row['g_profile_img']?>" class="img-circle img " height="50" width="50" ></td>
                    <td><?php echo $row['g_names']; ?></td>
                    
                   
                    <td>
                      <a href="#" class="btn btn-sm text-info" style="float: right;margin-right: 5px;"> <i class="fas fa-pencil-alt mr-1"></i></a>
                    </td>
                    <td>
                      <b class="btn btn-sm text-danger d-g" id="<?php echo $row['g_ID']; ?>"  style="float: right;"> <i class="fas fa-trash-alt"></i></b>
                      
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
            <table id="example2" class="table table-bordered table-sm " >
              <thead>
                <tr>
                  <th >Profile </th>
                  <th >names </th>                 
                  
                  <th >Restore</th>
                
                  
                </tr>
              </thead>
              <tbody>
                <?php
                $sql="SELECT * FROM legal_guardians WHERE parent_ID='$parent_ID' AND status='0'";
                $exe=$conn->query($sql);
                while($row=$exe->fetch_array()){
                  
                  ?>
                  <tr>
                    <td><img src="../images/guardians/<?php echo $row['g_profile_img']?>" class="img-circle img " height="50" width="50" ></td>
                    <td><?php echo $row['g_names']; ?></td>
                   
                   
                    <td>
                      <b class="btn btn-sm text-danger r-g" id="<?php echo $row['g_ID']; ?>"  style="float: right;"> <i class=" fas  fa-recycle"></i></b>
                      
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
        <div class=" load-includes"> <!-- to load the include files  -->

        </div>
        <div class=" load-texts"> <!-- to load the include files  -->

        </div>
        <!--    /.load-includes -->
      </div>
      <!-- /.col -->





        
<script>
  $(function () {

    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": [  "excel", "pdf", "print"]
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
   $(".d-g").click(function(){
     var get_id=$(this).attr("id");
     $(".load-includes").load("includes/manage-guardian.php?t=d&i="+get_id);
   });
   $(".r-g").click(function(){
     var get_id=$(this).attr("id");
     $(".load-includes").load("includes/manage-guardian.php?t=r&i="+get_id);

   });
   


 });
  

</script>
	<?php

	}


?>