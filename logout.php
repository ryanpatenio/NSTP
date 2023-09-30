<?php 
require_once 'include/initialize.php';
// Four steps to closing a session
// (i.e. logging out)

// 1. Find the session
@session_start();

// 2. Unset all the session variables
// unset( $_SESSION['USERID'] );
// unset( $_SESSION['FULLNAME'] );
// unset( $_SESSION['USERNAME'] );
// unset( $_SESSION['PASS'] );
// unset( $_SESSION['ROLE'] );
 $history = new user();

if(!$_SESSION['account_name'] && !$_SESSION['type']){
	redirect(WEB_ROOT."login.php");
}else{

	 if($_SESSION['account_name'] && $_SESSION['type']){

 	$activity = 'Logout';
 	$createLog = $history->HistoryUserLog($_SESSION['account_name'],$_SESSION['type'],$activity);
 	
	 	if($createLog){
	 		//true
	 		unset( $_SESSION['student_id'] );
			unset( $_SESSION['account_name'] );
			unset( $_SESSION['type'] );
			unset( $_SESSION['coord_type']);
			unset($_SESSION['acad_id']);
			unset($_SESSION['inst_id']);
			unset($_SESSION['status']);
			unset($_SESSION['type']);
			unset($_SESSION['statusReg']);
			unset($_SESSION['sect_id']);
			unset($_SESSION['nstp']);
			unset($_SESSION['student_name']);
			unset($_SESSION['user_id']);
			//unset( $_SESSION['ACCOUNT_PASSWORD'] );
			//unset( $_SESSION['ACCOUNT_TYPE'] );
			// 4. Destroy the session
			//session_destroy();
			//redirect(WEB_ROOT."login.php?");
			redirect(WEB_ROOT."login.php");
			session_destroy();
	 	}else{
	 		msgBox("Account Name not Found!");
	 	}
 }

}

?>