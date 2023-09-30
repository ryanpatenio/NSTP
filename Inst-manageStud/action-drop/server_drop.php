<?php
session_start();
require('../../include/initialize.php');

if($_POST['action'] == 'drop1'){

	if(!empty($_POST['hdd_dr_idno'])){
		if(!empty($_POST['hdd_dr_grd_id'])){
			if(!empty($_POST['hdd_dr_enroll_id'])){
				if(!empty($_POST['hdd_dr_class_id'])){
					#set all important variable
					$IDNO = $_POST['hdd_dr_idno'];
					$grade_id = $_POST['hdd_dr_grd_id'];
					$enroll_id = $_POST['hdd_dr_enroll_id'];
					$class_id = $_POST['hdd_dr_class_id'];

					$reason = $_POST['drop1Reason'];
					$data_acad = getSY();
					if($data_acad !='0'){
						$acad = $data_acad->ACAD_ID;
						$isInsert = insertDropTbl($IDNO,$class_id,$acad,$reason);
						if($isInsert == '1'){
							//true inserted
							#lets update enrollees
							$isUpdateEnrollees = updateEnroll_R_status($enroll_id);
							if($isUpdateEnrollees =='1'){
								//true updated r status into drop
								#lets update grades
								$isUpdateGrades =  updateGradeRemarks($grade_id);
								if($isUpdateGrades =='1'){
									//true updated grades
									$person = $_SESSION['account_name'];
									$isHistory = insertHistory($IDNO,$acad,$person,$class_id);

									if($isHistory == '1'){
										//success
										$output = array('success'=>'success');

									}else{
										//insert history return false!
										$output = array('err_history'=>'inserting history return false!');
									}
									
								}else{
									//updating grades error 
									$output = array('err_up_grd'=>'updating error');
								}
							}else{
								//updating enrollees r status failed
								$output = array('err_up_en_r_status'=>'updating failed');
							}
						}else{
							//inserting data into tbl drop failed
							$output = array('err_tbl_drop'=>'Inserting error');
						}
					}else{
						//no school year detected
						$output = array('err_acd_id'=>'no academic year detected');
					}

				}else{
					//emtpy class ID
					$output = array('err_empt_class_id'=>'emtpy');
				}
			}else{
				//emtpy enroll id
				$output = array('err_empt_enroll_id'=>'empty Enroll ID');
			}
		}else{
			//emtpy grade IDNO
			$output = array('err_empt_grd_id'=>'empty');
		}
	}else{
		//empty IDNO
		$output = array('err_empt_idno'=>'empty');
	}

	echo json_encode($output);
}



function getSY(){
	global $mydb;
	$mydb->setQuery("select * from acad_year where STATUS ='YES';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$found = $mydb->loadSingleResult();
		return $found;
	}else{
		return 0;
	}
}

function updateEnroll_R_status($enroll_id){
	global $mydb;
	$mydb->setQuery("UPDATE enrollees SET R_STATUS ='DROP' WHERE ENROLL_ID ='".$enroll_id."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function updateGradeRemarks($grade_id){
	global $mydb;
	$mydb->setQuery("UPDATE grades SET REMARKS ='DROP' WHERE GRD_ID ='".$grade_id."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function insertDropTbl($IDNO,$class_id,$acad,$reason){
	global $mydb;
	$mydb->setQuery("INSERT INTO drop_students (IDNO,CLASS_ID,ACAD_ID,REASON,STATUS) VALUES('".$IDNO."','".$class_id."','".$acad."','".$reason."','DROP');");
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