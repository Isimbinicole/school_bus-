
setInterval(function(){
  $(".b-c").load('includes/dashboard_auto.php?t=cart');
},1000);
$(document).ready(function(){
  $(".lg-btn").click(function(){
   $(".log-mod").html("<br><center><img src='imgs/web_development_imgs/lod.gif'width='30' height='30' ></center><br><br>");
   $(".log-mod").load("includes/logout.php");

   return false;

 });
});

$(function() {
      // Smooth Scrolling
      $('a[href*="#"]:not([href="#"])').click(function() {
        var $this = $(this)
        var d=$this.attr('href');
        if (d=='#aboutus' || d=='#contactus' || d=='#home' ) {
          if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
              $('html, body').animate({
                scrollTop: target.offset().top
              }, 1000);
              return false;
            }
          }
        }
      });
    });

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

            $(".new_password2_error").html("<img src='imgs/web_development_imgs/lod.gif'width='20' height='20'style='margin-top:10px;margin-left:10px;'>");
            $.post('includes/update_client_profile.php?task=update-pass',{new_password1:new_password1,current_password:current_password},function(data){
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


  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      document.getElementById("myBtn").style.display = "block";
    } else {
      document.getElementById("myBtn").style.display = "none";
    }
  }




  