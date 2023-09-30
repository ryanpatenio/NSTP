<?php
session_start();
require('../../include/initialize.php');

if($_POST['action'] == 'add'){
	$error = 0;
	$error_yr_sec = '';

	if(!empty($_POST['yrSec'])){
		$yr_sec = trim($_POST['yrSec']);
	}else{
		$error++;
		$error_yr_sec = 'Input field is required!';
	}

	if($error > 0){
		#set all the error into array
		$output = array('error'=>true,
			'error_yr_sec'=>$error_yr_sec
	);
	}else{
		//not empty fields
		#get the important variable
		$sect_code = $_POST['secCode'];

		#lets check if the yr and section if existing
		$isExist = searchYrExist($yr_sec);
		if($isExist == '1'){
			//yr section already exist
			#then lets output an error
			$output = array('yr_exist'=>'year and section Already Exist!');
		}else{
			//not existing
			$isInsert = letInsert($sect_code,$yr_sec);
				if($isInsert == '1'){
					//query return true
					#after addin New Section 
					#update the end Column in autocode table
					$updateCode = addAutoCode();
					if($updateCode == '1'){
						//updated
						$output = array('success'=>'success');
					}else{
						//not updated
						$output = array('increment_autocode_failed'=>'failed Or error!');
					}
					
				}else{
					//query return false or 0
					$output = array('error_query'=>'query for inserting new section code Error!');
				}
		}

	}


	echo json_encode($output);
}


//updating the section
if($_POST['action'] == 'edit'){
	$error = 0;
	$error_yr__sec = '';

	if(!empty($_POST['editYr'])){
		$yr__sec = trim($_POST['editYr']);
	}else{
		$error++;
		$error_yr__sec = 'Input field is required!';
	}

	if($error > 0){
		//set all the errors into array
		$output = array('error'=>true,
			'error_empty_yr_sec'=>$error_yr__sec
	);
	}else{
		//fields are not empty
		#lets check the ID first
		if(!empty($_POST['hiddenID'])){
			//ID is not EMpty!
			$sectID = $_POST['hiddenID'];
			#lets check if the year and section field already exist
			$ifExist = searchYrExist($yr__sec);
			if($ifExist == '1'){
				//true:: exist
				#lets output an error
				$output = array('error_yr_sec_exist'=>'already Exist!');
			}else{
				//false: not already Exist
				#then lets update the Section
				$mydb->setQuery("UPDATE  sections SET YR_SECTION = '".$yr__sec."' WHERE SECT_ID = '".$sectID."';");
				$cur200 = $mydb->executeQuery();

				if($cur200){
					//true
					$output = array('success'=>'success');
				}else{
					//query error
					$output = array('error_updating'=>'updating Query returns Error!');
				}
			}
		}else{
			//empty ID
			$output = array('error_ID'=>'importan ID is missing!');
		}
	}


	echo json_encode($output);
}

//inserting data from database
function letInsert($sec_code,$yr_sec){
	global $mydb;
	$mydb->setQuery("INSERT INTO sections (SECT_CODE,YR_SECTION) VALUES('".$sec_code."','".$yr_sec."');");
	$cur = $mydb->executeQuery();
	if($cur){
		//return true
		return 1;
	}else{
		//return 0;
		return 0;
	}
}
function searchYrExist($yr_sec){
	global $mydb;
	$mydb->setQuery("select * from sections where YR_SECTION = '".$yr_sec."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		return 1;
	}else{
		return 0;
	}
}

function addAutoCode(){
	global $mydb;
	$mydb->setQuery("UPDATE autocode SET `END` = `END`+1 where DESCRIPTION='SEC'");
	$cur = $mydb->executeQuery();
	if($cur){
		return 1;
	}else{
		return 0;
	}
}


 ?>