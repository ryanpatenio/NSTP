<?php
session_start();
require_once('../../include/initialize.php');


if($_POST['action'] == 'add'){
	$error = 0;
	$error_class_name = '';

	if(!empty($_POST['classname'])){
		$cl_name = $_POST['classname'];
	}else{
		$error++;
		$error_class_name = 'Input field is required!';
	}

	if($error > 0){
		//set all error into array
		$output = array('error'=>true,
			'error_class_name'=>$error_class_name

	);
	}else{
		//not empty fields
		#lets check if the class is not empty
		if(!empty($_POST['classCode'])){
			//true not empty
			$cl_code = $_POST['classCode'];

			#then lets check if the class name is already exist
			$isExist = checkClname($cl_name);
			if($isExist == '1'){
				//found data
				#lets output an error message
				$output = array('cl_code_exist'=>'already exist!');
			}else{
				//not existed
				#then we will do a query to insert new one
				$isInsert = insertNew($cl_code,$cl_name);
				if($isInsert == '1'){
					//return true
					#lets update autocode
					$autoCode = updateCode();
					if($autoCode == '1'){
						//true updated
						$output = array('success'=>'success');
					}else{
						//error updating autocode
						$output = array('err_autocode'=>'error in updating');
					}
					
				}else{
					//error in inserting query
					$output = array('error_query'=>'inserting Data in database error or Failed!');
				}
			}

		}else{
			//cl code not found return error
			#empty Class code input field
			$output = array('error_empty_clCOde'=>'Class code not found!');
		}
	}


	echo json_encode($output);
}


//for updating the class
if($_POST['action']=='edit'){
	$error = 0;
	$err_cl_name = '';

	if(!empty($_POST['editClassName'])){
		$newClname = $_POST['editClassName'];
	}else{
		$error++;
		$err_cl_name = 'Input field is required!';
	}

	if($error > 0){
		#set all the errors into array
		$output = array('error'=>true,
			'err_cl_name'=>$err_cl_name

	);
	}else{
		#lets check if the class ID is not empty
		if(!empty($_POST['hidden_id'])){
			$hdd_id = $_POST['hidden_id'];
			//not empty
			//lets check another class code
				if(!empty($_POST['editClassCode'])){
					//not empty:: lets proceed
					#lets check if the class name is already exist?
					$isExistCl = checkClname($newClname);
					if($isExistCl == '1'){
						//true exist
						#lets output an error message
						$output = array('err_exist_cl_name'=>'class name already exist!');
					}else{
						//true not exist
						#then lets update the class
						$isUpdate = getUpdated($hdd_id,$newClname);
						if($isUpdate == '1'){
							//true
							$output = array('success'=>'success');
						}else{
							//return false
							$output = array('err_update_query'=>'Query Failed!');
						}
					}


				}else{
					//empty class code
					$output = array('err_empty_cl_code'=>'Empty Class Code');
				}

		}else{
			//class ID not found
			$output = array('err_cl_id'=>'class_id not Found!');
		}
		
	}


	echo json_encode($output);
}






#all the function to be used
function checkClname($cl_name){
	global $mydb;

	$mydb->setQuery("select * from class where CLASS_NAME = '".$cl_name."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){

		return 1;
	}else{
		return 0;
	}
}

function insertNew($code,$cl_name){
	global $mydb;
	$mydb->setQuery("INSERT INTO class (CLASS_CODE,CLASS_NAME,INST_ID) VALUES('".$code."','".$cl_name."','0');");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function updateCode(){
	global $mydb;

	$mydb->setQuery("UPDATE autocode SET `END` = `END`+1 where DESCRIPTION='CLASS'");
	$cur = $mydb->executeQuery();
	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function getUpdated($ID,$cl_name){
	global $mydb;
	$mydb->setQuery("UPDATE class SET CLASS_NAME = '".$cl_name."' WHERE CLASS_ID = '".$ID."';");
	$cur = $mydb->executeQuery();
	if($cur){
		return 1;
	}else{
		return 0;
	}
}

 ?>