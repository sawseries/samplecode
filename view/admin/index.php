<?php
//include("class/config.php");
//include("class/db_class.php");
//include("admin_class.php");
//include("class/public-function.php");
//$db = new db_class();
//
//
//
//$db->close();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TL-Tube Admin Login</title>
<!--
<script src="../js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../js/jquery-validation-1.12.0/dist/jquery.validate.min.js" type="text/javascript"></script>
-->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="tube-style.css">


<style>

h1 { margin:0; padding:0; padding:10px 0; }
p { margin:0; padding:0; }

form.cmxform label.error, label.error, span.error {
	/* remove the next line when you have trouble in IE6 with labels in list */
	color: red;	
	font-size:11px;
	font-family:Tahoma, Geneva, sans-serif;
}
</style>
</head>
<body>


	<div class="container-fluid">

			<div class="row ml-2 mt-2">
				<form name="frm_login" id="frm_login">
					<div class="col-xs-12">		
							<img src="images/logo.png"> <b>Admin</b>
					</div>
					<br>
					


										<div class="form-group margin-bottom-5">
											<label for="username"></label>
											<input type="text" name="username" id="username" class="form-control login-input" placeholder="ชื่อเข้าใช้">
										</div>


											<div class="form-group margin-bottom-5">
														<label for="password"></label>
														<input type="password" name="password" id="password" class="form-control login-input" placeholder="รหัสผ่าน">
											</div>
	
											<input type="hidden" name="act" id="act" value="login">
											<div class="button-tl"><button type="submit"  class="btn btn-sm" name="btn_login" id="btn_login">เข้าสู่ระบบ </button></div>
											

											<span class="error"></span>
		
						<div class="col-xs-12 mt-5 text-secondary">&copy;TL Tube V.2.0</div>
				</form>
			</div><!-- ./row--

	</div><!-- ./container -->


<!--
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script src="js/public-tube.js"></script>


<script src="../js/jquery-validation-1.12.0/dist/jquery.validate.min.js" type="text/javascript"></script>





<script>
$(function() {
	
	$.validator.setDefaults({
		 submitHandler: function() {
				$.post('admin-script.php', 
				$('form#frm_login').serialize() , 
				function(data){
					if (data=='101') {
						$("span.error").html("Username หรือ Password ไม่ถูกต้อง!!");	
					} else {
						window.location.href="vdo.php";	
					}
				});
			}
	});
	
	
	$("#frm_login").validate({
		rules: {
			username:"required",			
			password:"required"
		},
		
		messages: {
			username:"*กรุณาใส่ username",
			password:"*กรุณาใส่ password"			
		}
		
	});

});
</script>

</body>



</html>