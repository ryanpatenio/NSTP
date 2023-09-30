<?php 

require_once("database.php");


// all of this function only in the admin side ######################################################################
class students{
protected static $tbl_student = "students";
protected static $std_details = "stud_details";
protected static $tbl_nstpProg = "nstp_prog";
protected static $tbl_courses = "courses";
protected static $tbl_grades = "grades";
function db_fields(){
		global $mydb;
		return $mydb->getFieldsOnOneTable(self::$tbl_name);
	}


	//this part is for viewing selected students to show in the edit form or page
	function single_student($id=0){
			global $mydb;
			$mydb->setQuery("select st.stud_id,st.acad_id, st.fname,st.lname,st.middle_name,st.course,st.address,st.contact_number,st.nstp_course,st.age,st.email_add, ac.acad_year,st.acad_id FROM tblstudents st,acadyr ac where st.acad_id = ac.acad_id and st.stud_id= {$id}");
			$cur = $mydb->loadSingleResult();//and this will return object
			return $cur;
	}
	//this function will show the selected student to view his/her details
	





	//hard to understand
	
function update($id=0,$fname="",$lname="",$middle_name="",$address="",$age="",$contact_number="",$email_add="",$course="",$acad_id=""){

global $mydb;
$mydb->setQuery("UPDATE ".self::$tbl_name." SET fname='".$fname."',lname ='".$lname."',middle_name='".$middle_name."',address='".$address."',age='".$age."',contact_number='".$contact_number."',email_add='".$email_add."',course='".$course."',acad_id='".$acad_id."' WHERE stud_id ='".$id."';");

$cur = $mydb->updateSingleStudent();
return $cur;

}


// ###############################################################################################################################################




// all of this function only in the admin side ######################################################################

}


class studentUser{


protected static $tblstudents1 = 'students';

	function searchStudent($IDNO){

		global $mydb;


	$mydb->setQuery("SELECT * FROM ".self::$tblstudents1." WHERE IDNO = '".$IDNO."';");

	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur;
	}else{
		return false;
	}

	}


	function UpdateStudentUser($IDNO,$user,$pass){
		global $mydb;

		$mydb->setQuery("UPDATE ".self::$tblstudents1." SET USERNAME = '".$user."',PASSWORD = '".$pass."' WHERE IDNO = '".$IDNO."';");

		$cur = $mydb->executeQuery();

		

		if($cur){
			return 1;
		}else{
			return 0;
		}
	}



	function AuthenticateStudent($email,$upass){
		global $mydb;

		$mydb->setQuery("select * from students where USERNAME='".$email."' and PASSWORD=('".$upass."')");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);

		if($row_count > 0 ){
		
      	$founduser = $mydb->loadSingleResult();
      	$_SESSION['student_id']    = $founduser->IDNO;
        $_SESSION['student_name']    = $founduser->FNAME.' '.$founduser->LNAME;
		$_SESSION['statusReg'] = $founduser->REGISTERED; 
    
		return 1;	
		}else{
			return 0;
		}
				
	} 

//this function will check if there is existing Student in the database using IDNO
	function checkStudExist($IDNO,$pass){
		global $mydb;

		$mydb->setQuery("SELECT * FROM  students WHERE IDNO ='".$IDNO."' and PASSWORD = '".$pass."';");

		$cur = $mydb->executeQuery();

		$numrow = $mydb->num_rows($cur);

		if($numrow >0 ){
			//true
			return 1;
		}else{
			return 0;
		}
	}
//this function will Update the Username and Password
	function InsertUserPassStudent($IDNO,$USERNAME,$PASSWORD){
		global $mydb;

		$mydb->setQuery("UPDATE students SET USERNAME ='".$USERNAME."',PASSWORD = '".$PASSWORD."' WHERE IDNO = '".$IDNO."';");
		$cur = $mydb->executeQuery();

		if($cur){
			return 1;
		}else{
			return 0;
		}
	}


//check if he already Registered
function checkifReg($IDNO){
	global $mydb;
	$mydb->setQuery("SELECT * FROM students WHERE IDNO = '".$IDNO."';");

	$cur = $mydb->executeQuery();

	$numrow = $mydb->num_rows($cur);

	if($numrow > 0){

		$found = $mydb->loadSingleResult();
		$reg = $found->REGISTERED;

			if($reg=='1'){

				return 1;
			}else{
				return 0;
				}	
	}else{
		return false;
	}
}
//this function will check if there already Existed email in the Database
function checkStudentEmailExist($email){
	global $mydb;

	$mydb->setQuery("SELECT * FROM students WHERE USERNAME = '".$email."'");
	$cur = $mydb->executeQuery();

	$numrow = $mydb->num_rows($cur);

	if($numrow >0){
		//true
		return 1;

	}else{
		//false
		return 0;
	}
	
	


}

function displayStudentGrades($IDNO){
	global $mydb;

	$mydb->setQuery("select MID_TERM,END_TERM,FINAL,MID_TERM2,END_TERM2,FINAL2 from grades gr where IDNO = '".$IDNO."';");

	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

function studentAccEdit($id,$username,$pass){
	global $mydb;
	$mydb->setQuery("UPDATE students SET USERNAME='".$username."',PASSWORD=md5('".$pass."') WHERE IDNO ='".$id."'LIMIT 1;");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}
function getStudentData($IDNO){
	global $mydb;
	$mydb->setQuery("SELECT USERNAME,avatar FROM students WHERE IDNO='".$IDNO."';");
	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

function displayStudent($IDNO){
	global $mydb;
	$mydb->setQuery("Select * from students where IDNO ='".$IDNO."';");
	$cur = $mydb->executeQuery();
	$numrow  = $mydb->num_rows($cur);

	if($numrow > 0){
		$foundStudent = $mydb->loadSingleResult();
		return $foundStudent;
	}else{
		return 0;
	}

}


	
}





?>