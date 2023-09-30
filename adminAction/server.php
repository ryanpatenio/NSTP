<?php
session_start();
require_once("../include/initialize.php");

if($_POST['action']=='process'){

#// set error variable
	$error = 0;
	$error_email = '';
	$error_pass = '';

	if(!empty($_POST['user_email'])){
		$u_email = trim($_POST['user_email']);
	}else{
		$error++;
		$error_email = 'Input Field Is Required!';
	}

	if(!empty($_POST['user_pass'])){
		$u_pass = md5($_POST['user_pass']);
	}else{
		$error++;
		$error_pass = 'Input Field Is Required!';
	}

	if($error > 0){
		//error True
		$output = array(
			'error'=>true,
			'error_email' => $error_email,
			'error_pass' => $error_pass
		);
	}else{
		//$output = array('success'=>'success');

		 $iflogin = new user();

		 $iftrue = $iflogin::AuthenticateUser($u_email,$u_pass);

		 if($iftrue == 1){
		 	//true
		 	//check if the user is active
		 	if($_SESSION['status']=='active'){
		 		//make sure all the user can log in, there status is active
		 		//check if what kind of User
		 		if($_SESSION['type']=='INSTRUCTOR'){
		 			//Instructor::
		 			$type = 'INSTRUCTOR';
		 			$checkIn = HistoryUserLog($_SESSION['account_name'],$type);
		 			if($checkIn == 1){
		 				//true

		 				$output = array('success_inst'=>'true');
		 			}
		 			

		 		}else if($_SESSION['type'] == 'REGISTRAR'){
		 			//Registrar
		 			$output = array('success_reg' => 'true');

		 		}else{
		 			//Error
		 			$output = array('error_Type'=>'System Error in Instructor Type');
		 		}
		 	}else{
		 		//Account Is not Active
		 		$output = array('error_active'=>'Account Not Active');
		 	}
		 }else{
		 	//Account Not Found!
		 	$output = array('error_acc'=>'Acc Not Found!');
		 }
	}



	echo json_encode($output);
}


if($_POST['action'] == 'AdmProcess'){

//set all the error variable
	$error = 0;
	$err_email = '';
	$err_pass = '';

	if(!empty($_POST['Myemail'])){
		#get the value
		$email = trim($_POST['Myemail']);
	}else{
		$error++;
		$err_email = 'Input Field Is Required!';
	}

	if(!empty($_POST['Mypass'])){
		#get the Value
		$pass = md5($_POST['Mypass']);
	}else{
		$error++;
		$err_pass = 'Input Field Is Required';
	}

	if($error > 0){
		//true error
		$output = array(
			'error'=>true,
			'err_email' => $err_email,
			'err_pass' => $err_pass

		);
	}else{
		// $output = array('success'=>'success');

		$iflogin = new user();
		$iftrue2 = $iflogin::AuthenticateADMIN($email,$pass);

		 if($iftrue2 == 1){

		 	if($_SESSION['type'] != ''){
		 		if($_SESSION['type'] == 'ADMIN'){
		 			//ADMIN::
		 			$type = 'ADMIN';
		 			//user Log ::
		 			$checkIn2 = HistoryUserLog($_SESSION['account_name'],$type);
		 			if($checkIn2 == 1){
		 				$output = array('success_login'=>'success');
		 			}	 			
		 		}else if($_SESSION['type']=='REGISTRAR'){
		 			$output = array('regist'=>'success Registrar');
		 		}
		 		else{
		 			//Error
		 			$output = array('err_type'=> 'Account Not Found!');
		 		}

		 	}
		 }else{
		 	//Acc Not Found!
		 	$output = array('err_acc'=>'Account Not Found!');
		 }
	}




	echo json_encode($output);

}




function HistoryUserLog($accName,$type){
	global $mydb;

	$mydb->setQuery("INSERT INTO user_log (NAME,ACTIVITY,ACTIVITY_DATE,TYPE) VALUES('".$accName."','Login',now(),'".$type."');");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}

}



?>