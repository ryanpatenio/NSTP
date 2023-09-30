<?php
session_start();
global $mydb;
require_once("../../include/initialize.php");

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'export' :
	exporting();
	break;
	
	case 'update' :
	doUpdate();
	break;
	
	case 'delete' :
	doDelete();
	break;

	case 'photos' :
	doupdateimage();
	break;

 
	}


function exporting(){

  if(isset($_POST['csvExport'])){

      if(!empty($_POST['ay'])){

        if(!empty($_POST['sem'])){

            if(!empty($_POST['class'])){

        #set all important variables
        $acad_id = $_POST['ay'];
        $sem = $_POST['sem'];
        $class_id = $_POST['class'];

        $data = getData($acad_id,$sem,$class_id);

        if($data !='0'){


          $Class_name = getClassName($class_id);
         

        $delimeter =',';
        $filename = 'Gradesheet '.$Class_name.' '.$sem.'-SEMESTER of '.$acad_id.'.csv';

        //create a file pointer
        $f = fopen('php://memory', 'w');

        //first title
        $title = array('','','NSTP MANAGEMENT SYSTEM');
        fputcsv($f,$title,$delimeter);
        
        //put a title
        // $title = array('','',$instructor_name->name);
        // fputcsv($f,$title,$delimeter);

        $title2 = array('','',$Class_name);
        fputcsv($f,$title2,$delimeter);

        $title6 = array('','',$acad_id);
        fputcsv($f,$title6,$delimeter);

        $title3 = array('',' ',$sem.' SEMESTER');
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
         foreach ($data as $row) {

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


        }else{
          //get data return false
         msgBox('No Data found!');
         redirect(WEB_ROOT.'admin-stud/');
        }


      }else{
        //no class selected
       msgBox('No Class Found!');
        redirect(WEB_ROOT.'admin-stud/');
      }

    }else{
      //no sem detected
     msgBox('No Semester Found!');
     redirect(WEB_ROOT.'admin-stud/');
    }


  }else{
    //no sy detected
   msgBox('no School Year Found!');
    redirect(WEB_ROOT.'admin-stud/');
  }

  }

}

function getData($acad,$sem,$class){
  global $mydb;
  $mydb->setQuery("select s.IDNO,concat(s.FNAME,' ',s.LNAME) name,gr.MID_TERM,gr.END_TERM,gr.FINAL,gr.REMARKS from enrollees en,students s,grades gr,class cl,acad_year ac where en.IDNO = s.IDNO and en.ENROLL_ID = gr.ENROLL_ID and en.CLASS_ID = cl.CLASS_ID and en.ACAD_ID = ac.ACAD_ID and cl.CLASS_ID = '".$class."' and ac.SCHOOL_YEAR = '".$acad."' and ac.SEMESTER = '".$sem."';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
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



 ?>