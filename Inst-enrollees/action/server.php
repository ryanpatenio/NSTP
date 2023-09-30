<?php
session_start();
require('../../include/initialize.php');

if(isset($_POST['enrolling'])){

	if(!empty($_POST['enrolling'])){

		if(!empty($_POST['class_id'])){

			if(!empty($_POST['sect_id'])){

				if(!empty($_POST['course_id'])){
					if(!empty($_POST['sy'])){

					#lets set all the important variable
					$IDNO = $_POST['enrolling'];
					$class_id = $_POST['class_id'];
					$sect_id = $_POST['sect_id'];
					$course_id = $_POST['course_id'];
					$acad_id = $_POST['sy'];

					#check if the acad id and idno is already exist in the table to avoid duplicate
					$isExistIDNOandACAD = checkIfSameAcad_id($IDNO,$acad_id);
					if($isExistIDNOandACAD == '1'){
						//true Exist
						$output = array('err_IDNO_acad_exist'=>'IDNO and acad id are already exist in the table enrollees');
					}else{
						//false Not exist
						#then lets proceed to the code
						$letsEnroll2 = enrollSecondSem($IDNO,$class_id,$sect_id,$course_id,$acad_id);
						$get_enroll_id = $mydb->insert_id();
						if($letsEnroll2 == '1'){
							//true: enrolled in second semester
							#then lets insert new null grades in the tbl grades
							$isGrade = addingNullGradesSecondSem($IDNO,$acad_id,$get_enroll_id);
							$person = $_SESSION['account_name'];
							if($isGrade == '1'){
								//success output
								#then lets insert history for students
								$isHistory = insertHistory($IDNO,$acad,$person,$class_id);
								if($isHistory == '1'){

									//true success
									$output = array('success'=>'success');

								}else{
									//inserting student history return false!
									$output = array('err_history'=>'inserting history query return false!');
								}
								
							}else{
								//return false executing grades
								$output = array('err_grades'=>'inserting null grades return error');
							}
							
						}else{
							//the query return false
							$output = array('error_enrolling'=>'enrolling for second semester failed or error!');
						}
					}

					}else{
						//empty acad id
						$output = array('empty_acad'=>'acad id is empty!');
					}

				}

			}else{
				//emtpy section id
				$output = array('empty_sect_id'=>'sect id is empty');
			}

		}else{
			//empty class id
			$output = array('empty_class_id'=>'class id is empty!');
		}

	}else{
		//empty IDNO
		$output = array('empty_idno'=>'empty IDNO');
	}


	echo json_encode($output);
}

//for updating the student name 
if($_POST['action'] == 'edit'){
	$error = 0;
	$error_fname = '';
	$error_lname = '';

	if(!empty($_POST['fname'])){
		$fname = $_POST['fname'];
	}else{
		$error++;
		$error_fname = 'input field is required!';
	}
	if(!empty($_POST['lname'])){
		$lname = $_POST['lname'];
	}else{
		$error++;
		$error_lname = 'input field is required!';
	}

	if($error > 0){
		#set all error into json array
		$output = array('error'=>true,
			'error_fname'=>$error_fname,
			'error_lname'=>$error_lname

	);
	}else{
		//no empty fields
		#check if the IDNO is not empty
		if(!empty($_POST['IDNO'])){
			//not empty
			$IDNO = $_POST['IDNO'];
			#then lets update the student name
			$isUpdate = updateStudent($IDNO,$fname,$lname);
			if($isUpdate == '1'){
				//true: updated successfully!
				$output = array('success'=>'success');
			}else{
				//false :update error!
				$output = array('err_update'=>'query Update return error!');
			}
		}else{
			//empty IDNO
			$output = array('err_empty_IDNO'=>'empty IDNO');
		}
	}


	echo json_encode($output);
}

#lets set the function to be use
function enrollSecondSem($IDNO,$class,$sect,$course,$acad){
	global $mydb;
	$mydb->setQuery("INSERT INTO enrollees (IDNO,DATE_ENROLLED,CLASS_ID,SECT_ID,COURSE_ID,ACAD_ID,STATUS,R_STATUS) VALUES('".$IDNO."',now(),'".$class."','".$sect."','".$course."','".$acad."','continuing','pending');");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}


function checkIfSameAcad_id($IDNO,$acad){
	global $mydb;
	$mydb->setQuery("select * from enrollees where IDNO = '".$IDNO."' and ACAD_ID = '".$acad."'");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		return 1;
	}else{
		return 0;
	}
}


function addingNullGradesSecondSem($IDNO,$acad,$enroll_id){
	global $mydb;
	$mydb->setQuery("INSERT INTO grades (IDNO,ENROLL_ID,MID_TERM,END_TERM,FINAL,REMARKS,ACAD_ID) VALUES('".$IDNO."','".$enroll_id."','','','','not good','".$acad."');");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function updateStudent($IDNO,$fname,$lname){
	global $mydb;
	$mydb->setQuery("UPDATE students SET FNAME='".$fname."',LNAME = '".$lname."' WHERE IDNO='".$IDNO."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}
function insertHistory($IDNO,$acad,$person,$class){
	global $mydb;
	$mydb->setQuery("INSERT INTO student_history (IDNO, ACTIVITY, ACAD_ID, PERSON_INCHARGE,PERSON_POSITION,CLASS_ID,H_DATE) VALUES ('".$IDNO."', 'DROP', '".$acad."', '".$person."','INSTRUCTOR','".$class."',now());");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}

}



 ?>