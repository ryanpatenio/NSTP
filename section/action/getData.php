<?php
session_start();
require('../../include/initialize.php');

if(isset($_POST['ID'])){
	#lets check if not empty :: secondary checking
	if(!empty($_POST['ID'])){
		//true
		$ID = $_POST['ID'];
		$data = resData($ID);
		if($data){
			//true
			$output = array('sect_id'=>$data->SECT_ID,
				'code'=>$data->SECT_CODE,
				'yr_sec'=>$data->YR_SECTION
		);
		}else{
			//false
		}
	}else{
		//false
	}

	echo json_encode($output);
}

//declare a function
#getData
function resData($ID){
	global $mydb;
	$mydb->setQuery("select * from sections where SECT_ID = '".$ID."';");
	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}



 ?>