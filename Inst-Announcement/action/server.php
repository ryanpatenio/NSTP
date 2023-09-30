<?php

session_start();
require('../../include/initialize.php');

if($_POST['action']=='add'){


	if(!empty($_POST['hidden_acad'])){
		if(!empty($_POST['listClass'])){
			if(!empty($_POST['annData'])){
				#set all function
				$ann_data = $_POST['annData'];
				$class_id = $_POST['listClass'];
				$acad = $_POST['hidden_acad'];

				$mydb->setQuery("INSERT INTO announcement (CLASS_ID,ACAD_ID,CONTENT,ANN_DATE) VALUES('".$class_id."','".$acad."','".$ann_data."',now());");
				$cur = $mydb->executeQuery();
				$ann_id = $mydb->insert_id();
				if($cur){
					//lets collect all the students where in selected class
					$mydb->setQuery("select IDNO from enrollees where CLASS_ID = '".$class_id."' and ACAD_ID ='".$acad."';");
					$cur2 = $mydb->executeQuery();
					$numrows = $mydb->num_rows($cur2);

					if($numrows > 0){
						//found data
						foreach ($cur2 as $found) {
							# code...
							$dataFound = array('IDNO'=>$found['IDNO']);

							$mydb->setQuery("INSERT INTO student_notif (ANN_ID,IDNO,ACAD_ID,STATUS) VALUES('".$ann_id."','".$dataFound['IDNO']."','".$acad."','0')");
							$cur3 = $mydb->executeQuery();
						}
						if($cur3){
							//executing true
							$output = array('success'=>'success');
						}else{
							//return false
							$output = array('err_query'=>'query error!');
						}


					}else{
						//no data
						$output = array('error_empty_student_data'=>'error');
					}

				}else{	
					//return false
					$output = array('err_inserting_ann_id'=>'error!');
				}
			}
		}
	}

	echo json_encode($output);
}


//for edit announcement
if($_POST['action']=='edit'){

	#lets check if the annnouncement id is not null else return error message
	if(!empty($_POST['hiddenAnnID'])){
		//not empty
		$content = $_POST['annDataEdit'];
		$ann_id = $_POST['hiddenAnnID'];

		$isEdit = getEdit($ann_id,$content);
		if($isEdit == '1'){
			//true
			$output = array('success'=>'success update');
		}else{
			//query return false
			$output = array('err_query'=>'query return false!');
		}


	}else{
		//emtpy ann id return false
		$output = array('err_empty_id'=>'ann id is empty!');
	}


	echo json_encode($output);
}

#let set function
function getEdit($ann_id,$content){
	global $mydb;
	$mydb->setQuery("UPDATE announcement SET CONTENT = '".$content."' WHERE ANN_ID = '".$ann_id."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}


 ?>