<?php


require_once("database.php");


class UserAttend{



//this function will return all student in attendance page in cwts instructor where Academic year Currently
function displayAttendancePageFirstSem($acad_id,$sect_id){

global $mydb;


$mydb->setQuery("select s.IDNO,s.STUD_NAME as 'name',nst.NSTP_PROGRAM,concat(sec.SEC_NAME,' ',sec.YR_SECTION) as 'cys',ac.ACAD_YR from students s,nstp_prog nst,sections sec,acad_year ac,grades grd where s.SECT_ID = sec.SECT_ID and sec.NSTP_ID = nst.NSTP_ID and s.ACAD_ID = ac.ACAD_ID and s.IDNO = grd.IDNO and grd.FIRST_STATUS not in('INC','DROP','good') and s.STATUS not in('DROP','INC') and ac.ACAD_ID = {$acad_id} and s.SECT_ID = {$sect_id}");


$cur = $mydb->executeQuery();

if($cur){
	return $cur;
}else{
	return 0;
}


}
//this function will show students data in attendance in second semester
function displayAttendancePageSecondSem($acad_id,$sect_id){

global $mydb;


$mydb->setQuery("select s.IDNO,s.STUD_NAME as 'name',nst.NSTP_PROGRAM,concat(sec.SEC_NAME,' ',sec.YR_SECTION) as 'cys',ac.ACAD_YR from students s,nstp_prog nst,sections sec,acad_year ac,grades grd where s.SECT_ID = sec.SECT_ID and sec.NSTP_ID = nst.NSTP_ID and s.ACAD_ID = ac.ACAD_ID and s.IDNO = grd.IDNO and grd.STATUS not in('INC','DROP','good') and s.STATUS not in('DROP','INC') and ac.ACAD_ID = {$acad_id} and s.SECT_ID = {$sect_id}");


$cur = $mydb->executeQuery();

if($cur){
	return $cur;
}else{
	return 0;
}


}

function DummyAttendance(){
	global $mydb;
	$mydb->setQuery("select * from students where STATUS = 'I Dont know'");

	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}
}


//this function will display in modal form for first semester
function displayAttendanceModalFirstSem($acad_id,$sect_id){

global $mydb;


$mydb->setQuery("select s.IDNO,s.STUD_NAME from students s,nstp_prog nst,sections sec,acad_year ac,grades grd where s.SECT_ID = sec.SECT_ID and sec.NSTP_ID = nst.NSTP_ID and s.ACAD_ID = ac.ACAD_ID and s.IDNO = grd.IDNO and grd.FIRST_STATUS not in('INC','DROP','good') and s.STATUS not in('DROP','INC') and ac.ACAD_ID = {$acad_id} and s.SECT_ID = {$sect_id}");


$cur = $mydb->executeQuery();

if($cur){
	return $cur;
}else{
	return 0;
}

}

function displayAttendanceModalSecondSem($acad,$sect_id){

global $mydb;


$mydb->setQuery("select s.IDNO,s.STUD_NAME from students s,nstp_prog nst,sections sec,acad_year ac,grades grd where s.SECT_ID = sec.SECT_ID and sec.NSTP_ID = nst.NSTP_ID and s.ACAD_ID = ac.ACAD_ID and s.IDNO = grd.IDNO and grd.STATUS not in('INC','DROP','good') and s.STATUS not in('DROP','INC') and ac.ACAD_ID = {$acad} and s.SECT_ID = {$sect_id}");


$cur = $mydb->executeQuery();

if($cur){
	return $cur;
}else{
	return 0;
}
}


// this function will return data in the add Attendance page
function displayPageSelStudentAddAtt($IDNO){

	global $mydb;

	$mydb->setQuery("select * from students where IDNO = '".$IDNO."';");


	$cur = $mydb->loadSingleResult(); // return the name and IDNO of Student where selected to add attendance

	if($cur){
		return $cur;
	}else{
		return false;
	}

}
function viewSelStudAttendance($IDNO){
	global $mydb;


	$mydb->setQuery("select * from students where IDNO = '".$IDNO."';");

	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur;
	}else{
		return false;
	}
}


