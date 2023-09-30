<?php

session_start();
require('../../include/initialize.php');

if(isset($_POST['modID'])){

 if(!empty($_POST['assID'])){
     if(!empty($_POST['modID'])){
      $mod_id = $_POST['modID'];
      $filetype = getModuleType($mod_id);
      $ass_id = $_POST['assID'];


      #we must check the file location of module from database!
      $file_loc = getModuleFileLoc($mod_id);

      if($file_loc != '0'){
        //the query is  not empty
            if($filetype != '0'){

                      if($filetype->FILE_TYPE == '0'){
                        //this module is only handouts

                        ?>

                        <hr><p style="color: grey;">Handouts</p>
                            <br><a id="file_loc" href="../myAddFile/<?php echo $file_loc->FILE_LOC; ?>" class="btn btn-success"><i class="fa fa-download"></i> Download Files</a>
                            


                        <?php



                      }else{
                        //maybe this module is assignment or exam
                        #check if the assign status is already submitted
                        $isSubmitted = getAssignStatus($ass_id);
                        if($isSubmitted != '0'){
                          //have data
                            
                          if($isSubmitted->STATUS == '0'){
                            //not already submitted

                            ?>

                            <br><a id="file_loc" href="../myAddFile/<?php echo $file_loc->FILE_LOC; ?>" class="btn btn-success"><i class="fa fa-download"></i> Download Files</a>
                            <br><hr><p style="color: green;">Assigned Work</p>
                            <br><button class="btn btn-primary" id="btnaddwork"><i class="fa fa-plus"></i> ADD WORK</button>


                            <?php


                          }else{
                            //already submitted
                            #then we will get the pass id of the student module
                            $dataPassID = getPassID($ass_id);
                            if($dataPassID !='0'){
                              //have data
                               $pass_id = $dataPassID->PASS_ID;
                              #then lets check if the user submitted status is not late
                                $subStatus = getDuePass($pass_id);
                                if($subStatus->DUE != '0000-00-00'){
                                  if($subStatus->DUE > $subStatus->UPLOAD_DATE){
                                    //On Time Submitted
                                    $modStatus1 = 'On Time Submitted';
                                    $colorS = 'green';
                                  }else{
                                    $modStatus1 = 'Submitted Late';
                                    $colorS = 'red';
                                  }
                              }else{
                                $modStatus1 = 'No Due Date';
                                $colorS = 'grey';
                              }

                               ?>

                               <hr><p style="color: <?php echo $colorS; ?>;"><?php echo $modStatus1; ?></p>
                          <br><input type="submit" class="btn btn-secondary btnunsubmit" id="<?php echo $ass_id; ?>" data-value="<?php echo $pass_id; ?>" value="UNSUBMIT"> 

                               <?php



                            }else{
                              //the query have no data!
                            }

                          }


                          }else{  
                            //no data
                          }
                        }

         }


      }else{
        //the query return false
      }

    }
 }

}


#set function
function getModuleType($mod_id){
global $mydb;
$mydb->setQuery("select * from module where MOD_ID = '".$mod_id."';");
$cur = $mydb->executeQuery();
$numrows = $mydb->num_rows($cur);

if($numrows > 0){
  $found = $mydb->loadSingleResult();
  return $found;
}else{
  return 0;
}

}


function getAssignStatus($ass_id){
  global $mydb;
  $mydb->setQuery("select * from assign_module WHERE ASSIGN_ID = '".$ass_id."';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found;
  }else{
    return 0;
  }
}

function getPassID($ass_id){
  global $mydb;
  $mydb->setQuery("select * from pass_module where ASSIGN_ID = '".$ass_id."';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found;
  }else{
    return 0;
  }

}

function getDuePass($pass_id){
  global $mydb;
  $mydb->setQuery("select mo.DUE,pass.UPLOAD_DATE from module mo,assign_module ass,pass_module pass where mo.MOD_ID = ass.MOD_ID and ass.ASSIGN_ID = pass.ASSIGN_ID and pass.PASS_ID = '".$pass_id."';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found;
  }else{
    return 0;
  }


}

function getModuleFileLoc($mod_id){
  global $mydb;
  $mydb->setQuery("Select * from module where MOD_ID = '".$mod_id."';");
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