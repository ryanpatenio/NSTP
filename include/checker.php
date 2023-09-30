<?php 

require_once("database.php");



class check{
protected static $tbl_student = 'students';


function getSY(){
	global $mydb;
	$mydb->setQuery("select * from acad_year where STATUS = 'YES'");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$foundData = $mydb->loadSingleResult();
		$data = $foundData->ACAD_ID;
		return $data;
	}else{
		return 0;
	}

}


}


?>