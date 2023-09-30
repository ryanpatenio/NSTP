<?php
include('../student-asset/header.php');
include('../student-asset/sidebar.php');

include('../student-asset/breadcrumbs.php');


?>


<?php

#####################     For Module        ##########################
#count all assign module
$all_assign_module = getAllAssignModule($IDNO);

#then count all submitted module
$all_pass_module = getAllPassModule($IDNO);

#then check if this all function is working or have data
if($all_assign_module !='0'){

    if($all_pass_module !='0'){

        #then lets compute the percentage
        $module_division = $all_pass_module/$all_assign_module;
        $division_result = $module_division*100;

        $module_percentage = number_format($division_result);


    }else{
      //second query return false!
      $module_percentage = 0;
    }

}else{
  //first function return false!
  $module_percentage = 0;
}

#lets set the color percentage of the module 
if($module_percentage < 75){
  $color_module = '#fe0000';
}else{
  $color_module = '#0bff01';
}





##################     For Attendance       ############################


#set student class id 
$class_id = getStudentClass_id($IDNO);

#count all the schedule inserted
$allschedule = allSchedules($class_id);

#then count all present Attendance
$allPresent = getStudentPresent($IDNO);


#then check if this all function have data

  if($class_id != '0'){

    if($allschedule != '0'){

      if($allPresent != '0'){

        #then lets get the percent
        $division = $allPresent/$allschedule;
        $result = $division*100;
        $present_percentage = number_format($result);

      }else{
        //third function return0;
        $present_percentage = 0;
      }

    }else{
      //second function return 0
      $present_percentage = 0;
    }


  }else{
    //first function return 0
    $present_percentage = 0;
  }

  #lets settle the color percentage
  if($present_percentage < 75){
    $colorstatus = '#fe0000';
  }else{
    $colorstatus = '#0bff01';
  }


 ?>





 <div class="col">

   

      <label for="Work Module"><strong>MODULE PROGRESS</strong></label>


          <div class="progress" style="height: 1px;">
            <div class="progress-bar " role="progressbar" style="width:<?php echo $module_percentage; ?>%;background-color:<?php echo $color_module; ?>;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>

          </div>
          <div class="progress" style="height: 20px;margin-top: 10px;">

          <div class="progress-bar  progress-bar progress-bar-animated" role="progressbar" style="width: <?php echo $module_percentage; ?>%;background-color:<?php echo $color_module; ?>;border-radius: 10px;" aria-valuenow="25" aria-valuemax="100" ><?php echo $module_percentage; ?>%</div>
          </div>
  </div>

  <br>
  <hr>
   <div class="col">

   

      <label for="Work Module"><strong>ATTENDANCE PROGRESS</strong></label>

      <div class="progress" style="height: 1px;">
        <div class="progress-bar " role="progressbar" style="width:<?php echo $present_percentage; ?>%;background-color:<?php echo $colorstatus; ?>;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>

      </div>
      <div class="progress" style="height: 20px;margin-top: 10px;">

      <div class="progress-bar  progress-bar progress-bar-animated" role="progressbar" style="width: <?php echo $present_percentage; ?>%;background-color:<?php echo $colorstatus; ?>;border-radius: 10px;" aria-valuenow="25" aria-valuemax="100" ><?php echo $present_percentage; ?>%</div>
      </div>
      
  </div>

<?php




include('../student-asset/footer.php');
include('../student-asset/script.php');


function getStudentClass_id($IDNO){
  global $mydb;
  $mydb->setQuery("select en.CLASS_ID from enrollees en,acad_year ac where en.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and en.IDNO = '".$IDNO."';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found->CLASS_ID;
  }else{
    return 0;
  }


} 

function allSchedules($class_id){
  global $mydb;

  $mydb->setQuery("select count(*) 'count' from class_sched cl,acad_year ac where cl.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and cl.CLASS_ID = '".$class_id."';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found->count;
  }else{
    return 0;
  }
}


function getStudentPresent($IDNO){
  global $mydb;
  $mydb->setQuery("select count(*) 'present' from attendance att,acad_year ac where att.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and att.IDNO = '".$IDNO."' and att.`STATUS` = 'Present'");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found->present;
  }else{
    return 0;
  }
}


#######################      for module       #########################

function getAllAssignModule($IDNO){
  global $mydb;
  $mydb->setQuery("select count(*) as 'count' from assign_module ass,module mo,acad_year ac where ass.MOD_ID = mo.MOD_ID and ass.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and mo.FILE_TYPE not in(0)  and ass.IDNO = '".$IDNO."';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found->count;
  }else{
    return 0;
  }
}


function getAllPassModule($IDNO){
  global $mydb;
  $mydb->setQuery("select count(*) as 'pass' from assign_module ass,module mo,acad_year ac where ass.MOD_ID = mo.MOD_ID and ass.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and mo.FILE_TYPE not in(0) and ass.`STATUS` = 1 and ass.IDNO = '".$IDNO."';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found->pass;
  }else{
    return 0;
  }

}


 ?>