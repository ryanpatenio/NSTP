<?php
session_start();
require('../../include/initialize.php');

if(isset($_POST['class_sched_id'])){

	if(!empty($_POST['class_sched_id'])){
		$sched_id = $_POST['class_sched_id'];


		$data = getSched($sched_id);
		if($data !='0'){
			$output = array('sched_id'=>$data->CLASS_SCHED_ID,
				'topic'=>$data->TOPIC,
				'class'=>$data->CLASS_NAME,
				's_date'=>$data->SESS_DATE

		);
		}


	}


	echo json_encode($output);
}

function getSched($id){
	global $mydb;
	$mydb->setQuery("select cl.CLASS_SCHED_ID,cl.TOPIC,cll.CLASS_NAME,cl.SESS_DATE from class_sched cl,class cll where cl.CLASS_ID = cll.CLASS_ID and cl.CLASS_SCHED_ID = '".$id."';");
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