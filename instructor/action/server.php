<?php
session_start();
require_once("../../include/initialize.php");
global $mydb;

if($_POST['action'] == 'assigning'){
	#lets check if the user did check the input check list
	if(!empty($_POST['class_id'])){
		//true the user choose any class
		#then lets check if the instructor ID is not missing
		if(!empty($_POST['hidden_inst_id'])){
			$INST_ID = $_POST['hidden_inst_id'];
			//true inst id is not empty
			#then lets query the class ID that choosen by the user into foreach loop
			foreach ($_POST['class_id'] as $class_id) {
				#then lets update the class column name INST ID
				$mydb->setQuery("UPDATE class SET INST_ID='".$INST_ID."' WHERE CLASS_ID ='".$class_id."';");
				$cur = $mydb->executeQuery();
			}
			#after the foreach loop we must check if the executing query are good or return true
			if($cur){
				//then lets output an success message
				$output = array('success'=>'success');
			}else{
				//the query return false
				$output = array('err_query'=>'assigning query return false');
			}

		}else{
			//inst id not found!
			#return error in the front page
			$output = array('err_inst_id'=>'instructor ID not found!');

		}

	}else{
		//the user didnt choose any class
		$output = array('didnt_choose_any'=>'user didnt choose any class');

	}


	echo json_encode($output);
}

//adding new instructor
if($_POST['action']=='add'){
	$error = 0;
	$error_fname = '';
	$error_lname = '';
	$error_uname = '';
	$error_pass = '';
	$error_repass = '';
	$error_pos = '';

	if(!empty($_POST['fname'])){
		$fname = $_POST['fname'];
	}else{
		$error++;
		$error_fname = 'input field is required!';
	}

	if(!empty($_POST['lname'])){
		$lname = $_POST['lname'];
	}else{
		$error++;
		$error_lname = 'input field is required!';
	}
	if(!empty($_POST['uname'])){
		$uname = trim($_POST['uname']);
	}else{
		$error++;
		$error_uname = 'input field is required!';
	}
	if(!empty($_POST['pass'])){
		$pass = trim($_POST['pass']);
	}else{
		$error++;
		$error_pass = 'input field is required!';
	}
	if(!empty($_POST['repass'])){
		$repass = trim($_POST['repass']);
	}else{
		$error++;
		$error_repass = 'input field is required!';
	}
	if(!empty($_POST['pos'])){
		$pos = trim($_POST['pos']);
	}else{
		$error++;
		$error_pos = 'missing value';
	}

	if($error > 0){
		#set all errors into array
		$output = array('error'=>true,
			'error_fname'=>$error_fname,
			'error_lname'=>$error_lname,
			'error_uname'=>$error_uname,
			'error_pass'=>$error_pass,
			'error_repass'=>$error_repass,
			'error_pos'=>$error_pos
	);
	}else{
		//no empty fields
		#lets check if the pass and repass are match!
		if($pass != $repass){
			//not match!
			$output = array('err_pass_repass'=>'not match!');
		}else{
			//pass and repass match!
			$h_pass = md5($repass);
			$isInsert = addNewInst($fname,$lname,$uname,$h_pass);
			if($isInsert == '1'){
				//return true or success
				$output = array('success'=>'success');
			}else{
				//return false : error in query
				$output = array('err_insert'=>'insert query error!');
			}

		}
	}


	echo json_encode($output);
}

//updating instructor
if($_POST['action'] == 'edit'){
	$error = 0;
	$error_ed_fname = '';
	$error_ed_lname = '';
	$error_ed_uname = '';
	$error_ed_pass = '';
	$error_ed_pos = '';

	if(!empty($_POST['editfname'])){
		$ed_fname = $_POST['editfname'];
	}else{
		$error++;
		$error_ed_fname = 'input field is required!';
	}
	if(!empty($_POST['editlname'])){
		$ed_lname = $_POST['editlname'];
	}else{
		$error++;
		$error_ed_lname = 'input field is required!';
	}

	if(!empty($_POST['edituname'])){
		$ed_uname = trim($_POST['edituname']);
	}else{
		$error++;
		$error_ed_uname = 'input field is required!';
	}
	if(!empty($_POST['editpass'])){
		$ed_pass = trim($_POST['editpass']);
	}else{
		$error++;
		$error_ed_pass = 'input field is required';
	}
	if(!empty($_POST['edpos'])){
		$ed_pos = trim($_POST['edpos']);
	}else{
		$error++;
		$error_ed_pos = 'input field is required!';
	}

	if($error > 0){
		#set all errors into array
		$output = array('error'=>true,
			'err_ed_fname'=>$error_ed_fname,
			'err_ed_lname'=>$error_ed_lname,
			'err_ed_uname'=>$error_ed_uname,
			'err_ed_pass'=>$error_ed_pass,
			'err_ed_pos'=>$error_ed_pos
	);
	}else{
		//not empty fields
		#then lets check if instructor ID is not Empty
		if(!empty($_POST['h_editID'])){
			//not empty
			$edit_ID = $_POST['h_editID'];
			#then lets proceed in updating instructor
			$hash_pass = md5($ed_pass);
			$isUpdate = updateInstructor($edit_ID,$ed_fname,$ed_lname,$ed_uname,$hash_pass);

			if($isUpdate == '1'){
				//updated successfully
				#then lets output an success message
				$output = array('success'=>'success');
			}else{
				//error query: updating failed
				$output = array('err_update'=>'updating query failed!');
			}

		}else{
			//empty inst id or missing!
			$output = array('err_empty_id'=>'empty inst ID or not found!');
			
		}
	}


	echo json_encode($output);
}

//#set all the function to be used!
function addNewInst($fname,$lname,$uname,$pass){
	global $mydb;
	$mydb->setQuery("INSERT INTO instructor (FNAME,LNAME,USERNAME,PASSWORD,TYPE,AVATAR,STATUS) VALUES('".$fname."','".$lname."','".$uname."','".$pass."','INSTRUCTOR','null','active')");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function updateInstructor($ID,$fname,$lname,$uname,$pass){
	global $mydb;
	$mydb->setQuery("UPDATE instructor SET FNAME = '".$fname."',LNAME = '".$lname."',USERNAME = '".$uname."',PASSWORD = '".$pass."' WHERE INST_ID = '".$ID."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

 ?>