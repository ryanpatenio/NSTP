<?php
include('../instructor-asset/header.php');
include('../instructor-asset/sidebar.php');


 ?>
  <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">MANAGE MY ACCOUNT</h4>
        </ol>
<?php

$inst_data = getInstructorData($_SESSION['inst_id']);

 ?>



<div class="row">
            
           <div class="col-md-3">

            <form method="post" id="upImg" enctype="multipart/form-data">
              <input type="hidden" value="<?php echo $inst_data->INST_ID; ?>" name="inst_id">

              <?php

              if($inst_data->AVATAR=='null'){
                $result1 = '../images/default2.jpeg';
               
              }else{
                $result1 = "img/".$inst_data->AVATAR;
                
              }

               ?>

              <!----IMG----->
              <img id="curImg" name="curImg" style="height: 250px;width: 300px;" src="<?php echo $result1; ?>" class="img-thumbnail" />
             <input type="hidden" value="<?php echo $result1; ?>" name="oldimg">
              <!----IMG----->

              <label style="margin-top: 10px;"><strong>Change Avatar?</strong></label>
              <input type="file" class="form-group" accept="image/*" name="avatar" id="avatar" style="margin-top: 0px;margin-bottom: 0px;">

              <div>
                 <progress id="prog" style="width: 200px;display: none;">
              </div>

              <input type="hidden" name="action" id="action" value="addimg">
              <input type="submit" id="upBtn" class="btn btn-primary" value="Upload..." name="" style="margin-top: 10px;width: 200px;display: none;">

              </form>
            </div>

            <div class="col-md-9">


              <form method="post" id="editacc">
                 <input type="hidden" value="<?php echo $inst_data->INST_ID; ?>" name="inst_id2">
                <div class="row">

  

                    <div class="col">

                          <label for="ID NO"><strong>First Name</strong></label>
                          <input type="text" style="width: 360px;position: relative;" value="<?php echo $inst_data->FNAME ?>" name="fname" class="form-control" required=""  placeholder="Firstname">
                          <span class="text-danger" id="error_fname"></span>

                    </div> 

                  </div> 

                  <div class="row">
                    <div class="col">
                      <label style="margin-top: 15px;"><strong>Last Name</strong></label>
                      <input type="text" class="form-control" name="lname" style="width: 360px;position: relative;" required=""placeholder="Lastname" value="<?php echo $inst_data->LNAME; ?>">
                      <span class="text-danger" id="error_lname"></span>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <label style="margin-top: 15px;"><strong>Username</strong></label>
                      <input type="email" class="form-control" name="username" style="width: 360px;position: relative;" required="" placeholder="email" value="<?php echo $inst_data->USERNAME; ?>">
                      <span class="text-danger" id="error_email"></span>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col" >
                      <label style="margin-top: 15px;"><strong>Old Password</strong></label>
                      <input type="password" class="form-control" name="oldpass" style="width: 360px;position: relative;" required="" placeholder="Old Password">
                      <span class="text-danger" id="error_old"></span>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <label style="margin-top: 15px;"><strong>New Password</strong></label>
                      <input type="password" class="form-control" name="pass1" id="pass1" style="width: 360px;position: relative;" required="" placeholder="New Password">
                      <span class="text-danger" id="error_new"></span>

                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <label style="margin-top: 15px;"><strong>Confirm Password</strong></label>
                      <input type="password" class="form-control" name="repass" id="repass" style="width: 360px;position: relative;" required="" placeholder="Confirm Password">
                      <span class="text-danger" id="error_pass"></span>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <input type="hidden" name="action" value="editDetails">
                      <button class="btn btn-primary" style="position: relative;margin: 0px;margin-bottom:15px;margin-top: 20px;width: 360px; "><i class=" fa fa-save"> SAVE</i></button>
                    </div>
                  </div>
           

      
            </div>


              </form>
            </div>

        </div>


<?php

include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');


function getInstructorData($inst_id){
  global $mydb;

  $mydb->setQuery("select * from instructor where INST_ID = '".$inst_id."';");
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
<script type="text/javascript" src="action-script/script.js"></script>

