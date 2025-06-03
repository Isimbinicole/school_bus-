
  // change password script
  $(".save").click(function(){
    var current_password=$("#current_password").val();
    var new_password1=$("#new_password1").val();
    var new_password2=$("#new_password2").val();
    if(current_password==''){
     
toastr.error("Enter your current password !");
      return false;

    }
    if(new_password1==''){
      toastr.error(" Enter password new !");
    
      return false;

    }
    if(!isNaN(new_password1)){
     toastr.error("  Password must contain charachers  !");
   

      return false;

    }
    if(new_password1.length<8){
     toastr.error(" Password  must be 8 characters !");
      

      return false;

    }
    if(new_password1.length>16){
      toastr.error(" Password  must be between 8 and 16 characters !");

      return false;

    }
    if(new_password2==''){
      toastr.error("  Confirm password !");
     
      return false;

    }
    if(new_password2!=new_password1){
     toastr.error("  Password does not match!");
            return false;

    }

    $(".pass-update").html("Updating password.....");
    $.post('includes/change-password.php',{new_password1:new_password1,current_password:current_password},function(data){
      $(".pass-update").html(data);
    });
    return false;

  });
 
