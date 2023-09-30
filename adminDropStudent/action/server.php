<?php

session_start();
require('../../include/initialize.php');


if($_POST['action']=='re_enroll_first'){

	if(!empty($_POST['hidden_enroll_id1'])){

		if(!empty($_POST['sel_class'])){

			if(!empty($_POST['avail_sy'])){

				if(!empty($_POST['hidden_idno1'])){

						#set all important variables
					$enroll_id = $_POST['hidden_enroll_id1'];
					$class = $_POST['sel_class'];
					$acad = $_POST['avail_sy'];
					$IDNO = $_POST['hidden_idno1'];
					$person = $_SESSION['account_name'];

					$isReenroll = reEnrollStudent($enroll_id,$class,$acad);
					if($isReenroll == '1'){

						$isUpdateGrades = updateGrades($enroll_id,$acad);
						if($isUpdateGrades == '1'){	

							$isHistory = insertHistory($IDNO,$acad,$person,$class);
							if($isHistory == '1'){
								//success
								$output = array('success'=>'success');
							}else{
								//error in inserting in history
								$output = array('err_insert_history'=>'inserting history return false!');
							}

						}else{
							//updating grades return false
							$output = array('err_updating_grades'=>'updating grades query return false!');
						}

					}else{
						// enroll return false
						$output = array('err_re_enroll'=>'re enroll query return false!');
					}


				}else{
					//empty idno
					$output = array('err_empty_idno'=>'empty idno');
				}

			}else{
				//emtpy academic year availability
				$output = array('err_not_SY_compatible'=>'school year not compatible for re enrolling');
			}

		}else{
			//emoty selected class
			$output = array('err_no_class_selected'=>'empty class');
		}

	}else{
		//empty enroll id
		$output = array('err_enroll_id'=>'empty enroll id');
	}




	echo json_encode($output);
}

#to dooo ................................................... add drop for second semester



if($_POST['action']=='re_enroll_second'){

	if(!empty($_POST['hidden_enroll_id2'])){

		if(!empty($_POST['hidden_idno2'])){


			if(!empty($_POST['sel_class2'])){

				if(!empty($_POST['avail_sy2'])){


					#the set all the important variable
					$IDNO2 = $_POST['hidden_idno2'];
					$ENROLL_ID2 = $_POST['hidden_enroll_id2'];
					$class2 = $_POST['sel_class2'];
					$acad2 = $_POST['avail_sy2'];
					$person2 = $_SESSION['account_name'];

					$isReenroll2 = reEnrollStudent($ENROLL_ID2,$class2,$acad2);
					if($isReenroll2 == '1'){
						//true
						#then lets update the grades
						$isUpdateGrades2 = updateGrades($ENROLL_ID2,$acad2);
						if($isUpdateGrades2=='1'){
							//true
							#then lets insert history of the students
							$isHistory2 = insertHistory($IDNO2,$acad2,$person2,$class2);
							if($isHistory2 == '1'){
								//true:: all important query return true
								$output = array('success'=>'success');
							}else{
								//inserting student history return false!
								$output = array('err_in_history'=>'inserting tbl student history query return false!');
							}
						}else{
							//updating tbl grades query return false!
							$output = array('err_up_grades'=>'updating grades return false!');
						}

					}else{
						//enrolling query returns false!
						$output = array('err_enroll_query'=>'enroll query return false!');
					}


				}else{
					//no available school year
					$output = array('err_sy_not_compatible'=>'school year not compatible');
				}


			}else{
				// no selected class 
				$output = array('err_no_class'=>'no class selected!');
			}

		}else{
			//empty idno
			$output = array('err_empty_idno'=>'idno found empty!');
		}

	}else{
		//enroll id found empty
		$output = array('err_enroll_id2'=>'enroll id2 found empty!');
	}


	echo json_encode($output);
}





#set function 
function reEnrollStudent($enroll_id,$class,$acad){
	global $mydb;
	$mydb->setQuery("UPDATE enrollees SET CLASS_ID = '".$class."',ACAD_ID='".$acad."',R_STATUS = 'pending' WHERE ENROLL_ID = '".$enroll_id."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function updateGrades($enroll_id,$acad){
	global $mydb;
	$mydb->setQuery("UPDATE grades SET MID_TERM='',END_TERM='',FINAL='',REMARKS = 'not good',ACAD_ID = '".$acad."' WHERE ENROLL_ID = '".$enroll_id."'; ");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function insertHistory($IDNO,$acad,$person,$class){
	global $mydb;
	$mydb->setQuery("INSERT INTO student_history (IDNO, ACTIVITY, ACAD_ID, PERSON_INCHARGE,PERSON_POSITION,CLASS_ID,H_DATE) VALUES ('".$IDNO."', 'RE-ENROLLED', '".$acad."', '".$person."','ADMIN','".$class."',now());");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}

}

 ?>