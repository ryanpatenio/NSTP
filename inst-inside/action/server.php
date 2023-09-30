<?php
session_start();
require('../../include/initialize.php');


if($_POST['action'] == 'add'){
	$error = 0;
	$error_idno = '';
	$error_fname = '';
	$error_lname = '';

	$error_acad = '';

	if(!empty($_POST['IDNO'])){
		$IDNO = trim($_POST['IDNO']);
	}else{
		$error++;
		$error_idno = 'input field is required!';
	}
	if(!empty($_POST['fname'])){
		$fname = $_POST['fname'];
	}else{
		$error++;
		$error_fname = 'input field is required!';
	}
	if(!empty($_POST['lname'])){
		$lname = $_POST['lname'];
	}else{
		$error++;
		$error_lname = 'input field is required!';
	}

	if(!empty($_POST['sy_id'])){
		$ACAD_ID = $_POST['sy_id'];
	}else{
		$error++;
		$error_acad = 'No School year detected!';
	}


	if($error > 0){
		#set all the errors into json array
		$output = array('error'=>true,
			'error_fname'=>$error_fname,
			'error_lname'=>$error_lname,
			'error_idno'=>$error_idno,
			'error_acad'=>$error_acad

	);
	}else{
		//no empty fields
		#get Status
		$status = $_POST['Status'];
		$class = $_POST['class'];
		$section = $_POST['section'];
		$course = $_POST['course'];
		#then we must check if the idno is already exist before inserting it
		$isExist = checkIDNO($IDNO);
		if($isExist == '1'){
			//IDNO is exist
			#output warning error
			$output = array('ID_exist'=>'idno is already exist!');
		}else{
			//not exist
			#lets create a password generator
			$length = 4;
		   	$generator = str_shuffle(str_repeat($x='cHyZ', ceil($length/strlen($x))));
			$genPass = $generator.date("dmYHis");
			#let insert data into  tbl students
			$tblStudent = doInserttblStudent($IDNO,$fname,$lname,$genPass);

			if($tblStudent == '1'){
				//true: inserted
				#then lets insert another into tbl student details
				$stud_details = doInserttblStud_details($IDNO);

				if($stud_details == '1'){
					//true : inserted in tbl student details table
					#then lets inserte another into tbl enrollees
					$enrollees = doInserttblEnrollees($IDNO,$class,$section,$course,$ACAD_ID,$status);
					$enroll_id = $mydb->insert_id();
					if($enrollees == '1'){
						//true inserted successfully
						#then lets insert another into tbl grades
						$grades = doInserttblgrades($IDNO,$ACAD_ID,$enroll_id);
						if($grades == '1'){
							//grades inserted true
							$mydb->setQuery("UPDATE students SET ENROLLED = 1 WHERE IDNO = '".$IDNO."';");
							$exe = $mydb->executeQuery();
							if($exe){
								$person = $_SESSION['account_name'];
								$isHistory = insertHistory($IDNO,$ACAD_ID,$person,$class);

								if($isHistory == '1'){

									$output = array('success'=>'success');

								}else{
									//history return false
									$output = array('err_history'=>'error');
								}

							}else{
								//error 
								$output = array('err_up_enrolled_status'=>'tbl student enrolled statu failed to update');
							}
						}else{
							//grades inserted false
							$output = array('err_grades'=>'faile to insert in grades table');
						}
					}else{
						//failed to insert into tbl enrolleees
						$output = array('err_enrollees'=>'failed to insert in tbl enrollees');
					}
				}else{
					//false: tbl stud details return false or error
					$output = array('err_stud_details'=>'return error!');
				}

			}else{
				//inserting tbl students return error or failed
				$output = array('err_tblStudent'=>'failed to inserte tbl students');
			}

		}

	}


	echo json_encode($output);
}


#let set all the function we need
function checkIDNO($IDNO){
	global $mydb;
	$mydb->setQuery("select * from students where IDNO = '".$IDNO."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		return 1;
	}else{
		return 0;
	}
}

function doInserttblStudent($IDNO,$fname,$lname,$password){
	global $mydb;
	$mydb->setQuery("INSERT INTO students (IDNO,FNAME,LNAME,USERNAME,PASSWORD,AVATAR,REGISTERED,ENROLLED) VALUES('".$IDNO."','".$fname."','".$lname."','null','".$password."','null','0','0');");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function doInserttblStud_details($IDNO){
	global $mydb;
	$mydb->setQuery("INSERT INTO stud_details(IDNO,BDAY,GENDER,ADDRESS,CONTACT) VALUES('".$IDNO."','','','','');");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function doInserttblEnrollees($IDNO,$class,$sect,$course,$acad,$status){
	global $mydb;
	$mydb->setQuery("INSERT INTO enrollees(IDNO,DATE_ENROLLED,CLASS_ID,SECT_ID,COURSE_ID,ACAD_ID,STATUS,R_STATUS) VALUES('".$IDNO."',now(),'".$class."','".$sect."','".$course."','".$acad."','".$status."','pending');");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function doInserttblgrades($IDNO,$acad,$enroll_id){
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
	$mydb->setQuery("INSERT INTO student_history (IDNO, ACTIVITY, ACAD_ID, PERSON_INCHARGE,PERSON_POSITION,CLASS_ID,H_DATE) VALUES ('".$IDNO."', 'ENROLLED', '".$acad."', '".$person."','INSTRUCTOR','".$class."',now());");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}

}


 ?>
