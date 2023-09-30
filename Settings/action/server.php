<?php
session_start();
require_once("../../include/initialize.php");
global $mydb;
if($_POST['action']=='edit'){

	if(!empty($_POST['editID'])){
		//get the SY ID
		$edit_ID = $_POST['editID'];
		$SY_status = $_POST['editstatus'];
		if($SY_status == 'YES'){
			//selected YES
					//checking if theres already Default SY STATUS
				$default = getDefaultSY();
				if($default != '0'){
					//true: SY STATUS = YES
					$mydb->setQuery("UPDATE acad_year SET STATUS = 'NO' WHERE ACAD_ID = '".$default."';");
					$cur2 = $mydb->executeQuery();
					if($cur2){
						//lets update New Default
						$mydb->setQuery("UPDATE acad_year SET STATUS  = 'YES' WHERE ACAD_ID = '".$edit_ID."';");
						$cur3 = $mydb->executeQuery();
						if($cur3){
							//true
							$output = array('success'=>'success');
						}else{
							$output = array('error_new_def'=>'new Default Query Error!');
						}
					}else{
						//query for updating current default error
						$output = array('error_cur_def'=>'current Default Error Quer!');
					}
				}else{
					//No Default Exist
					$mydb->setQuery("UPDATE acad_year SET STATUS = '".$SY_status."' WHERE ACAD_ID = '".$edit_ID."';");
					$cur5 = $mydb->executeQuery();
					if($cur5){
						//still updated
						$output = array('error_NO_default'=>'No Default found! But Still Updated into success');
					}else{
						//error query
						$output = array('error_5'=>'query 5 error!');
					}
					
				}	

		}else{
			//user selected NO
			$justUpdateSY = justUpdate($edit_ID);
			if($justUpdateSY == '1'){
				//true
					$output = array('success'=>'success');
			}else{
				//false
				$output = array('error_no'=>'error');
			}
		}

		
	}

	echo json_encode($output);
}



//adding new Shool year
if($_POST['action']=='add'){
	$error = 0;
	$error_sy = '';

	if(!empty($_POST['addSY'])){
		$newSY = $_POST['addSY'];
	}else{
		$error++;
		$error_sy = 'Input field is required!';
	}

	if($error > 0){
		//set all the error into array
		$output = array('error'=>true,
			'error_sy'=>$error_sy
	);
	}else{
		//input fields not empty
		#get all the important Value
		$newSem = $_POST['sem'];
		$newStatus = $_POST['status'];

		//check if the user selected default status
		if($newStatus == 'YES'){
			//user selected Default "YES"
			#lets check if theres already default SY
			$isDefault = getDefaultSY();
			if($isDefault != '0'){
				//true:: theres Default SY
				#then lets update the default SY
				$mydb->setQuery("UPDATE acad_year SET STATUS = 'NO' WHERE ACAD_ID = '".$isDefault."';");
				$cur100 = $mydb->executeQuery();
				if($cur100){
					//the query return true
					#then lets add New Default SY
					$mydb->setQuery("INSERT INTO acad_year (SCHOOL_YEAR,SEMESTER,STATUS) VALUES('".$newSY."','".$newSem."','".$newStatus."')");
					$cur101 = $mydb->executeQuery();
					if($cur101){
						//the query return true
						$output = array('success'=>'success');
					}else{
						//query return false
					}
				}else{
					//the query return false
				}
			}else{
				//NO Defaualt SY
				#no detected default SY:: good time to add New Default
				#just ADD NEW
				$mydb->setQuery("INSERT INTO acad_year (SCHOOL_YEAR,SEMESTER,STATUS) VALUES('".$newSY."','".$newSem."','".$newStatus."')");
				$cur102 = $mydb->executeQuery();
				if($cur102){
					//return true
					$output = array('success'=>'success');
				}else{
					//return false
				}
			}
		}else{
			//user selected "NO!"
			#just ADD NEW SY with not default STATUS
			$mydb->setQuery("INSERT INTO acad_year (SCHOOL_YEAR,SEMESTER,STATUS) VALUES('".$newSY."','".$newSem."','NO')");
			$cur103 = $mydb->executeQuery();
			if($cur103){
				//return true
				$output = array('success'=>'success');
			}else{
				//return false
			}
		}
	}

	echo json_encode($output);
}

function getDefaultSY(){
	global $mydb;
	$mydb->setQuery("select * from acad_year where STATUS = 'YES';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0 ){
		//true: found Data
		$foundData = $mydb->loadSingleResult();
		$data = $foundData->ACAD_ID;
		return $data;
	}else{
		return 0;
	}
}

function justUpdate($ID){
	global $mydb;
	$mydb->setQuery("UPDATE acad_year SET STATUS = 'NO' WHERE ACAD_ID = '".$ID."';");
	$cur = $mydb->executeQuery();
	if($cur){
		return 1;
	}else{
		return 0;
	}
}


 ?>