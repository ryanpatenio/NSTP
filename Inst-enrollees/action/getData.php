<?php
session_start();
require('../../include/initialize.php');

if(isset($_POST['IDNO'])){

if(!empty($_POST['IDNO'])){
	$IDNO = $_POST['IDNO'];
	$data = getStudent($IDNO);
	if($data !='0'){
		echo ' <tr>
                   <td>'.$data->IDNO.'</td>
                   <td>'.$data->FNAME.' '.$data->LNAME.'</td>
                   <td><button class="btn btn-sm btn-warning" id="enrollme" data-value="'.$data->IDNO.'"><i class="fa fa-arrow-right"> Enroll</i></button></td>
                 </tr>';

	}else{
		echo ' <tr>
                   <td><p>No Result(s) found</p></td>
                   <td></td>
                   <td></td>
                 </tr>';
	}
}


}


if(isset($_POST['edit'])){
	if(!empty($_POST['edit'])){
		#call the function
		$enroll_id = $_POST['edit'];
		$data2 = getDataEdit($enroll_id);

		if($data2){
			$output = array('enroll_id'=>$data2->ENROLL_ID,
				'IDNO'=>$data2->IDNO,
				'fname'=>$data2->FNAME,
				'lname'=>$data2->LNAME,
				'sy'=>$data2->SCHOOL_YEAR,
				'sem'=>$data2->SEMESTER

		);
		}
	}


	echo json_encode($output);
}


#set all function to be used
function getStudent($IDNO){
	global $mydb;
	$mydb->setQuery("select * from students where IDNO = '".$IDNO."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$found = $mydb->loadSingleResult();
		return $found;
	}else{
		return 0;
	}

}

function getDataEdit($enroll_id){
	global $mydb;
	$mydb->setQuery("select en.ENROLL_ID, en.IDNO,s.FNAME,s.LNAME,ac.SCHOOL_YEAR,ac.SEMESTER from enrollees en,students s,acad_year ac where en.IDNO = s.IDNO and en.ACAD_ID = ac.ACAD_ID and en.ENROLL_ID = '".$enroll_id."';");
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