<?php 

require_once("database.php");


// all of this function only in the admin side ######################################################################
class myTable{

// this function will display the data or current data only Year it requires in academic year
function disPlayDate(){

	$year = date("Y");

	return $year;
}
//this function will display the data and it add + 1 for the academic year purpose
function disPlayDate1(){
	$year1  = date("Y");

	$year2 = $year1 + 1;

	return $year2;
}

//this function will display the index admin side table all the data in the table
function displayIndexTable(){
	global $mydb;

		$mydb->setQuery("select s.STUD_ID,s.IDNO,s.STUD_NAME as 'name',nst.NSTP_PROGRAM,concat(sec.SEC_NAME,' ',sec.YR_SECTION) as 'cys',ac.ACAD_YR,st.ADDRESS,st.CONTACT from students s,nstp_prog nst,sections sec,acad_year ac,stud_details st where s.SECT_ID = sec.SECT_ID and s.IDNO = st.IDNO and sec.NSTP_ID = nst.NSTP_ID and s.ACAD_ID = ac.ACAD_ID order by nst.NSTP_PROGRAM asc;");

		$res = $mydb->executeQuery();

		if(!$res){
			return false;
		}else{
			return $res;
		}
}// this part is for all admin side code function ###########################################################
function displayCwtsAdmin(){
	global $mydb;

		$mydb->setQuery("select s.STUD_ID,s.IDNO,s.STUD_NAME as 'name',nst.NSTP_PROGRAM,concat(sec.SEC_NAME,' ',sec.YR_SECTION) as 'cys',ac.ACAD_YR from students s,nstp_prog nst,sections sec,acad_year ac where s.SECT_ID = sec.SECT_ID and sec.NSTP_ID = nst.NSTP_ID and s.ACAD_ID = ac.ACAD_ID and nst.NSTP_PROGRAM ='CWTS'");

		$cur = $mydb->executeQuery();

		if(!$cur){
			return false;
		}else{
			return $cur;
		}
}

// this part is for the admin side #########################################################################
function displayLtsAdmin(){
	global $mydb;


		$mydb->setQuery("select s.STUD_ID,s.IDNO,s.STUD_NAME as 'name',nst.NSTP_PROGRAM,concat(sec.SEC_NAME,' ',sec.YR_SECTION) as 'cys',ac.ACAD_YR from students s,nstp_prog nst,sections sec,acad_year ac where s.SECT_ID = sec.SECT_ID and sec.NSTP_ID = nst.NSTP_ID and s.ACAD_ID = ac.ACAD_ID and nst.NSTP_PROGRAM ='LTS'");

		$cur = $mydb->executeQuery();

		if(!$cur){
			return false;
		}else{
			return $cur;
		}
}
// this part is for the admin side #########################################################################
function displayRotcAdmin(){
	global $mydb;


		$mydb->setQuery("select s.STUD_ID,s.IDNO,s.STUD_NAME as 'name',nst.NSTP_PROGRAM,concat(sec.SEC_NAME,' ',sec.YR_SECTION) as 'cys',ac.ACAD_YR from students s,nstp_prog nst,sections sec,acad_year ac where s.SECT_ID = sec.SECT_ID and sec.NSTP_ID = nst.NSTP_ID and s.ACAD_ID = ac.ACAD_ID and nst.NSTP_PROGRAM ='ROTC'");

		$cur = $mydb->executeQuery();

		if(!$cur){
			return false;
		}else{
			return $cur;
		}
}

//this function will display data if the dropdown selected according to the data
function filterDisplay($acad=""){
	global $mydb;

	$mydb->setQuery("select s.ID,concat(s.FNAME,' ',s.LNAME) as 'Full Name',nst.NSTP_PROGRAM,st.COURSE,st.ACADEMIC_YR from students s,stud_details st,nstp_prog nst where nst.NSTP_ID = s.NSTP_ID and st.IDNO = s.IDNO and st.ACADEMIC_YR = '".$acad."';");

	$res = $mydb->executeQuery();

	return $res;

}
//this function will display the information of the selected student in the admin index side
function viewSelectedStudent($ID){

	global $mydb;

	$mydb->setQuery("select s.ID,s.FNAME,s.LNAME,s.MID_NAME,st.ADDRESS,st.GENDER,st.CONTACT,nst.NSTP_PROGRAM,grd.MID_TERM1,grd.FINAL1,grd.MID_TERM2,grd.FINAL2,grd.AVG from students s,stud_details st,grades grd,nstp_prog nst where s.IDNO=st.IDNO and s.IDNO=grd.IDNO and s.NSTP_ID = nst.NSTP_ID and s.ID = {$ID}");

	$cur = $mydb->loadSingleResult();

	if(!$cur){
		return false;
	}else{
		return $cur;
	}

}

function showCourse(){
	global $mydb;

	$mydb->setQuery("select s.SECT_ID,nst.NSTP_PROGRAM,s.SEC_NAME,s.YR_SECTION from sections s,nstp_prog nst where s.NSTP_ID = nst.NSTP_ID order by nst.NSTP_PROGRAM asc;");

	$cur = $mydb->executeQuery();


	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

function showCourseRo(){
	global $mydb;

	$mydb->setQuery("select s.SECT_ID,nst.NSTP_PROGRAM,s.SEC_NAME,s.YR_SECTION from sections s,nstp_prog nst where s.NSTP_ID = nst.NSTP_ID and nst.NSTP_ID not in(1,2);");

	$cur = $mydb->executeQuery();


	if($cur){
		return $cur;
	}else{
		return 0;
	}
}





// all of this function only in the admin side ######################################################################

}

?>