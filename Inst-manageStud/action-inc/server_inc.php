<?php
session_start();
require('../../include/initialize.php');

if($_POST['action'] == 'Inc1'){

	if(!empty($_POST['student_idno'])){
		$IDNO = $_POST['student_idno'];

		if(!empty($_POST['hidden_grd_id'])){
			$grade_id = $_POST['hidden_grd_id'];

			if(!empty($_POST['hidden_enroll_id'])){
				$enroll_id = $_POST['hidden_enroll_id'];

				if(!empty($_POST['hdd_class_id'])){
					$class_id = $_POST['hdd_class_id'];
					$reason = $_POST['inc1Reason'];


					$data_acad = getSY();
					if($data_acad !='0'){
						$acad = $data_acad->ACAD_ID;
						$isInsertIncTbl = insertIncTbl($IDNO,$class_id,$acad,$reason);

						if($isInsertIncTbl =='1'){
							//true inserted
							#lets update the enroll R Status into INC
							$isUpdateEn =  updateEnroll_R_status($enroll_id);
							if($isUpdateEn == '1'){
								//true R status updated
								#lets update the grades remark status
								$isUpdateGrade = updateGradeRemarks($grade_id);
								if($isUpdateGrade == '1'){
									//true updated grades remarks into INC
									
									
									$output = array('success'=>'success');
								}else{
									//updating grades remarks return error
									$output = array('err_grades_remarks'=>'updating error!');
								}

							}else{
								//updating enroll r status failed
								$output = array('err_up_r_status'=>'updating error!');
							}
						}else{
							//inserting tbl inc failed
							$output = array('err_tblInc'=>'inserting error!');
						}
					}else{
						// no acad year detected
						$output = array('err_acad'=>'no academic year');
					}


				}else{
					//empty class id 
					$output = array('err_class_id'=>'empty class id');
				}
			}else{
				//empty enroll id
				$output = array('err_en_id'=>'empty');
			}
		}else{
			//empty grades
			$output = array('err_grd_id'=>'empty');
		}
	}else{
		// empty IDNO
		$output = array('err_idno'=>'empty IDNO');
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
	$mydb->setQuery("UPDATE enrollees SET R_STATUS ='INC' WHERE ENROLL_ID ='".$enroll_id."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function updateGradeRemarks($grade_id){
	global $mydb;
	$mydb->setQuery("UPDATE grades SET REMARKS ='INC' WHERE GRD_ID ='".$grade_id."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function insertIncTbl($IDNO,$class_id,$acad,$reason){
	global $mydb;
	$mydb->setQuery("INSERT INTO inc_students (CLASS_ID,IDNO,ACAD_ID,REASON,STATUS) VALUES('".$class_id."','".$IDNO."','".$acad."','".$reason."','INC');");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}



 ?>