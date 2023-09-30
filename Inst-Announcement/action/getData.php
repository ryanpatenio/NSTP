<?php

session_start();
require('../../include/initialize.php');

if(isset($_POST['ann_id'])){
	$ann_id = $_POST['ann_id'];

	$data = getData($ann_id);
	if($data !='0'){
		$output = array('ann_id'=>$data->ANN_ID,
			'content'=>$data->CONTENT,
			'class_name'=>$data->CLASS_NAME

	);
	}else{
		$output = array('err_query_getData'=>'get Data query return false or null');
	}


	echo json_encode($output);
}

//for displaying the announcement details or info
if(isset($_POST['id'])){

	$announcement_id = $_POST['id'];
	$details = getDetails($announcement_id);

	if($details !='0'){
		//true
		$str_date = date("d M Y",strtotime($details->ANN_DATE));
		$output = array('con'=>$details->CONTENT,
			'to'=>$details->CLASS_NAME,
			'f_date'=>$str_date
	);


	}else{
		//return error message
		$output = array('err_query_details'=>'query return false!');
	}

	echo json_encode($output);
}


#set function
function getData($ann_id){
	global $mydb;
	$mydb->setQuery("select ann.ANN_ID,ann.CONTENT,cl.CLASS_NAME from announcement ann,class cl where ann.CLASS_ID = cl.CLASS_ID and ann.ANN_ID = '".$ann_id."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$found = $mydb->loadSingleResult();
		return $found;
	}else{
		return 0;
	}
}

function getDetails($ann_id){
	global $mydb;
	$mydb->setQuery("select ann.CONTENT,cl.CLASS_NAME,ann.ANN_DATE from announcement ann,class cl where ann.CLASS_ID = cl.CLASS_ID and ann.ANN_ID = '".$ann_id."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$found = $mydb->loadSingleResult();
		return $found;
	}else{
		return 0;
	}

}


 ?>