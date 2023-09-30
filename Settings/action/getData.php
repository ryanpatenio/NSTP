<?php
session_start();
require_once("../../include/initialize.php");


if(isset($_POST['id'])){
	if(!empty($_POST['id'])){
		$SY_ID = $_POST['id'];
		//get Data through selected school Year ID
		$SY_DATA = schoolYR_data($SY_ID);
		if($SY_DATA != '0'){
			//return true
			$output = array('SY'=>$SY_DATA->SCHOOL_YEAR,
				'SEM'=>$SY_DATA->SEMESTER,
				'ID'=>$SY_DATA->ACAD_ID,
				'STATUS'=>$SY_DATA->STATUS
		);
		}else{
			// false
		}



	}else{	
		//empty
		
	}


	echo json_encode($output);
}


function schoolYR_data($SY_ID){
	global $mydb;
	$mydb->setQuery("select * from acad_year where ACAD_ID = '".$SY_ID."';");
	$search = $mydb->loadSingleResult();
	if($search){
		return $search;
	}else{
		return 0;
	}
}




 ?>