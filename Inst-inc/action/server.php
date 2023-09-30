<?php
session_start();
require('../../include/initialize.php');

if($_POST['action']=='edit'){

	if(!empty($_POST['enroll_id'])){

		if(!empty($_POST['grd_id'])){

			if(!empty($_POST['mid'])){
				if(!empty($_POST['end'])){
					if(!empty($_POST['fin'])){

						#set all importan variables
						$enroll_id = $_POST['enroll_id'];
						$grd_id = $_POST['grd_id'];
						$mid = $_POST['mid'];
						$end = $_POST['end'];
						$final = $_POST['fin'];

						$isUpdateEn = updateEnrolleesR_status($enroll_id);
						if($isUpdateEn == '1'){
							//return true
							#then lets update the grades tbl
							$isUpdateGrades = updateGrades($grd_id,$mid,$end,$final);
							if($isUpdateGrades == '1'){
								//return true
								$output = array('success'=>'success updating inc');
							}else{
								//return false
								$output = array('err_updating_grades'=>'return error!');
							}
						}else{
							//return false
							$output = array('err_updating_enroll'=>'query return error');
						}

					}else{
						//empty final grades
						$output = array('err_empt_final'=>'empty final grades');
					}
				}else{
					//empty end term grades
					$output = array('err_empt_end'=>'empty end term grades');
				}
			}else{
				//empty mid term grades
				$output = array('err_empt_mid'=>'empty mid term grades');
			}


		}else{
			//empty grd id
			$output = array('err_empt_grd_id'=>'empty');
		}

	}else{
		//empty enroll id
		$output = array('err_empt_enroll_id'=>'empty');
	}



	echo json_encode($output);
}
#set function

function updateEnrolleesR_status($enroll_id){
	global $mydb;
	$mydb->setQuery("UPDATE enrollees SET R_STATUS = 'DONE' WHERE ENROLL_ID = '".$enroll_id."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function updateGrades($grd_id,$mid,$end,$final){
	global $mydb;
	$mydb->setQuery("UPDATE grades SET MID_TERM = '".$mid."', END_TERM = '".$end."', FINAL = '".$final."',REMARKS = 'PASSED' WHERE GRD_ID = '".$grd_id."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}




 ?>