function displayAttendance($acad){
	global $mydb;

	$mydb->setQuery("select class_id,TOPIC,SESS_DATE from class_sched where ACAD_ID = {$acad}");
	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return false;
	}
}

//this function will return list of class where instructor incharge
function showClassDropdown($inst_id){
global $mydb;

	$mydb->setQuery("select sec.SECT_ID,sec.SEC_NAME,sec.YR_SECTION from instructor inst,sections sec where inst.INST_ID = sec.INST_ID and inst.INST_ID = {$inst_id}");

	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}


}

function ViewEditSched($sched_id){
	global $mydb;

	$mydb->setQuery("select cl.CLASS_ID, sec.SECT_ID,cl.SEM, sec.SEC_NAME,sec.YR_SECTION,cl.TOPIC,cl.SESS_DATE from class_sched cl,sections sec where cl.SECT_ID = sec.SECT_ID and cl.CLASS_ID = {$sched_id}");

	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

//this function will return array to display the records of selected student
function showMyAttendanceRecord($IDNO,$sem){

	global $mydb;

	$mydb->setQuery("select att.ATT_ID,cl.TOPIC,cl.SESS_DATE,att.`STATUS` from attendance att,class_sched cl where att.CLASS_ID = cl.CLASS_ID and att.IDNO = '".$IDNO."' and cl.SEM={$sem}");

	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}


}
//this function will display the attendance of the student
function selStudentAttendance($IDNO,$acad_id,$sem){
	
	global $mydb;

	$mydb->setQuery("select att.IDNO,cl.TOPIC,cl.SESS_DATE,att.`STATUS` from attendance att,class_sched cl where att.CLASS_ID = cl.CLASS_ID and att.IDNO='".$IDNO."' and att.ACAD_ID ={$acad_id} and cl.SEM={$sem} ");

	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}
//first Semester Count all Class Sched
function countAllClassSchedFirstSem($sect_id,$acad_id){
	global $mydb;

	$mydb->setQuery("select count(*) as 'totalClass' from class_sched where SECT_ID ={$sect_id} and ACAD_ID ={$acad_id} and  SEM = 1");
	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur->totalClass;
	}else{
		return 0;
	}

}
//Second Semester Count all Class Sched
function countAllClassSchedSecondSem($sect_id,$acad_id){
	global $mydb;

	$mydb->setQuery("select count(*) as 'totalClass' from class_sched where SECT_ID ={$sect_id} and ACAD_ID ={$acad_id} and  SEM = 2");
	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur->totalClass;
	}else{
		return 0;
	}
}



//this function return Student attendance Present
function countAllPresentFirstSem($IDNO){
	global $mydb;

	$mydb->setQuery("select count(*) as 'present' from attendance att,class_sched cl where att.CLASS_ID = cl.CLASS_ID and  att.STATUS ='Present' and cl.SEM =1 and att.IDNO = '".$IDNO."';");

	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur->present;
	}else{
		return 0;
	}
}
//this function will return Student Attendance Absent
function countAllAbsentFirstSem($IDNO){
	global $mydb;

	$mydb->setQuery("select count(*) as 'absent' from attendance att,class_sched cl where att.CLASS_ID = cl.CLASS_ID and  att.STATUS ='Absent' and cl.SEM =1 and att.IDNO = '".$IDNO."';");

	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur->absent;
	}else{
		return 0;
	}
}

//second Sem Present Counter
function countAllPresentSecondSem($IDNO){
	global $mydb;

	$mydb->setQuery("select count(*) as 'present' from attendance att,class_sched cl where att.CLASS_ID = cl.CLASS_ID and  att.STATUS ='Present' and cl.SEM =2 and att.IDNO = '".$IDNO."';");

	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur->present;
	}else{
		return 0;
	}
}

//second semester Absent Counter
function countAllAbsentSecondSem($IDNO){
	global $mydb;

	$mydb->setQuery("select count(*) as 'absent' from attendance att,class_sched cl where att.CLASS_ID = cl.CLASS_ID and  att.STATUS ='Absent' and cl.SEM =2 and att.IDNO = '".$IDNO."';");

	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur->absent;
	}else{
		return 0;
	}
}


}




 ?>