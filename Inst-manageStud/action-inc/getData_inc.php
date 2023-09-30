<?php
session_start();
require('../../include/initialize.php');

if(isset($_POST['IDNO'])){
	if(!empty($_POST['IDNO'])){
		if(!empty($_POST['acad'])){


			$IDNO = $_POST['IDNO'];
			$acad = $_POST['acad'];

			$data_enroll = getEnroll_ID($IDNO,$acad);
			$data_grade = getGrd_id($IDNO,$acad);
			$data_name = getName($IDNO);

			$output = array('IDNO'=>$data_name->IDNO,
				'name'=>$data_name->FNAME.' '.$data_name->LNAME,
				'grd_id'=>$data_grade->GRD_ID,
				'enroll_id'=>$data_enroll->ENROLL_ID,
				'class_id'=>$data_enroll->CLASS_ID

		);

		}
	}


	echo json_encode($output);
}

function getEnroll_ID($IDNO,$acad){
	global $mydb;
	$mydb->setQuery("select * from enrollees WHERE IDNO = '".$IDNO."' and ACAD_ID = '".$acad."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$founda = $mydb->loadSingleResult();
		return $founda;
	}else{
		return 0;
	}
}

function getGrd_id($IDNO,$acad){
	global $mydb;
	$mydb->setQuery("select * from grades where IDNO = '".$IDNO."' and ACAD_ID ='".$acad."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$found = $mydb->loadSingleResult();
		return $found;
	}else{
		return 0;
	}
}

function getName($IDNO){
	global $mydb;
	$mydb->setQuery("select * from students where IDNO ='".$IDNO."';");
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