$(document).ready(function(){
	
	$(".p-submit").click(function(){
		var email=$("#email").val();
		var password=$("#password").val();
		if(email==""){
			$(".email-error").html("  Invalid email address ");

			$(".email").addClass("error");
			$(".email").addClass("border-danger");
						//toastr.error('Enter your email please!! !');
						return false;

					}
					else if (!email.match(/(@gmail.com)|(@yahoo.com)/)) {
						$(".email-error").html(" Invalid email address ");

						$(".email").addClass("error");
						$(".email").addClass("border-danger");

					}
					else if (password=="") {
						$(".password-error").html("Password empty !!! ");

						$(".password").addClass("error");


					}
					else{
						$.post('includes/login.php?category=parent',{email:email,password:password},function(data){
							$(".password-error").html(data);

						});
					}

					return false;
				});
				// the script for the driver login
				$(".d-submit").click(function(){
					var demail=$("#demail").val();
					var dpassword=$("#dpassword").val();
					if(demail==""){
						$(".demail-error").html(" Invalid email address ");

						$(".demail").addClass("error");
						$(".demail").addClass("border-danger");
					}
					else if (!demail.match(/(@gmail.com)|(@yahoo.com)/)) {
						$(".demail-error").html(" Invalid email address ");

						$(".demail").addClass("error");
						$(".demail").addClass("border-danger");

					}
					else if (dpassword=="") {
						$(".dpassword-error").html("Password empty !!! ");

						$(".dpassword").addClass("error");


					}
					else{
						$.post('includes/login.php?category=driver',{demail:demail,dpassword:dpassword},function(data){
							$(".dcheck_error").html(data);


						});
					}

					return false;
				});

				// the script for the driver login
				$(".s-submit").click(function(){
					var semail=$("#semail").val();
					var spassword=$("#spassword").val();
					if(demail==""){
						$(".semail-error").html(" Invalid email address ");

						$(".semail").addClass("error");
						$(".semail").addClass("border-danger");
					}
					else if (!semail.match(/(@gmail.com)|(@yahoo.com)/)) {
						$(".semail-error").html(" Invalid email address ");

						$(".semail").addClass("error");
						$(".semail").addClass("border-danger");

					}
					else if (spassword=="") {
						$(".spassword-error").html("Password empty !!! ");

						$(".spassword").addClass("error");


					}
					else{
						$.post('includes/login.php?category=school',{semail:semail,spassword:spassword},function(data){
							$(".scheck_error").html(data);


						});
					}

					return false;
				});

				window.sr = ScrollReveal();
				sr.reveal('.navbar', {
					duration: 2000,
					origin:'bottom'
				});
				sr.reveal('.showcase-left', {
					duration: 2000,
					origin:'top',
					distance:'300px'
				});
				sr.reveal('.showcase-right', {
					duration: 2000,
					origin:'right',
					distance:'300px'
				});
				sr.reveal('.showcase-btn', {
					duration: 2000,
					delay: 2000,
					origin:'bottom'
				});
				sr.reveal('#testimonial div', {
					duration: 2000,
					origin:'bottom'
				});
				sr.reveal('.info-left', {
					duration: 2000,
					origin:'left',
					distance:'300px',
					viewFactor: 0.2
				});
				sr.reveal('.info-right', {
					duration: 2000,
					origin:'right',
					distance:'300px',
					viewFactor: 0.2
				});

				$("input").click(function(){
					$(this).removeClass("border-danger");
					$(this).removeClass("error");
					var $thisa = $(this);
					var  selectora = $thisa.attr('class').substr(29,90);
					var axb='.'+selectora+'-error';
					$(axb).html("&nbsp");

				});

			});