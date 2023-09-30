<?php
session_start();
require('../../include/initialize.php');


if($_POST['action'] == 'edit'){

	if(!empty($_POST['ENROLL_ID'])){
		if(!empty($_POST['mid'])){

			if(!empty($_POST['end'])){

				if(!empty($_POST['fin'])){

					if(!empty($_POST['class_id'])){

						if(!empty($_POST['IDNO'])){
							//not empty


								#set all importan variable
								$ENROLL_ID = $_POST['ENROLL_ID'];
								$mid = $_POST['mid'];
								$end = $_POST['end'];
								$fin = $_POST['fin'];
								$class_id = $_POST['class_id'];
								$person = $_SESSION['account_name'];
								$IDNO = $_POST['IDNO'];

								$isAcad = getSY();

								if($isAcad !='0'){
									//theres academic year
									$acad = $isAcad;

										$isUpdateEnrollees = updateEnroll_r_status($ENROLL_ID);
										if($isUpdateEnrollees == '1'){
											//true

											$isupdatergades = updateGrades($ENROLL_ID,$mid,$end,$fin);
											if($isupdatergades == '1'){
												//true
												#then lets insert into student history table

												$isHistory = insertHistory($IDNO,$acad,$person,$class_id);

												if($isHistory =='1'){
													//true
													$output = array('success'=>'success');
												}else{
													//inserting student history query return false!
													$output = array('err_history'=>'inserting student history return false!');
												}


											}else{
												//return false!
												$output = array('error_update_grades'=>'updating grades return false!');
											}


										}else{
											//return query false!
											$output = array('err_update_r_status'=>'error updating enrollees return false!');
										}

								}else{
									//no academic year detected
									$output = array('err_acad'=>'no academic year detected!');
								}


						}else{
							//empty IDNO
							$output = array('err_IDNO'=>'IDNO found empty!');
						}


					}else{
						//empty class id
						$output = array('err_class_id'=>'class id empty!');
					}	



				}else{
					//empty final grades
					$output = array('error_final_grades'=>'is empty!');
				}

			}else{
				//empty end term grades
				$output = array('error_end_term'=>'end term grades is empty!');
			}


		}else{
			//empty mid grades
			$output = array('error_mid_grades'=>'mid grades is empty');
		}


	}else{
		//empty enroll id
		$output = array('error_enroll_id'=>'empty enroll id');
	}


	echo json_encode($output);
}

#set all function

function updateEnroll_r_status($enroll_id){
	global $mydb;
	$mydb->setQuery("UPDATE enrollees SET R_STATUS = 'DONE' WHERE ENROLL_ID = '".$enroll_id."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function updateGrades($enroll_id,$mid,$end,$final){
	global $mydb;

	$mydb->setQuery("UPDATE grades SET  MID_TERM='".$mid."',END_TERM='".$end."',FINAL='".$final."',REMARKS = 'PASSED' WHERE ENROLL_ID = '".$enroll_id."';");
	$cur = $mydb->executeQuery();
	if($cur){
		return 1;
	}else{
		return 0;
	}
}


################# to dooooooo ...... set studet story
function insertHistory($IDNO,$acad,$person,$class){
	global $mydb;
	$mydb->setQuery("INSERT INTO student_history (IDNO, ACTIVITY, ACAD_ID, PERSON_INCHARGE,PERSON_POSITION,CLASS_ID,H_DATE) VALUES ('".$IDNO."', 'UPDATED INC', '".$acad."', '".$person."','ADMIN','".$class."',now());");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}

}


function getSY(){
	global $mydb;
	$mydb->setQuery("select * from acad_year where STATUS='YES';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$found = $mydb->loadSingleResult();
		return $found->ACAD_ID;
	}else{
		return 0;
	}

}

 ?>