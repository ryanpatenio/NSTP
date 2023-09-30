<?php

session_start();
//load database configuration
require_once("../include/initialize.php");

if(!isset($_GET['class_id'])){
	redirect(WEB_ROOT.'login.php');
}else{


$get_class = $_GET['class_id'];

$getSem = getSY();

if($getSem !='0'){
	//getting semester return results

	$cur = getData($get_class);
	$Class_name = getClassName($get_class);
	$instructor_name = getInstructorName($get_class);

	if($cur !='0'){
		//have data
				$delimeter =',';
				$filename = 'Gradesheet '.$Class_name.' '.$getSem->SEMESTER.'-SEMESTER of '.$getSem->SCHOOL_YEAR.'.csv';

				//create a file pointer
				$f = fopen('php://memory', 'w');

				//first title
				$title = array('','','NSTP MANAGEMENT SYSTEM');
				fputcsv($f,$title,$delimeter);
				
				//put a title
				$title = array('','',$instructor_name->name);
				fputcsv($f,$title,$delimeter);

				$title2 = array('','',$Class_name);
				fputcsv($f,$title2,$delimeter);

				$title6 = array('','',$getSem->SCHOOL_YEAR);
				fputcsv($f,$title6,$delimeter);

				$title3 = array('',' ',$getSem->SEMESTER.' SEMESTER');
				fputcsv($f,$title3,$delimeter);

				$title4 = array('','');
				fputcsv($f, $title4,$delimeter);

				//set column headers
				$fields = array('#','ID NUMBER','NAME OF STUDENTS','MidTerm','EndTerm','Final Grade','ACTION TAKEN');
				fputcsv($f,$fields,$delimeter);

				//add another space
				$title5 = array('','');
				fputcsv($f, $title5,$delimeter);

				//output each row of the data, format line as csv and write to file pointer
					$i=1;
				 foreach ($cur as $row) {

                 	$lineData = array($i,$row['IDNO'],$row['name'],$row['MID_TERM'],$row['END_TERM'],$row['FINAL'],$row['REMARKS']);
					fputcsv($f,$lineData,$delimeter);
				



               $i++; }
					
				//move back to the beginning of the file
				fseek($f,0);

				//set headers to download file rather than display it
				header('Content-Type: text/csv');
				header('Content-Disposition: attachment; filename="'.$filename.'";');
				// redirect("Inst-report/");

				//output all remaining data on a file pointer
				fpassthru($f);

	}	




}//end of checking the semester




}//end of checking if the class id is set








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


#set function
function getData($class_id){
  global $mydb;
  $mydb->setQuery("select s.IDNO,concat(s.FNAME,' ',s.LNAME) name,gr.MID_TERM,gr.END_TERM,gr.FINAL,gr.REMARKS from enrollees en,students s,grades gr,class cl,acad_year ac where en.IDNO = s.IDNO and en.ENROLL_ID = gr.ENROLL_ID and en.CLASS_ID = cl.CLASS_ID and en.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and cl.CLASS_ID = '".$class_id."';");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;

  }
}

function getClassName($class){
global $mydb;
$mydb->setQuery("select * from class where CLASS_ID = '".$class."';");
$cur = $mydb->executeQuery();
$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$found = $mydb->loadSingleResult();
		return $found->CLASS_NAME;
	}else{
		return 0;
	}


}

function getInstructorName($class){
	global $mydb;
	$mydb->setQuery("select concat(inst.FNAME,' ',inst.LNAME) name from class cl,instructor inst where cl.INST_ID = inst.INST_ID and cl.CLASS_ID = '".$class."';");
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