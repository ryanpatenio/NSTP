<?php
session_start();
require_once("../include/initialize.php");

 ?>


<?php
if(isset($_GET['id'])){
	$ID = $_GET['id'];
}else{
	redirect("../student/");
}


if(isset($_POST['signup2'])){


$data = new studentUser();

$IDNO = trim($ID);
$email = trim($_POST['newEmail']);
$password = trim($_POST['newPass']);
$h_upass = md5($password);

#secondary details
$bday = $_POST['bday'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$contact = $_POST['contact'];


$checkEmail = $data->checkStudentEmailExist($email);

if($checkEmail == 1){
	//true Email Exist
	msgBox("Email Already Exist");
}else{
	//safe email not exist

	$stdUpdate = updatePassAndEmail($IDNO,$email,$h_upass);
	if($stdUpdate==1){
		//true
		$upReg = updateStudentReg($IDNO);		

		if($upReg == 1){
			
			$updateDetails = updateSecondaryDetail($IDNO,$bday,$gender,$contact,$address);
			if($updateDetails =='1'){
				//true
				msgBox("Sign Up Sucessfully!");
				redirect("../student/");
			}else{
				//false
				msgBox('Error! problem in query!');
			}

			
		}else{
			msgBox("There Was A Problem in Database");
			redirect("../student/");
		}

		
	}else{
		msgBox("There Was A problem in Database");
		redirect('../student/');
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
							<label for="idno"><strong>IDNO</strong></label>
							<input type="text" class="form-control" name="idno" placeholder="IDNO" readonly="">
						</div>
						<div class="col">
							<label for="idno"><strong>Student Name</strong></label>
							<input type="text" class="form-control" name="stud_name" placeholder="Name" readonly="">
						</div>
					</div>

<hr>
					<div class="row">
						<div class="col">
							<label for="username"><strong>Create New Email</strong></label>
							<input type="text" class="form-control" name="newEmail" placeholder="Email" required="">
						</div>
					</div>
					
					<div class="row">
						<div class="col"  style="margin-top: 20px;">
							<label for="username"><strong>New Password</strong></label>
							<input type="password" class="form-control" name="newPass" placeholder="New Password" required="">
						</div>
					</div>

					<div class="row">
						<div class="col"  style="margin-top: 20px;">
							<label for="bday"><strong>Birth Day</strong></label>
							<input type="date" class="form-control" name="bday" placeholder="New Password" required="">
						</div>
						<div class="col"  style="margin-top: 20px;">
							<label for="gender"><strong>Gender</strong></label>
							<select class="form-control" name="gender">
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col"  style="margin-top: 20px;">
							<label for="address"><strong>Address</strong></label>
							<input type="text" class="form-control" name="address" placeholder="Address" required="">
						</div>
						<div class="col"  style="margin-top: 20px;">
							<label for="bday"><strong>Contact Number</strong></label>
							<input type="text" maxlength="11" class="form-control" name="contact" required="">
						</div>
					</div>

					
					<div class="row">
						<div class="col"  style="margin-top: 30px;">
							<label for="username"><strong></strong></label>
							<button class="btn btn-primary form-control" name="signup2" style="border-radius: 20px;padding: 10px;"><i class="fa fa-save"></i> Sign Up</button>
						</div>
					</div>

					<div class="row">
						<div class="col" style="margin-top: 30px;">
							<label for="username"><strong></strong></label>
							<a href="../student/" class="btn btn-primary form-control" style="border-radius: 20px;padding: 10px;"><i class="fa fa-arrow-left"></i> Back To Login</a>
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

</body>
</html>

<?php

function updatePassAndEmail($IDNO,$email,$pass){
	global $mydb;
	$mydb->setQuery("UPDATE students SET USERNAME = '".$email."',PASSWORD='".$pass."' WHERE IDNO = '".$IDNO."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function updateStudentReg($IDNO){
	global $mydb;
	$mydb->setQuery("UPDATE students SET REGISTERED = '1' WHERE IDNO = '".$IDNO."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function updateSecondaryDetail($IDNO,$bday,$gender,$contact,$address){
	global $mydb;
	$mydb->setQuery("UPDATE stud_details SET BDAY='".$bday."',GENDER='".$gender."',ADDRESS='".$address."',CONTACT='".$contact."' WHERE IDNO = '".$IDNO."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}

}


 ?>