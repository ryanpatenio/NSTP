<?php
session_start();
require('../../include/initialize.php');

if($_POST['action'] == 'add_grades'){

	if(!empty($_POST['grade_id'])){
		$grade_id = $_POST['grade_id'];
		$enroll_id = $_POST['hdd_enroll_id'];

		#call all the important variable
		 $mid = $_POST['mid'];
		 $end = $_POST['end'];
		 $final = $_POST['final'];

		 if($mid != '' && $mid <=74 && $mid >100){
		 	//input grade invalid
		 	$output = array('err_mid'=>'input grade invalid');
		 }else if($end != '' && $end <= 74 && $mid >100){
		 	//invalid input
		 	$output = array('err_end'=>'input grade invalid');
		 }else if($final != '' && $final <=74 && $mid >100){
		 	$output = array('err_final'=>'input grade invalid');
		 }else{
		 	//all good
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

		 	#then let update the code
		 	$isUpdate = updateGrades($grade_id,$mid,$end,$final,$remarks);
		 	if($isUpdate == '1'){

		 		$isUpdateEnroll = updateEnroll_R_status($enroll_id,$r_status);
		 		if($isUpdateEnroll == '1'){
		 			$output = array('success'=>'success');
		 		}else{
		 			$output = array('err_update_R'=>'updating enrolling status error!');
		 		}

		 		
		 	}else{
		 		$output = array('err_update'=>'updating grades failed');
		 	}
		 }


	}else{
		$output = array('err_empty_grd_id'=>'empty Grade ID');
	}

	echo json_encode($output);
}

function updateGrades($grd_id,$mid,$end,$final,$remarks){
	global $mydb;
	$mydb->setQuery("UPDATE grades SET MID_TERM='".$mid."',END_TERM='".$end."',FINAL='".$final."',REMARKS='".$remarks."' WHERE GRD_ID ='".$grd_id."';");
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