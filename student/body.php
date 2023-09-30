<!--- progress Bar----->
<?php
$data = new MyFiles();

$CountTotal = $data->countAllassignModuleFirstSem($IDNO);
$CountPass = $data->countAllPassModuleFirstSem($IDNO);

if($CountTotal!=0){
  $count1 = $CountPass/$CountTotal;
  $count2 = $count1*100;
  $percentFirst = number_format($count2);
}else{
  $percentFirst = 0;
}



 ?>
<h4 class="" style="margin-top: 2%;margin-left: 26%;position: relative;">PROGRESS WORK MODULES</h4>
<div class="row">
 
<?php 
if($getSem==1){
  //first semester
  require_once("workModuleFirstSem.php");
}elseif($getSem==2){
  //second semester
  require_once("workModuleSecondSem.php");
}else{


}

 ?>


  
</div>



<!-------First Semester Attendance-------->



<?php

$data2 = new UserAttend();


if($getSem==1){
  //first semester
  require_once("attendanceFirstSem.php");
}


 ?>



<!------- End First Semester Attendance-------->


<!-------Second Semester Attendance-------->
<?php

if($getSem==2){
  //second semester
  require_once("attendanceSecondSem.php");
}


 ?>