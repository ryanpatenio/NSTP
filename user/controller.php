<?php
session_start();
global $mydb;
require_once("../include/initialize.php");

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doAdd();
	break;
	
	case 'update' :
	doUpdate();
	break;
	
	case 'delete' :
	doDelete();
	break;

	case 'photos' :
	doupdateimage();
	break;

 
	}

function doAdd(){
	if(isset($_POST['addBtn'])){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$username = $_POST['username'];
		$pass = trim($_POST['pass']);
		$newPass = md5($pass);
		$type = trim($_POST['type']);

		$will = insert($fname,$lname,$username,$newPass,$type);

		if($will == 1){
			msgBox("New Account Successfully added!");
			redirect('../user/');
		}else{
			msgBox("Error!");
			redirect('../user/add.php');
		}

	}
}


function insert($fname,$lname,$username,$pass,$type){
	global $mydb;
	$mydb->setQuery("INSERT INTO user (FNAME,LNAME,USERNAME,PASSWORD,TYPE,AVATAR) VALUES('".$fname."','".$lname."','".$username."','".$pass."','".$type."','null');");
	$cur = $mydb->executeQuery();
	if($cur){
		return 1;
	}else{
		return 0;
	}
}

?>