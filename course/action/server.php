<?php
session_start();
require('../../include/initialize.php');

if($_POST['action'] == 'add'){
	$error = 0;
	$error_course_name = '';
	$error_desc = '';

	if(!empty($_POST['course'])){
		$course = trim($_POST['course']);
	}else{
		$error++;
		$error_course_name = 'Input field is required!';
	}

	if(!empty($_POST['descript'])){
		$descript = $_POST['descript'];
	}else{
		$error++;
		$error_desc = 'Input Field is Required!';
	}

	if($error > 0){
		#set all the errors into array
		$output = array('error'=>true,
			'error_cname'=>$error_course_name,
			'error_desc'=>$error_desc
	);
	}else{
		//all fields not empty
		#lets check if the the course name already exist
		$isExist = isExistCoursename($course);
		if($isExist == '1'){
			//cours already exist
			#lets output ann error
			$output = array('cname_exist'=>'course is already Exist!');
		}else{
			//not already exist
			#then lets insert new Course
			$isInsert = letInsertC($course,$descript);
			if($isInsert == '1'){
				//return true
				#output success
				$output = array('success'=>'success');
			}else{
				//return false;
				#output error
				$output = array('error_inserting_query'=>'error Query!');
			}

		}
	}

	echo json_encode($output);
}


if($_POST['action'] == 'edit'){
	$error=0;
	$error_cname = '';
	$error_cdesc = '';

	if(!empty($_POST['editcourse'])){
		$newCourse = trim($_POST['editcourse']);
	}else{
		$error++;
		$error_cname = 'Input field is required!';
	}

	if(!empty($_POST['editdescript'])){
		$new_desc = $_POST['editdescript'];
	}else{
		$error++;
		$error_cdesc = 'input field is required!';
	}

	if($error > 0){
		#set all the errors into array
		$output = array('error'=>true,
			'error_cname'=>$error_cname,
			'error_cdesc'=>$error_cdesc
	);
	}else{
		//field not empty
		#check if the ID is not empty
		if(!empty($_POST['hidden_ID'])){
			//true not empty
			$hdd_ID = $_POST['hidden_ID'];
			$isExistC = isExistCoursename($newCourse);
			if($isExistC == '1'){
				//true course exist lets output an error message
				$output = array('err_exist_course'=>'course already exist!');
			}else{
				//course not already exist
				#ready for update in the database
				$mydb->setQuery("UPDATE course SET COURSE_NAME = '".$newCourse."',COURSE_DESC = '".$new_desc."' WHERE COURSE_ID ='".$hdd_ID."';");
				$cur = $mydb->executeQuery();

				if($cur){
					//true
					$output = array('success'=>'success');
				}else{
					//query returns false
					$output = array('error_query_update'=>'update Query return error!');
				}
			}


		}else{
			//empty ID
			$output = array('error_empty_ID'=>'hidden ID Empty!');
		}

	}



	echo json_encode($output);


}

function isExistCoursename($cname){
	global $mydb;
	$mydb->setQuery("select * from course where COURSE_NAME = '".$cname."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		return 1;
	}else{
		return 0;
	}
}

function letInsertC($cname,$descript){
	global $mydb;
	$mydb->setQuery("INSERT INTO course (COURSE_NAME,COURSE_DESC) VALUES('".$cname."','".$descript."')");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}



 ?>