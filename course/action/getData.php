<?php
session_start();
require_once('../../include/initialize.php');

if(isset($_POST['ID'])){

	if(!empty($_POST['ID'])){
		#get ID and pass it into new var name
		$edit_ID = $_POST['ID'];
		$resData = getCData($edit_ID);
		if($resData){
			//return true
			$output = array('C_ID'=>$resData->COURSE_ID,
				'CNAME'=>$resData->COURSE_NAME,
				'descript_name'=>$resData->COURSE_DESC

			);
		}else{
			//query Error

		}
	}

	echo json_encode($output);
}

function getCData($ID){
	global $mydb;
	$mydb->setQuery("select * from course where COURSE_ID = '".$ID."';");
	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur;
	}else{
		return 0;
	}

}


 ?>