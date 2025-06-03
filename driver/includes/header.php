   <nav class="navbar navbar-expand-md navbar-light bg-white sticky-top info-left" id="home">
     <div class="container-fluid">
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
         <span class="navbar-toggler-icon"></span>
       </button>
       <a class="navbar-brand" href="index.php"><i class="fa fa-bus"></i></a>
         <b class="navbar-text" >School bus tracking system</b>
       <div class="collapse navbar-collapse" id="navbarResponsive">
         <ul class="navbar-nav ml-auto showcase">
          
           <li class="nav-item"><a href="index.php" class="nav-link active">Dashboard</a> </li>
           
           <li class="nav-item"><a href="report.php" class="nav-link">Report</a> </li>
                
                  <?php
                  include '../includes/db_conn.php';
                  $sql="SELECT * FROM drivers WHERE driver_ID='".$_SESSION["driver_ID"]."'";
                  $exe=$conn->query($sql);
                  if ($exe->num_rows>0) {
                    while ($row=$exe->fetch_array()) {
                      $name= $row['driver_names'];
                    }

                  }     
                  ?>
                  <div class="dropdown nav-link" >
                    <button class="btn btn-outline-secondary dropdown-toggle  " type="button" data-toggle="dropdown" >&nbsp <?php  echo $name; ?>
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right ">
                      <li class="logout" ><a href="includes/logout.php"><i class="fa fa-power-off"></i>&nbsp Logout</a></li>

                      <li data-toggle="modal" data-target="#change-password"><a href="#"> <i class="fa fa-key"></i>&nbspChange  password</a></li>

                    </ul>
                  </div>

               
    
            </ul> 
          </div>

        </div>
      </nav>
      <hr style="margin-top: 0px;">
      <style type="text/css">
        .nav-item{
          margin-top: 10px;
        }

    .dropdown-menu li a{
      text-decoration: none;
      color: black;
    }
    .dropdown-menu li {
      padding: 5px;
      border-bottom:  solid 1px #f8f9fa;
    }
    .dropdown-menu li:hover {
      background-color: #f8f9fa;
    }
    .dropdown-menu {
      padding: 0px;
      margin-top: 0px;
    }
.form-group span{
  font-size: 13px;
  color:red;
}
      </style>
      <!-- change password Modal -->
<div id="change-password" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        Change password
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>

      <div class="modal-body">
        <form method="post">
          <div class="form-group">

            <input type="password" class="form-control form-control-sm" id="current_password" class="current_password" placeholder="Enter your current password">
            <span class="current_password_error"></span>
          </div>
          <div class="form-group">

            <input type="password" class="form-control form-control-sm" id="new_password1" class="new_password1" placeholder="Enter your new password">
            <span class="new_password1_error"></span>
          </div>
          <div class="form-group">

            <input type="password" class="form-control form-control-sm" id="new_password2" class="new_password2" placeholder="Confirm password">
            <span class="new_password2_error"></span>
          </div>
          <button type="submit" class="btn btn-dark btn-sm save" style="width: 100%;">Update</button>
        </form>
      </div>

    </div>

  </div>
</div>
      <script type="text/javascript">
  // change password script
  $(".save").click(function(){
    var current_password=$("#current_password").val();
    var new_password1=$("#new_password1").val();
    var new_password2=$("#new_password2").val();
    if(current_password==''){
      $(".current_password_error").html(" <i class='fa fa-exclamation-triangle '></i> Enter your current password !");
      $(".current_password").addClass("error");

      return false;

    }
    if(new_password1==''){
      $(".new_password1_error").html(" <i class='fa fa-exclamation-triangle '></i> Enter password new !");
      $(".new_password1").addClass("error");

      return false;

    }
    if(!isNaN(new_password1)){
      $(".new_password1_error").html(" <i class='fa fa-exclamation-triangle '></i> Password must contain charachers  !");
      $(".new_password1").addClass("error");

      return false;

    }
    if(new_password1.length<8){
      $(".new_password1_error").html(" <i class='fa fa-exclamation-triangle '></i>Password  must be 8 characters !");
      $(".new_password1").addClass("error");

      return false;

    }
    if(new_password1.length>16){
      $(".new_password1_error").html(" <i class='fa fa-exclamation-triangle '></i>Password  must be between 8 and 16 characters !");
      $(".new_password1").addClass("error");

      return false;

    }
    if(new_password2==''){
      $(".new_password2_error").html(" <i class='fa fa-exclamation-triangle '></i> Confirm password !");
      $(".new_password2").addClass("error");

      return false;

    }
    if(new_password2!=new_password1){
      $(".new_password2_error").html(" <i class='fa fa-exclamation-triangle '></i> Password mismarth!");
      $(".new_password2").addClass("error");

      return false;

    }

    $(".new_password2_error").html("<br>Updating password.....");
    $.post('includes/profile-handler.php?t=update-pass',{new_password1:new_password1,current_password:current_password},function(data){
      $(".new_password2_error").html(data);
    });
    return false;

  });
  $("input,select").click(function(){
    $(this).removeClass("border-danger");
    $(this).removeClass("error");
    var $thisa = $(this);
    var  selectora = $thisa.attr('id');
    
    var axb='.'+selectora+'_error';
    $(axb).html("");


  });

</script>