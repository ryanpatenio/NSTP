<?php
session_start();
require('../../include/initialize.php');







if(isset($_POST['IDNO2'])){

if(!empty($_POST['IDNO2'])){

	
	$IDNO = $_POST['IDNO2'];
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






if(isset($_POST['new_get_id'])){
	if(!empty($_POST['new_get_id'])){
		$IDNO = $_POST['new_get_id'];

		$student_data = getRequestIDNO($IDNO);
		

		if($student_data){
				//lets output all the data into json array
				$output = array('ID'=>$student_data->IDNO,
					'name'=>$student_data->FNAME.' '.$student_data->LNAME,

			);
			
		}

	}



	echo json_encode($output);
}





function getRequestIDNO($IDNO){
	global $mydb;
	$mydb->setQuery("select * from students where IDNO = '".$IDNO."';");

	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

function getStudentData($enroll_id){
	global $mydb;
	$mydb->setQuery("");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$found = $mydb->loadSingleResult();
		return $found;
	}else{
		return 0;
	}

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

 ?>