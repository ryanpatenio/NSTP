<?php

session_start();
require('../../include/initialize.php');


if($_POST['action']=='get_edit_grades'){


	if(!empty($_POST['hdd_enroll_id'])){

		#call all the important variable
		 $enroll_id = $_POST['hdd_enroll_id'];
		 $mid = $_POST['md'];
		 $end = $_POST['end'];
		 $final = $_POST['fn'];

		 if($mid != '' && $mid <=74 && $mid >100){
		 	//input grade invalid
		 	$output = array('err_mid'=>'input grade invalid');
		 }else if($end != '' && $end <= 74 && $mid >100){
		 	//invalid input
		 	$output = array('err_end'=>'input grade invalid');
		 }else if($final != '' && $final <=74 && $mid >100){
		 	$output = array('err_final'=>'input grade invalid');
		 }else{
		 	//valid input grades

		 	#condition if all the fields is not empty
		 	if($mid ==''){
		 		$remarks = 'not good';
		 		$r_status = 'pending';
		 	}else if($end == ''){
		 		$remarks ='not good';
		 		$r_status = 'pending';
		 	}else if($final !=''){
		 		$remarks ='PASSED';
		 		$r_status = 'DONE';
		 	}

		 	#the lets call the function
		 	$isUpdateGrades = updateGrades($enroll_id,$mid,$end,$final,$remarks);
		 	if($isUpdateGrades == '1'){
		 		//return true : updated successfully
		 		#then lets update the enroll r status 
		 		$isUpdate_r_status = updateEnroll_R_status($enroll_id,$r_status);
		 		if($isUpdate_r_status == '1'){

		 			//success
		 			$output = array('success'=>'success');


		 		}else{	
		 			//updating r status return false
		 			$output = array('err_up_r_status'=>'updating enroll r status return false!');
		 		}
		 	}else{
		 		//updating grades return false
		 		$output = array('err_up_grades'=>'updating grades query return false!');
		 	}



		 }



	}else{
		//hidden enroll id not found
		$output = array('err_enroll_id'=>'enroll id not found!');
	}


echo json_encode($output);

}

function updateGrades($enroll_id,$mid,$end,$final,$remarks){
	global $mydb;
	$mydb->setQuery("UPDATE grades SET MID_TERM='".$mid."',END_TERM='".$end."',FINAL='".$final."',REMARKS='".$remarks."' WHERE ENROLL_ID ='".$enroll_id."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}

}

function updateEnroll_R_status($enroll_id,$r_status){
	global $mydb;
	$mydb->setQuery("UPDATE enrollees SET R_STATUS = '".$r_status."' WHERE ENROLL_ID = '".$enroll_id."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

 ?>