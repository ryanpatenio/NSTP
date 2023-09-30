
<?php session_start(); ?>
<?php require_once("../include/initialize.php"); ?>

<?php



if(isset($_POST['login'])){

  $email = trim($_POST['email']);
  $upass  = trim($_POST['password']);
  $h_upass = md5($upass);




  $data = new studentUser();

  $iftrue = $data->AuthenticateStudent($email,$h_upass);



  if($iftrue==1){

  		if($_SESSION['statusReg']=='0'){
  				//false No Username and Password
  					msgBox("Your Account Was Not Already Registered! Please Sign Up First!");
  					redirect("../student/");
  		}else{
  				//true already Registered

  				
  			msgBox("Welcome Student");
  			
  			

  				 redirect("../student/stud_dashboard.php");
  				}
  }else{
  		//false Username and Password Not Found!
  		msgBox("Invalid Username And Password!");
  		//redirect("../student/");
  }


}



 ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../student-asset/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../student-asset/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../student-asset/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../student-asset/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../student-asset/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../student-asset/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../student-asset/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../student-asset/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../student-asset/css/util.css">
	<link rel="stylesheet" type="text/css" href="../student-asset/css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">

			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="">

					<span class="login100-form-title p-b-43"><i class="fa fa-lock"></i>
						Login to continue
					</span>
					<div class="row">
						<div class="col">
							<label for="username"><strong>Email</strong></label>
							<input type="email" class="form-control" name="email" placeholder="Email" required="">
						</div>
					</div>
					<div class="row">
						<div class="col"  style="margin-top: 20px;">
							<label for="username"><strong>Password</strong></label>
							<input type="password" name="password" class="form-control" name="" placeholder="Password" required="">
						</div>
					</div>

					<div class="row">
						<div class="col"  style="margin-top: 30px;">
							<label for="username"><strong></strong></label>
							<button class="btn btn-primary form-control" name="login" style="border-radius: 20px;padding: 10px;"><i class="fa fa-sign-in"></i> Sign In</button>
						</div>
					</div>

					<div class="row">
						<div class="col" style="margin-top: 30px;">
							<label for="username"><strong></strong></label>

							

							<a href="signupForm.php" class="btn btn-primary form-control" style="border-radius: 20px;padding: 10px;"><i class="fa fa-edit"></i> Sign Up</a>
						</div>
					</div>
					
					
					
				</form>

				<div class="login100-more" style="background-image: url('../images/cpu.jpg');">
				</div>
			</div>
		</div>
	</div>


	
	
<!--===============================================================================================-->
	<script src="../student-asset/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../student-asset/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../student-asset/vendor/bootstrap/js/popper.js"></script>
	<script src="../student-asset/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../student-asset/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../student-asset/vendor/daterangepicker/moment.min.js"></script>
	<script src="../student-asset/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../student-asset/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../student-asset/js/main.js"></script>
	<script src="../vendor/jquery/sweetalert.min.js"></script>

	<script type="text/javascript">
		



<?php

check_message();

 ?>


	</script>

</body>
</html>