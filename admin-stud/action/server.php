<?php
session_start();
require('../../include/initialize.php');


if($_POST['action'] == 'add'){

	$error = 0;
	$error_IDNO = '';
	$erorr_fname = '';
	$error_lname = '';
	$error_bday = '';
	$error_gender = '';
	$error_address = '';
	$error_contact = '';

	if(!empty($_POST['IDNO'])){
		$IDNO = trim($_POST['IDNO']);
	}else{
		$error++;
		$error_IDNO = 'Input field is required!';
	}
	if(!empty($_POST['fname'])){
		$fname = $_POST['fname'];
	}else{
		$error++;
		$erorr_fname = 'Input field is required!';
	}

	if(!empty($_POST['lname'])){
		$lname = $_POST['lname'];
	}else{
		$error++;
		$error_lname = 'Input field is required!';
	}

	if(!empty($_POST['bday'])){
		$bday = $_POST['bday'];
	}else{
		$error++;
		$error_bday = 'Input field is required!';
	}

	if(!empty($_POST['gender'])){
		$gender = $_POST['gender'];
	}else{
		$error++;
		$error_gender = 'Input field is required!';
	}
	if(!empty($_POST['contact'])){
		$contact = $_POST['contact'];
	}else{
		$error++;
	}
	if(!empty($_POST['address'])){
		$address = $_POST['address'];
	}else{
		$error++;
		$error_address = 'Input field is requied!';
	}

	if($error > 0){
		#lets output all the errors into json array
		$output = array('error'=>true,
			'error_IDNO'=>$error_IDNO,
			'error_fname'=>$error_fname,
			'error_lname'=>$error_lname,
			'error_bday'=>$error_bday,
			'error_gender'=>$error_gender,
			'error_address'=>$error_address,
			'error_contact'=>$error_contact
	);
	}else{
		//no empty fields
		#but we must check if the IDNO is still exist in the database

		$isID_Exist = isIDexist($IDNO);
		if($isID_Exist == '1'){
			//IDNO is exist
			#then lets return an error message
			$output = array('IDNO_exist'=>'IDNO is Exist!');
		}else{

		#then lets insert all the data into 2 different tables the tbl student and the tblstudent details
		#we must create a temporary random password
		$length = 4;
	   	$generator = str_shuffle(str_repeat($x='cHyZ', ceil($length/strlen($x))));
		$genPass = $generator.date("dmYHis");
		#lets insert the student first then the student details
		$isInsertS = insertStudents($IDNO,$fname,$lname,$genPass);

			if($isInsertS == '1'){
				//true inserted
				#then lets insert the student details
				$isInsertDetails = insertDetails($IDNO,$bday,$gender,$address,$contact);
				if($isInsertDetails == '1'){
					//true inserted successfully
					#then lets output a success message
					$output = array('success'=>'success');
				}else{
					//inserting student details query failed
					$output = array('err_details'=>'inserting Details Query return Failed!');
				}
			}else{
				//error inserting new students
				$output = array('err_new_stud'=>'inserting new students Query return failed!');
			}			

		}

		
	}


	echo json_encode($output);
}

//for edit modal form
if($_POST['action'] == 'edit'){
	$error = 0;
	$error_ed_fname = '';
	$error_ed_idno = '';
	$error_ed_lname = '';
	$error_ed_gender = '';
	$error_ed_bday = '';
	
	$error_ed_address = '';
	$error_ed_contact = '';

	if(!empty($_POST['editIDNO'])){
		$edit_IDNO = $_POST['editIDNO'];
	}else{
		$error++;
		$error_ed_idno = 'Missing IDNO';
	}

	if(!empty($_POST['editfname'])){
		$ed_fname = $_POST['editfname'];
	}else{
		$error++;
		$error_ed_fname = 'Input field is required!';
	}

	if(!empty($_POST['editlname'])){
		$ed_lname = $_POST['editlname'];
	}else{
		$error++;
		$error_ed_lname = 'Input field is required!';
	}

	if(!empty($_POST['editbday'])){
		$ed_bday = $_POST['editbday'];
	}else{
		$error++;
		$error_ed_bday = 'Input field is required!';
	}

	if(!empty($_POST['editgender'])){
		$ed_gender = $_POST['editgender'];
	}else{
		$error++;
		$error_ed_gender = 'input fields is required!';
	}

	if(!empty($_POST['editaddress'])){
		$ed_address = $_POST['editaddress'];
	}else{
		$error++;
		$error_ed_address = 'Input field is required!';
	}

	if(!empty($_POST['editcontact'])){
		$ed_contact = $_POST['editcontact'];
	}else{
		$error++;
		$error_ed_contact = 'input field is required!';
	}

	if($error > 0){
		#lets output all the error into json array
		$output = array('error'=>true,
			'err_ed_idno'=>$error_ed_idno,
			'err_ed_fname'=>$error_ed_fname,
			'err_ed_lname'=>$error_ed_lname,
			'err_ed_gender'=>$error_ed_gender,
			'err_ed_bday'=>$error_ed_bday,
			'err_ed_address'=>$error_ed_address,
			'err_ed_contact'=>$error_ed_contact

	);
	}else{
		//no empty fields
		#but we will make sure that the hidden IDNO is not empty
		if(!empty($_POST['editID'])){
			//its not empty
			$ed_IDNO = $_POST['editID'];
			#we can proceed to the updating details
			#first we must update the students then after we will also update the details
			$isUpdateStudents = udpateStudent($ed_IDNO,$ed_fname,$ed_lname);
			if($isUpdateStudents == '1'){
				//true updated main details
				#then lets update the student details
				$isUpdateDetails = updateDetails($ed_IDNO,$ed_bday,$ed_gender,$ed_address,$ed_contact);
				if($isUpdateDetails == '1'){
					//query return true : updated successfully!
					#then lets output success message
					$output = array('success'=>'success');
				}else{
					//query return false : student details query failed
					$output = array('err_up_details' => 'updating tbl student details return false');
				}
			}else{
				//query return false or error : updating main student table
				$output = array('err_up_stud'=>'updating student table query return false');
			}
		}else{
			//missing IDNO
			$output = array('err_missing_idno'=>'IDNO is missing!');
		}
	}


	echo json_encode($output);
}



#all the function we will use
function insertStudents($IDNO,$fname,$lname,$pass){
	global $mydb;
	$mydb->setQuery("INSERT INTO students (IDNO,FNAME,LNAME,USERNAME,PASSWORD,AVATAR,REGISTERED,ENROLLED) VALUES('".$IDNO."','".$fname."','".$lname."','null','".$pass."','null','0','0');");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function insertDetails($IDNO,$bday,$gender,$address,$contact){
	global $mydb;
	$mydb->setQuery("INSERT INTO stud_details (IDNO,BDAY,GENDER,ADDRESS,CONTACT) VALUES('".$IDNO."','".$bday."','".$gender."','".$address."','".$contact."');");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function isIDexist($IDNO){
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

function udpateStudent($IDNO,$fname,$lname){
	global $mydb;
	$mydb->setQuery("UPDATE students SET FNAME = '".$fname."',LNAME='".$lname."' WHERE IDNO = '".$IDNO."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function updateDetails($IDNO,$bday,$gender,$address,$contact){
	global $mydb;
	$mydb->setQuery("UPDATE stud_details SET BDAY='".$bday."',GENDER='".$gender."',ADDRESS='".$address."',CONTACT='".$contact."' WHERE IDNO ='".$IDNO."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}




 ?>