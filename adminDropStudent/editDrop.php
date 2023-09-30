<?php
include('../themeAsset/header.php');
include('../themeAsset/adminSidebar.php');

if(!isset($_GET['ENROLL_ID'])){
  redirect(WEB_ROOT."login.php");
}

$get_enroll_id = $_GET['ENROLL_ID'];
$get_IDNO = $_GET['IDNO'];

 ?>
<div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">UPDATE DROP STUDENTS</h4>
        </ol>



<div class="row">





<?php

  #get data from the students
  $data = getData($get_enroll_id);
  if($data !='0'){
    //this function have data

  $whatSem = getDropSem($get_enroll_id);

    if($whatSem !='0'){
      //function have data
      #then lets check if what sem

      if($whatSem->SEMESTER == 'FIRST'){
        //display first semester division tags
        include('sem/first.php');
      }else{
        //display second semester division tags
        include('sem/second.php');
      }



    }


  }



 ?>

 


</div>




 <?php
include('modal/firstModal.php');
include('modal/secondModal.php');

include('../themeAsset/footer.php');
include('../themeAsset/script.php');

#set function
function getStudentData($IDNO){
  global $mydb;
  $mydb->setQuery("select s.IDNO,concat(s.FNAME,' ',s.LNAME) as 'name',st.GENDER,st.ADDRESS,en.`STATUS`,cl.CLASS_ID,cl.CLASS_NAME,co.COURSE_ID,co.COURSE_NAME,sec.SECT_ID,sec.YR_SECTION from enrollees en,students s,stud_details st,class cl,course co,sections sec where en.IDNO = s.IDNO and s.IDNO = st.IDNO and en.CLASS_ID = cl.CLASS_ID and en.COURSE_ID = co.COURSE_ID and en.SECT_ID = sec.SECT_ID and en.IDNO = '".$IDNO."' LIMIT 1");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found;
  }else{
    return 0;
  }
 
}

function getDropSem($enroll_id){
  global $mydb;
  $mydb->setQuery("select ac.SEMESTER from enrollees en,acad_year ac where en.ACAD_ID = ac.ACAD_ID and en.ENROLL_ID = '".$enroll_id."';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found;
  }else{
    return 0;
  }
}

function getData($enroll_id){
  global $mydb;
  $mydb->setQuery("select en.ENROLL_ID,concat(s.FNAME,' ',s.LNAME) name,cl.CLASS_ID,cl.CLASS_NAME,ac.SCHOOL_YEAR,ac.SEMESTER,en.R_STATUS from enrollees en,students s,class cl,acad_year ac where en.IDNO = s.IDNO and en.CLASS_ID = cl.CLASS_ID and en.ACAD_ID = ac.ACAD_ID and en.ENROLL_ID = '".$enroll_id."';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found;
  }else{
    return 0;
  }

}

function getDefaultSyFirstSem(){
  global $mydb;
  $mydb->setQuery("select * from acad_year where STATUS = 'YES' and SEMESTER='FIRST';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0 ){
    $found = $mydb->loadSingleResult();
    return $found;
  }else{
    return 0;
  }
}


function getDefaultSySecondSem(){
  global $mydb;
  $mydb->setQuery("select * from acad_year where STATUS = 'YES' and SEMESTER='SECOND';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0 ){
    $found = $mydb->loadSingleResult();
    return $found;
  }else{
    return 0;
  }
}

function getClassFirst(){
  global $mydb;
  $mydb->setQuery("select * from class");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0 ){
    
    return $cur;
  }else{
    return 0;
  }

}


 ?>
  <script type="text/javascript" src="action/script.js"></script>