<?php
session_start();
require_once("../include/initialize.php");

 ?>

<?php


if(isset($_POST['signup'])){


$data = new studentUser();

$IDNO = trim($_POST['IDNO']);

$password = trim($_POST['password']);

	$reg = $data->checkifReg($IDNO);

	if($reg == 1){
		//registered
		msgBox("Your Account Was Already Registered!");
	}else{
		//not registered
		#then check the IDNO and Password
		$Exist = $data->checkStudExist($IDNO,$password);

		if($Exist == 1){
			//true Exist
			msgBox("Account Found Please Click Button Ok to Proceed");
     		redirect("../student/signUpFormPart2.php?id=".$IDNO);
		}else{
			msgBox("Username OR Password Is incorrect!");

		}

	}

}




 ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign Up</title>
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
				<form class="login100-form validate-form" action="" method="POST">

					<span class="login100-form-title p-b-43"><i class="fa fa-edit"></i>
						Sign Up
					</span>
					<div class="row">
						<div class="col">
							<label for="username"><strong>ID NUMBER</strong></label>
							<input type="text" class="form-control" name="IDNO" placeholder="Put Your ID Number Here" required="">
						</div>
					</div>
					
					<div class="row">
						<div class="col"  style="margin-top: 20px;">
							<label for="username"><strong>Password</strong></label>
							<input type="password" class="form-control" name="password" placeholder="Password" required="">
						</div>
					</div>

					
					<div class="row">
						<div class="col"  style="margin-top: 30px;">
							<label for="username"><strong></strong></label>
							<button class="btn btn-primary form-control" name="signup" style="border-radius: 20px;padding: 10px;"><i class="fa fa-save"></i> Sign Up</button>
						</div>
					</div>

					<div class="row">
						<div class="col" style="margin-top: 30px;">
							<label for="username"><strong></strong></label>
							<a href="../student/" class="btn btn-primary form-control" style="border-radius: 20px;padding: 10px;"><i class="fa fa-arrow-left"></i> Back To Login</a>
						</div>
					</div>
					
					
					
				</form>

				<div class="login100-more" style="background-image: url('../images/cover.jpg');">
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

</body>
</html>

<?php


 ?>