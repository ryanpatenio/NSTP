<?php 

require_once("database.php");



class CwtsInc{

protected static $tbl_inc = 'inc_students';

//this function will display first semester grades in the INC page
function displayStudToAddIncPageFirstSem($IDNO){


	global $mydb;


	$mydb->setQuery("select s.IDNO,s.STUD_NAME,grd.MID_TERM as'MID',grd.END_TERM as 'END',grd.FINAL as 'FINAL',grd.FIRST_STATUS from students s,grades grd where s.IDNO = grd.IDNO and s.IDNO = '".$IDNO."';");

	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur;
	}else{
		return false;
	}
}
//this function will display second semester grades in the INC page
function displayStudToAddIncPageSecondSem($IDNO){


	global $mydb;


	$mydb->setQuery("select s.IDNO,s.STUD_NAME,grd.MID_TERM2 as 'MID2',grd.END_TERM2 as 'END2',grd.FINAL2 as 'FINAL2',grd.`STATUS` from students s,grades grd where s.IDNO = grd.IDNO and s.IDNO = '".$IDNO."';");

	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur;
	}else{
		return false;
	}
}

function addIncStudent($inst_id,$IDNO,$acad_id,$reason,$sem){
	global $mydb;

	$mydb->setQuery("INSERT INTO ".self::$tbl_inc." (INST_ID,IDNO,ACAD_ID,SEM,REASON,STATUS) VALUES ('".$inst_id."','".$IDNO."','".$acad_id."','".$sem."','".$reason."','INC')");

	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function showIncStudents($acad_id,$inst_id,$sem){

	global $mydb;

	$mydb->setQuery("select s.IDNO,inc.INC_ID,s.STUD_NAME as 'name',nst.NSTP_PROGRAM,concat(sec.SEC_NAME,' ',sec.YR_SECTION) as 'cys', ac.ACAD_YR from inc_students inc,students s,nstp_prog nst,sections sec,acad_year ac where inc.IDNO = s.IDNO and s.SECT_ID = sec.SECT_ID and sec.NSTP_ID = nst.NSTP_ID and inc.ACAD_ID = ac.ACAD_ID and s.`STATUS`='INC' and ac.ACAD_ID = {$acad_id} and inc.INST_ID = {$inst_id} and inc.SEM = {$sem}");

	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}


}

//this function is for inc student fetch in the instructor side
function showIncStudentsRo($acad_id,$inst_id,$sem){

	global $mydb;

	$mydb->setQuery("select s.IDNO,inc.INC_ID,concat(s.FNAME,' ',s.LNAME) as 'name',nst.NSTP_PROGRAM,concat(sec.SEC_NAME,' ',sec.YR_SECTION) as 'cys', ac.ACAD_YR from inc_students inc,students s,nstp_prog nst,sections sec,acad_year ac where inc.IDNO = s.IDNO and s.SECT_ID = sec.SECT_ID and sec.NSTP_ID = nst.NSTP_ID and inc.ACAD_ID = ac.ACAD_ID and s.`STATUS`='INC' and ac.ACAD_ID = {$acad_id} and inc.INST_ID = {$inst_id} and inc.SEM = '".$sem."' and nst.NSTP_PROGRAM='ROTC'");

	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}


}

//display Inc students in the admin side INC
function showSelIncStudent($IDNO){
	global $mydb;

	$mydb->setQuery("select s.IDNO,inc.INC_ID,s.STUD_NAME as 'name',gr.MID_TERM,gr.END_TERM,gr.FINAL,gr.MID_TERM2,gr.END_TERM2,gr.FINAL2,inc.REASON from students s,grades gr,inc_students inc where s.IDNO = gr.IDNO and s.IDNO = inc.IDNO and inc.IDNO ='".$IDNO."' and inc.STATUS='INC'");

	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

// function viewSelStudent($IDNO){
// 	global $mydb;

// 	$mydb->setQuery("select s.IDNO,concat(s.FNAME,' ',s.LNAME) as 'name',gr.MID_TERM,gr.FINAL,gr.END_TERM,gr.MID_TERM2,gr.FINAL2,gr.AVG,inc.REASON from students s,grades gr,inc_students inc where s.IDNO = gr.IDNO and s.IDNO = inc.IDNO and inc.IDNO ={$IDNO}");

// 	$cur = $mydb->loadSingleResult();

// 	if($cur){
// 		return $cur;
// 	}else{
// 		return 0;
// 	}
// }

//this function will return fetch data from the inc students table
function viewSelStudentInc($IDNO){
	global $mydb;

	$mydb->setQuery("select inc.INC_ID,s.STUD_NAME as 'name',inc.REASON from students s,inc_students inc where s.IDNO = inc.IDNO and inc.IDNO = '".$IDNO."' and inc.`STATUS` not in('DONE')");
	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

function displaIncTable(){
	global $mydb;

	$mydb->setQuery("select s.IDNO,s.STUD_NAME as 'name',nst.NSTP_PROGRAM,concat(sec.SEC_NAME,' ',sec.YR_SECTION) as 'cys',ac.ACAD_YR from students s, inc_students inc,sections sec,nstp_prog nst,acad_year ac where s.IDNO = inc.IDNO and s.SECT_ID = sec.SECT_ID and sec.NSTP_ID = nst.NSTP_ID and s.ACAD_ID = ac.ACAD_ID and inc.`STATUS` ='INC'  order by ac.ACAD_ID  desc;");
	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

function displayGradesStatus($IDNO){

  global $mydb;

  $mydb->setQuery("SELECT * FROM grades WHERE IDNO ='".$IDNO."';");
  $cur = $mydb->loadSingleResult();

  if($cur){
  	return $cur;
  }else{
  	return 0;
  }
}

//this function will return fetch data from the multiple table students module and assign module
function DisplayRemainingModules($IDNO,$acad,$sem){
	global $mydb;
	$mydb->setQuery("select ass.ASSIGN_ID,mo.FILE_TITLE,mo.FILE_IN,ass.STATUS from assign_module ass,module mo where ass.MOD_ID = mo.MOD_ID and ass.IDNO = '".$IDNO."' and mo.FILE_TYPE='1' and ass.`STATUS` = 0 and ass.ACAD_ID = {$acad} and mo.SEM={$sem}");

	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}

}


}

?>