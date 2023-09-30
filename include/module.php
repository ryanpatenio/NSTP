<?php 

require_once("database.php");


class MyFiles{
protected static $tbl_passModule ='pass_module';
protected static $tbl_assignModule = 'assign_module';

function showModinTable($inst_id,$acad_id,$sem){

	global $mydb;

	$mydb->setQuery("select * from module where INST_ID = {$inst_id} and ACAD_ID = {$acad_id} and SEM ={$sem}");

	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}


}

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

function showModTitleName($mod_id){
	global $mydb;

	$mydb->setQuery("select * from module where MOD_ID = {$mod_id} LIMIT 1");

	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

//this function will display the module in the student according to his section
function displayModSelStudent($IDNO,$acad,$sem){
	global $mydb;

	$mydb->setQuery("select ass.MOD_ID,ass.ASSIGN_ID,ass.STATUS,mo.FILE_TITLE,concat(inst.FNAME,' ',inst.LNAME) as 'instructor',mo.DUE,mo.FILE_LOC,mo.FILE_TYPE from assign_module ass,module mo,instructor inst,sections sec where ass.MOD_ID = mo.MOD_ID and ass.INST_ID = inst.INST_ID and ass.SECT_ID = sec.SECT_ID and ass.IDNO = '".$IDNO."' and mo.ACAD_ID = {$acad} and mo.SEM={$sem}");

	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}

}

function viewMyModule($IDNO,$acad,$sem,$mod_id){
	global $mydb;
	$mydb->setQuery("select mo.MOD_ID,ass.ASSIGN_ID,mo.FILE_TITLE,concat(inst.FNAME,' ',inst.LNAME) as 'instructor',mo.FILE_IN,mo.DUE,mo.FILE_DESC,mo.FILE_LOC from module mo,assign_module ass,instructor inst,sections sec where mo.MOD_ID = ass.MOD_ID and ass.INST_ID = inst.INST_ID and ass.SECT_ID = sec.SECT_ID and ass.IDNO = '".$IDNO."' and mo.ACAD_ID = {$acad} and mo.SEM = {$sem} and mo.MOD_ID = {$mod_id};");
	$cur = $mydb->loadSingleResult();
	if($cur){
		return $cur;
	}else{
		return 0;
	}

}


//this function will display Assigned Module of the student if he/she want to passed it and the fetch data will display in the dropdown
function displayModUploadWorkDropDown($IDNO,$acad,$sem){
	global $mydb;

	$mydb->setQuery("select ass.ASSIGN_ID,mo.FILE_TITLE from assign_module ass,module mo where ass.MOD_ID = mo.MOD_ID and ass.IDNO = '".$IDNO."' and ass.ACAD_ID = {$acad} and mo.FILE_TYPE not in(0) and mo.SEM={$sem} and ass.STATUS=0");
	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;

	}else{
		return 0;
	}
}

// this function will display notification count in the module Sideabar in the red Dot!
function displayNotifCount($IDNO,$acad_id,$sem){
	global $mydb;

	$mydb->setQuery("select count(ass.ASSIGN_ID) 'counter' from module mo,assign_module ass where mo.MOD_ID = ass.MOD_ID and ass.IDNO ='".$IDNO."' and ass.ACAD_ID ={$acad_id} and mo.SEM = {$sem}");
	$cur = $mydb->loadSingleResult();

	if($cur){

		return $cur;

	}else{
		return 0;
	}
}
//this function will return fetch data from the database and display in the table of the students Where Records of Module That he/she was Uploaded
function displayStudentPassedModuleTable($IDNO,$ACAD,$sem){
	global $mydb;

	$mydb->setQuery("select pass.PASS_ID,ass.ASSIGN_ID,mo.FILE_TITLE,pass.UPLOAD_DATE from pass_module pass,assign_module ass,module mo where pass.ASSIGN_ID = ass.ASSIGN_ID and ass.MOD_ID = mo.MOD_ID and pass.IDNO = '".$IDNO."' and pass.ACAD_ID = {$ACAD} and mo.SEM = {$sem}");

	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}
// this function will return fetch data from the database of Student Remaining Module Need To pass
function showStudentRemainingModuleToPass($IDNO,$acad,$sem){
	global $mydb;

	$mydb->setQuery("select ass.ASSIGN_ID,mo.FILE_TITLE,mo.FILE_IN,ass.STATUS from assign_module ass,module mo where ass.MOD_ID = mo.MOD_ID and ass.IDNO = '".$IDNO."' and mo.FILE_TYPE not in(0) and ass.`STATUS` = 0 and ass.ACAD_ID = {$acad} and mo.SEM={$sem}");

	$cur = $mydb->executeQuery();
	if($cur){
		return $cur;
	}else{
		return 0;
	}
}
//this function is for Passing Module Of the Student
function StudentAddModule($assign_id,$IDNO,$acad,$sect_id,$file_loc){
	global $mydb;

	$mydb->setQuery("INSERT INTO ".self::$tbl_passModule." (ASSIGN_ID,IDNO,ACAD_ID,SECT_ID,FILE_LOC,UPLOAD_DATE) VALUES('".$assign_id."','".$IDNO."','".$acad."','".$sect_id."','".$file_loc."',now());");

	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}
