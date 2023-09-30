<?php
session_start();
require('../../include/initialize.php');

if(isset($_POST['addGrades1'])){
	if(!empty($_POST['addGrades1'])){
		if(!empty($_POST['IDNO'])){
			$acad_id = $_POST['addGrades1'];
			$IDNO = $_POST['IDNO'];
			$enroll_id = $_POST['enroll_id'];

			$data_name = getStudentName($IDNO);
			$data = getDataGrades($IDNO,$acad_id);

			if($data){
				$output = array('grd_id'=>$data->GRD_ID,
					'mid'=>$data->MID_TERM,
					'end'=>$data->END_TERM,
					'final'=>$data->FINAL,
					'name'=>$data_name->FNAME.' '.$data_name->LNAME,
					'enroll_id'=>$enroll_id
			);
			}else{
				$output = array('err_query'=>'get grades query Failed');
			}


		}else{
			$output = array('err_idno_empty'=>'empty');
		}
	}

	echo json_encode($output);
}

function getDataGrades($IDNO,$acad){
	global $mydb;
	$mydb->setQuery("select * from grades where IDNO = '".$IDNO."' and ACAD_ID = '".$acad."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$found = $mydb->loadSingleResult();
		return $found;
	}else{
		return 0;
	}
}

function getStudentName($IDNO){
	global $mydb;
	$mydb->setQuery("select * from students WHERE IDNO = '".$IDNO."';");
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
