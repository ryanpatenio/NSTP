<?php
session_start();
require('../../include/initialize.php');


#enrolling for second semester

if(isset($_POST['IDNO2'])){


	if(!empty($_POST['class_id2'])){

		if(!empty($_POST['sect_id2'])){

			if(!empty($_POST['course_id2'])){

				if(!empty($_POST['sy'])){

					if(!empty($_POST['IDNO2'])){

						#lets declare all variable

						$IDNO = $_POST['IDNO2'];
						$sect = $_POST['sect_id2'];
						$course = $_POST['course_id2'];
						$acad_id = $_POST['sy'];
						$class = $_POST['class_id2'];

						$checkIfSameAcad_id = checkIfSameAcad_id($IDNO,$acad_id);

						if($checkIfSameAcad_id == '1'){
							//data inside the tbl enrollees found an existing records just like this data
							$output = array('err_same'=>'found the same result');


						}else{
							//not same

						$letEnrollSecondSem = enrollSecondSem($IDNO,$class,$sect,$course,$acad_id);
						$enroll_id = $mydb->insert_id();

							if($letEnrollSecondSem == '1'){
								$addnullGrades = addingNullGradesSecondSem($IDNO,$acad_id,$enroll_id);
								if($addnullGrades == '1'){
									//success								
									$person = $_SESSION['account_name'];
									$isHistory = insertHistory($IDNO,$acad_id,$person,$class);

									if($isHistory == '1'){
										//success
										$output = array('success'=>'success');

									}else{
										//inserting history return false
										$output = array('err_history'=>'inserting history found empty!');
									}

								}else{
									// adding grades return false!
									$output = array('err_insertingnull_grades'=>'updating grades return error');
								}

							}else{
								//return false
								$output = array('error_tbl_enrollees'=>'inserting query return error');

							}
						}
					

					}else{
						//empty idno
						$output = array('err_idno'=>'empty idno');
					}


				}else{	
					//school year is empty
					$output = array('erro_acad'=>'acad is empty');
				}


			}else{
				//course id empty
				$output = array('err_course_id'=>'course id empty');
			}


		}else{
			//empty sect id
			$output = array('err_sect_id'=>'sect id found empty');
		}


	}else{
		//class id empty
		$output = array('err_class_id'=>'class id found found empty');
	}

	echo json_encode($output);
}


#set function
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

