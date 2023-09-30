<?php
session_start();
require('../../include/initialize.php');

if($_POST['action'] == 'addnewEnrollment'){

	if(!empty($_POST['IDNO'])){
		if(!empty($_POST['class'])){
			if(!empty($_POST['section'])){
				if(!empty($_POST['course'])){
					if(!empty($_POST['sy_id'])){
						if(!empty($_POST['Status'])){
						#then lets put all the data into new variable name
							$IDNO = $_POST['IDNO'];
							$CLASS = $_POST['class'];
							$SECTION = $_POST['section'];
							$COURSE  = $_POST['course'];
							$ACAD_ID = $_POST['sy_id'];
							$STATUS = $_POST['Status'];

							$isEnroll = letEnroll($IDNO,$CLASS,$SECTION,$COURSE,$ACAD_ID,$STATUS);
							$enroll_id = $mydb->insert_id();
							if($isEnroll == '1'){
								//enroll successfully!
								
								#then lets insert his null grades for this school year
								$isInsertGrades = insertGradesNull($IDNO,$ACAD_ID,$enroll_id);
								if($isInsertGrades == '1'){
									//true inserting null grades successfully
										#then lets update the student status into 1 : mean its already enrolled
										$isUpdateStatus = updateStudentEnrollStatus1($IDNO);
										if($isUpdateStatus == '1'){
											//true: success
											

											$isHistory = insertHistory($IDNO,$ACAD_ID,$_SESSION['account_name'],$CLASS);
											if($isHistory == '1'){
												$output = array('success'=>'success');
											}else{
												//history function return false or 0
												$output = array('err_history_failed'=>'histroy failed to insert!');
											}

										}else{
											//return false;
											$output = array('err_update_stats'=>'updating student enrolled status error!');
										}

								}else{
									//inserting null grades query failed
									$output = array('err_insert_null_grades'=>'inserting null grades query return false!');
								}
							
							}else{
								//query return error! or failed to execute
								$output = array('err_query_enroll'=>'enrolling query failed!');
							}

						}else{
							//missing student status
							$output = array('err_empty_stats'=>'status is empty!');
						}

					}else{
						//missing acad id or school year ID
						$output = array('err_empty_acad'=>'acad id is empty!');
					}
				}else{
					//missing course id
					$output = array('err_empty_course'=>'course ID not found!');
				}
			}else{
				//missing section id
				$output = array('err_empty_sectID'=>'section ID not found!');
			}
		}else{
			//missing class id
			$output = array('err_empty_class'=>'class ID is empty!');
		}
	}else{
		//missing IDNO
		$output = array('err_empty_idno'=>'IDNO is empty!');
	}



	echo json_encode($output);
}






#set all function to be use
function letEnroll($IDNO,$class,$section,$course,$acad,$status){
	global $mydb;
	$mydb->setQuery("INSERT INTO enrollees (IDNO,DATE_ENROLLED,CLASS_ID,SECT_ID,COURSE_ID,ACAD_ID,STATUS,R_STATUS) VALUES('".$IDNO."',now(),'".$class."','".$section."','".$course."','".$acad."','".$status."','pending');");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function updateStudentEnrollStatus1($IDNO){
	global $mydb;
	$mydb->setQuery("UPDATE students SET ENROLLED = '1' WHERE IDNO = '".$IDNO."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function insertGradesNull($IDNO,$acad,$enroll_id){
	global $mydb;
	$mydb->setQuery("INSERT INTO grades (IDNO,ENROLL_ID,MID_TERM,END_TERM,FINAL,REMARKS,ACAD_ID) VALUES('".$IDNO."','".$enroll_id."','null','null','null','not good','".$acad."');");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function insertHistory($IDNO,$acad,$person,$class){
	global $mydb;
	$mydb->setQuery("INSERT INTO student_history (IDNO, ACTIVITY, ACAD_ID, PERSON_INCHARGE,PERSON_POSITION,CLASS_ID,H_DATE) VALUES ('".$IDNO."', 'ENROLLED', '".$acad."', '".$person."','ADMIN','".$class."',now());");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}

}



 ?>