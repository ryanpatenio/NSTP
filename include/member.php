<?php

require_once("database.php");

class user{

	protected static $tbl_user = "user";

	function AuthenticateADMIN($email, $upass){
		global $mydb;
		$mydb->setQuery("select * from user where USERNAME='".$email."' and PASSWORD=('".$upass."')");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);

		if($row_count ==1){
		
      	$founduser = $mydb->loadSingleResult();

        $_SESSION['user_id']    = $founduser->USER_ID;
        $_SESSION['account_name']    = $founduser->FNAME.' '.$founduser->LNAME; 
    	$_SESSION['type'] = $founduser->TYPE;
    	

			return 1;
		}else{
			return 0;
		}
				
	} 

	function AuthenticateUSER($email,$upass){
		global $mydb;
		$mydb->setQuery("select * from instructor where USERNAME = '".$email."' and PASSWORD=('".$upass."')");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);

		if($row_count ==1){
		
      	$founduser = $mydb->loadSingleResult();

        $_SESSION['inst_id']    = $founduser->INST_ID;
        $_SESSION['account_name']    = $founduser->FNAME.' '.$founduser->LNAME; 
        $_SESSION['status'] = $founduser->STATUS;
    	$_SESSION['type'] = $founduser->TYPE;

    	

			return 1;
		}else{
			return 0;
		}
				
	} 
	//GET  the user Information to fetch in manage my account page
	function getUserInfo($user_id){
		global $mydb;

		$mydb->setQuery("select * from user where USER_ID = {$user_id} Limit 1;");
		$cur = 	$mydb->executeQuery();
		$numrow = $mydb->num_rows($cur);

		if($numrow > 0 ){
			//true
			$foundUserInfo = $mydb->loadSingleResult();
			$fetchData = [
				'fname'=> $foundUserInfo->FNAME,
				'lname'=>$foundUserInfo->LNAME,
				'username'=>$foundUserInfo->USERNAME,
				'img'=>$foundUserInfo->AVATAR
			];

			return $fetchData;
		}

	}



	//for creating history #############
	function HistoryUserLog($accName,$type,$activity){
	global $mydb;

	$mydb->setQuery("INSERT INTO user_log (NAME,ACTIVITY,ACTIVITY_DATE,TYPE) VALUES('".$accName."','".$activity."',now(),'".$type."');");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}

}



	function create_user($name="",$username="",$password="",$type=""){
		global $mydb;

		$mydb->setQuery("INSERT INTO user (ACC_NAME, USERNAME, PASSWORD, TYPE) VALUES ('".$name."', '".$username."', md5('".$password."'),'".$type."');");

		$cur = $mydb->executeQuery();
		
		return $cur;
	}

	function find_all_user($name=""){
			global $mydb;
			$mydb->setQuery(" select * from user where  ACC_NAME ='{$name}'");
			$cur = $mydb->executeQuery();
			$row_count = $mydb->num_rows($cur);//get the number of count
			return $row_count;
	}

	function find_all_email($email=""){
		global $mydb;
		$mydb->setQuery("select * from user where USERNAME = '{$email}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);

		return $row_count;
	}


	function displayAdminAcc($ID){
		global $mydb;

		$mydb->setQuery("select * from ".self::$tbl_user." where USER_ID = {$ID}");


		$cur = $mydb->executeQuery();

		if(!$cur){
			return 0;
		}else{
			return $cur;
		}
	}

	function loadSingleAdminAcc($ID){
		global $mydb;

		$mydb->setQuery("select * from ".self::$tbl_user." where USER_ID = {$ID}");

		$cur = $mydb->loadSingleResult();

		if(!$cur){
			return false;
		}else{
			return $cur;
		}
	}

	function updateAdminAcc($ID,$accountN,$username,$newPass){
		global $mydb;

		$mydb->setQuery("UPDATE ".self::$tbl_user." SET ACC_NAME='".$accountN."', USERNAME='".$username."',PASSWORD = md5('".$newPass."') WHERE  USER_ID={$ID}");

		$cur = $mydb->executeQuery();

		if(!$cur){
			return false;
		}else{
			return $cur;
		}
	}

	
}



 ?>