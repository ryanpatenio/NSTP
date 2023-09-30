<?php
session_start();
require('../../include/initialize.php');

if($_POST['action'] == 'add'){

	if(!empty($_POST['hdd_acad'])){

		if(!empty($_POST['class'])){

			if(!empty($_POST['schedDate'])){

				#set all importan variable
				$acad = $_POST['hdd_acad'];
				$class_id = $_POST['class'];
				$s_date = $_POST['schedDate'];
				$topic = $_POST['addTopic'];

				$isInsert  = addSched($class_id,$s_date,$topic,$acad);
				if($isInsert == '1'){
					//return true
					$output = array('success'=>'add success');
				}else{
					//return false
					$output = array('err_add'=>'adding query failed!');
				}
			}else{
				//empty sched date
				$output = array('err_empt_date'=>'empty');
			}


		}else{
			//empty class id
			$output = array('err_empt_class_id'=>'empty');
		}


	}else{
		//empty acad id
		$output = array('err_emp_acad'=>'empty acad');
	}


	echo json_encode($output);
}


//algo for editing schedule
if($_POST['action']=='editS'){

	$sched_id = $_POST['hdd_edit_sched_id'];
	$newTopic = $_POST['editTopic'];
	$newDate = $_POST['editSchedDate'];

	$isUpdate = updateSched($sched_id,$newTopic,$newDate);

	if($isUpdate == '1'){
		//return true
		$output = array('success'=>'update success');
	}else{
		//return false
		$output = array('err_up'=>'update error');
	}


	echo json_encode($output);
}


function addSched($class,$s_date,$topic,$acad){
	global $mydb;
	$mydb->setQuery("INSERT INTO class_sched (CLASS_ID,SESS_DATE,TOPIC,ACAD_ID,STATUS) VALUES('".$class."','".$s_date."','".$topic."','".$acad."','UNDONE');");
	$cur = $mydb->executeQuery();
	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function updateSched($sched_id,$topic,$s_date){
	global $mydb;
	$mydb->setQuery("UPDATE class_sched SET TOPIC='".$topic."',SESS_DATE ='".$s_date."' WHERE CLASS_SCHED_ID = '".$sched_id."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}	

 ?>