//this function will update the status of assign module of the student after he/she passed the Module
function updateStatusAssignModuleSelStudent($assign_id){
	global $mydb;

	$mydb->setQuery("UPDATE ".self::$tbl_assignModule." SET STATUS = '1' WHERE ASSIGN_ID = {$assign_id}");

	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}
//this function will return Module Information according to the assign Module ID
function assignModInfo($mod_id){
	global $mydb;

	$mydb->setQuery("select ass.ASSIGN_ID, mo.MOD_ID,mo.FILE_TITLE,mo.FILE_DESC,mo.DUE,mo.FILE_TYPE from module mo,assign_module ass where mo.MOD_ID = ass.MOD_ID and mo.MOD_ID = {$mod_id}");

	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

function countAllassignModuleFirstSem($IDNO){

	global $mydb;

	$mydb->setQuery("select count(*) as 'total'  from assign_module ass,module mo where ass.MOD_ID = mo.MOD_ID and mo.FILE_TYPE not in(0) and mo.SEM = 1 and ass.IDNO = '".$IDNO."';");
	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur->total;
	}else{
		return 0;
	}
}

function countAllPassModuleFirstSem($IDNO){
	global $mydb;

	$mydb->setQuery("select count(*) as 'pass' from assign_module ass,module mo where ass.MOD_ID = mo.MOD_ID and  ass.STATUS = 1 and mo.SEM = 1 and ass.IDNO ='".$IDNO."';");
	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur->pass;
	}else{
		return 0;
	}

}
//SEcond SEm #####################################
function countAllassignModuleSecondSem($IDNO){
	global $mydb;

	$mydb->setQuery("select count(*) as 'total'  from assign_module ass,module mo where ass.MOD_ID = mo.MOD_ID and mo.FILE_TYPE not in(0) and mo.SEM = 2 and ass.IDNO = '".$IDNO."';");
	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur->total;
	}else{
		return 0;
	}
}

function countAllPassModuleSecondSem($IDNO){
	global $mydb;

	$mydb->setQuery("select count(*) as 'pass' from assign_module ass,module mo where ass.MOD_ID = mo.MOD_ID and  ass.STATUS = 1 and mo.SEM = 2 and ass.IDNO ='".$IDNO."';");
	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur->pass;
	}else{
		return 0;
	}
}

//this function will display students in the submitted module sidebar
function displaySubModFirstSem($acad_id,$sect_id){
	global $mydb;

	$mydb->setQuery("select s.IDNO,s.STUD_NAME as 'name',nst.NSTP_PROGRAM,concat(sec.SEC_NAME,' ',sec.YR_SECTION) as 'cys',ac.ACAD_YR from students s,nstp_prog nst,sections sec,acad_year ac,grades grd where s.SECT_ID = sec.SECT_ID and sec.NSTP_ID = nst.NSTP_ID and s.ACAD_ID = ac.ACAD_ID and s.IDNO = grd.IDNO and grd.FIRST_STATUS not in('INC','DROP','good') and s.STATUS not in('DROP','INC') and ac.ACAD_ID = {$acad_id} and s.SECT_ID = {$sect_id}");

	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}
function displaySubModSecondSem($acad_id,$sect_id){
	global $mydb;

	$mydb->setQuery("select s.IDNO,s.STUD_NAME as 'name',nst.NSTP_PROGRAM,concat(sec.SEC_NAME,' ',sec.YR_SECTION) as 'cys',ac.ACAD_YR from students s,nstp_prog nst,sections sec,acad_year ac,grades grd where s.SECT_ID = sec.SECT_ID and sec.NSTP_ID = nst.NSTP_ID and s.ACAD_ID = ac.ACAD_ID and s.IDNO = grd.IDNO and grd.STATUS not in('INC','DROP','good') and s.STATUS not in('DROP','INC') and ac.ACAD_ID = {$acad_id} and s.SECT_ID = {$sect_id}");

	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

//this function will return fetch data from the 4 tables in the database the students module assign module pass module
function DisplaySubmittedModule($IDNO,$acad,$sem){
	global $mydb;

	$mydb->setQuery("select s.IDNO,ass.ASSIGN_ID,mo.FILE_TITLE,pass.UPLOAD_DATE,pass.FILE_LOC,mo.DUE from students s,assign_module ass,module mo,pass_module pass,acad_year ac where s.IDNO = ass.IDNO and mo.MOD_ID = ass.MOD_ID and ass.ASSIGN_ID = pass.ASSIGN_ID and s.ACAD_ID = ac.ACAD_ID and pass.IDNO = '".$IDNO."' and ac.ACAD_ID = {$acad} and mo.SEM = {$sem}");
	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}
//display student full name
function selStudent($IDNO){
	global $mydb;

	$mydb->setQuery("SELECT STUD_NAME as 'name' FROM students WHERE IDNO ='".$IDNO."'");
	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur->name;
	}else{
		return 0;
	}
}

function countRemainMod($IDNO,$sem){
	global $mydb;
	$mydb->setQuery("select count(ass.ASSIGN_ID) as 'counter' from module mo,assign_module ass where mo.MOD_ID = ass.MOD_ID and mo.SEM = {$sem} and ass.IDNO = '".$IDNO."' and ass.`STATUS`=0 and mo.FILE_TYPE not in(0);");

	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

}

?>