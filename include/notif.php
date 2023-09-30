<?php

require_once("database.php");

class notificationz{

protected static  $tbl_Tnotif = 'teacher_notif';

function createNotifInInst($IDNO,$sect_id,$ass_id,$pass_id,$acad,$message){
	global $mydb;

	$mydb->setQuery("INSERT INTO teacher_notif (IDNO,SECT_ID,ASSIGN_ID,PASS_ID,ACAD_ID,MESSAGE,READM) VALUES('".$IDNO."','".$sect_ID."','".$ass_id."','".$pass_id."','".$acad."','".$message."','0');");

	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}


function displayNotifInst($inst_id,$sem,$acad){
	global $mydb;

	$mydb->setQuery("select nt.T_NOTIF_ID, s.STUD_NAME as 'name',nt.MESSAGE,nt.UPLOADED_DATE,nt.READM from students s,teacher_notif nt,sections sec where s.IDNO = nt.IDNO and s.SECT_ID = sec.SECT_ID and nt.SEM = {$sem} and nt.ACAD_ID = {$acad} and sec.INST_ID = {$inst_id} order by nt.UPLOADED_DATE desc");
	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

function displayNotifSidebar($inst_id,$sem,$acad){
	global $mydb;

	$mydb->setQuery("select count(nt.T_NOTIF_ID) as 'noTifCount' from students s,teacher_notif nt,sections sec where s.IDNO = nt.IDNO and s.SECT_ID = sec.SECT_ID and nt.SEM = {$sem} and nt.ACAD_ID = {$acad} and sec.INST_ID = {$inst_id} and nt.READM = 0");
	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur->noTifCount;
	}else{
		return 0;
	}
}

function StudentAnnouncement($IDNO,$acad,$sem){
	global $mydb;

	$mydb->setQuery("select count(*) as countNotif from announcement ann,student_notif snotif,acad_year ac where ann.ANN_ID = snotif.ANN_ID and ann.ACAD_ID = ac.ACAD_ID and snotif.IDNO = '".$IDNO."' and ac.ACAD_ID = '".$acad."' and ac.SEM = '".$sem."';");

	$cur = $mydb->loadSingleResult();
	//$numrows = $mydb->num_rows($cur);


	if($cur){
		return $cur;
	}else{
		return 0;
	}
}


}





 ?>