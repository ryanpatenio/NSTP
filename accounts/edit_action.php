<?php

session_start();
require_once("../include/initialize.php");

if($_POST['action']=='EDIT'){

	$error=0;
	$error_fname='';
	$error_lname='';
	$error_user='';
	$error_oldPass='';
	$error_newpass = '';
	$error_repass = '';



if(!empty($_POST['fname'])){
	$fname = $_POST['fname'];
}else{
	$error++;
	$error_fname ='Input Field is required!';
}
if(!empty($_POST['lname'])){
	$lname = $_POST['lname'];
}else{
	$error++;
	$error_lname = 'Input Field is required!';
}

if(!empty($_POST['newUserEmail'])){
	$email = trim($_POST['newUserEmail']);
}else{
	$error++;
	$error_user = 'Input Field is required!';
}
if(!empty($_POST['oldPass'])){
	$oldpass = $_POST['oldPass'];
	$mdPass = md5($oldpass);
}else{
	$error++;
	$error_oldPass = 'Input Field is required!';
}


if(!empty($_POST['newPass'])){
	$newPass = $_POST['newPass'];

}else{
	$error++;
	$error_newpass = 'Input Field is required!';
}

if(!empty($_POST['cfPass'])){
	$repass = $_POST['cfPass'];
}else{
	$error++;
	$error_repass = 'Input Field is required!';
}



if($error > 0){
	//set all the error into array
	$output = array(
		'error'=>true,
		'error_fname'=>$error_fname,
		'error_lname'=>$error_lname,
		'error_email'=>$error_user,
		'error_oldPass'=>$error_oldPass,
		'error_newpass'=>$error_newpass,
		'error_repass'=>$error_repass
	);
}else{

	// $output = array('success'=>'success');

	if(!empty($_POST['account_id'])){
		$user_id = $_POST['account_id'];

		global $mydb;
		$mydb->setQuery("select * from user where USER_ID = '".$user_id."';");
		$cur = $mydb->executeQuery();
		$numrow = $mydb->num_rows($cur);

		if($numrow > 0){
			//true
			$founduser = $mydb->loadSingleResult();

			$pass = $founduser->PASSWORD;

				if($pass != $mdPass){
					//Old Password is incorrect
					$output = array('error_pass'=>'Incorrect pass');
				}else{
					//old password correct
					

					if($newPass != $repass){
						//new password and Repass Not Match!
						$output = array('newpass_repass'=>'Not match');
					}else{
						//match
						$mydb->setQuery("UPDATE user SET FNAME='".$fname."',LNAME='".$lname."',USERNAME='".$email."',PASSWORD=md5('".$newPass."') where USER_ID = '".$user_id."'");
						$cur2 = $mydb->executeQuery();

						if($cur2){
							//true
						 $output = array('success'=>'success');
						}else{
							//error Query
							$output = array('error_query'=>'query failed');
						}
					}


				}

			}else{
				$output = array('numrow_error'=>'error');


			}
		}else{
			$output = array('empty_id'=>'empty');
		}
}




	echo json_encode($output);

}



?>