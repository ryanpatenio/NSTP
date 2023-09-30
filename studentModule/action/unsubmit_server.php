<?php
session_start();
require_once("../../include/initialize.php");


if(isset($_POST['unsubmit'])){
	$IDNO = $_POST['unsubmit'];

	if(!empty($_POST['class_id'])){
		$class_id = $_POST['class_id'];

		if(!empty($_POST['pass_id'])){
			$pass_id = $_POST['pass_id'];

				$acad = getSY();

				if($acad != '0'){
					$acad_id = $acad->ACAD_ID;

					if(!empty($_POST['ass_id'])){
						$ass_id = $_POST['ass_id'];

							//search all in the pass module or getting the file location to delete it in the folder
						$getFileLoc = getUnsubtmitFile_loc($pass_id);
						if($getFileLoc != '0'){

							//this variable holds the location of the file
							$fileLoc = $getFileLoc->FILE_LOC;
							
							//updating the assign module status into 0 means it reset
							$mydb->setQuery("UPDATE assign_module SET STATUS ='0' WHERE ASSIGN_ID ='".$ass_id."';");
							$cur2 = $mydb->executeQuery();	

							if($cur2){

								//deleting file in the folder student Pass Mod
								unlink("../../studentPassMod/".$fileLoc);

								$mydb->setQuery("DELETE FROM pass_module WHERE  PASS_ID ='".$pass_id."' LIMIT 1");
								$cur3 = $mydb->executeQuery();

								if($cur3){
									

									//creating message
									$message='UNSUBMITTED FILE';
									$mydb->setQuery("INSERT INTO teacher_notif (IDNO,CLASS_ID,ASSIGN_ID,PASS_ID,ACAD_ID,UPLOADED_DATE,MESSAGE,READM) VALUES('".$IDNO."','".$class_id."','".$ass_id."','".$pass_id."','".$acad_id."',now(),'".$message."','0')");
									$res2 = $mydb->executeQuery();

									if($res2){
										$output = array('success'=>'Module Unsubmitted Successfully!');
									}else{
										//creating report notification error
										$output = array('error_reporting'=>'create notification Failed');
									}
									
								}else{
									//deleting current pass Module
									$output = array('error_delQuery'=>'error Delete Pass Module Query!');
								}
							}else{
								//query 2 failed:: updating Assign Module
								$output = array('error_query2'=>'updating assign Module Failed');
							}
						}else{
							//searching Query not Found! query 1
							$output = array('error_query1'=>'searching Query Error!');
						}

					}else{

						//empty assign id
						$output = array('error_assign_id'=>'empty assign ID!');
					}


				}else{
					//no academic year detected!
					$output = array('err_no_acad'=>'no academic year detected!');
				}
		
		}else{
			//pass id not Found!
			$output = array('error_pass_id'=>'pass id not Found!');
		}
	}else{
		//class ID not Found!
		$output = array('error_class_id'=>'class ID not Found!');
	}
	echo json_encode($output);
}

#set function

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

function getUnsubtmitFile_loc($pass_id){
	global $mydb;
	$mydb->setQuery("select * from pass_module where PASS_ID ='".$pass_id."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$found = $mydb->loadSingleResult();
		return $found;
	}else{
		return 0;
	}


}

 ?>