<?php
session_start();
require_once('../../include/initialize.php');


if(isset($_POST['ID'])){
	#we will make sure the ID is not empty
	if(!empty($_POST['ID'])){
		//not empty
		$ID = $_POST['ID'];
		$data = getClassData($ID);
		if($data){
			$output = array('ID'=>$data->CLASS_ID,
				'code'=>$data->CLASS_CODE,
				'cl_name'=>$data->CLASS_NAME

		);
		}


	}else{	
		//empty ID
		$output = array('empty_ID'=>'Class ID not found!');
	}


	echo json_encode($output);
}

function getClassData($ID){
	global $mydb;
	$mydb->setQuery("select * from class where CLASS_ID = '".$ID."';");
	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}



 ?>