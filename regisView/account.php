<?php

include('include/header.php');
include('include/sidebar.php');

$resData = getUserData($user_id);

 ?>
<div id="content-wrapper">

      <div class="container-fluid">
        <ol class="breadcrumb">
         <h4 class="center">MANAGE MY ACCOUNT</h4>
        </ol>

        <div class="row">
          

          <div class="col-md-3">

         
            </div>

            <div class="col-md-9">


              <form method="post" action="action/const.php?action=up">
                 <input type="hidden" value="<?php echo $user_id; ?>" name="user_id">
                <div class="row">

  

                    <div class="col">

                          <label for="ID NO"><strong>First Name</strong></label>
                          <input type="text" style="width: 360px;position: relative;" value="<?php echo $resData->FNAME ?>" name="fname" class="form-control" required=""  placeholder="Firstname">
                          <span class="text-danger" id="error_fname"></span>

                    </div> 

                  </div> 

                  <div class="row">
                    <div class="col">
                      <label style="margin-top: 15px;"><strong>Last Name</strong></label>
                      <input type="text" class="form-control" name="lname" style="width: 360px;position: relative;" required=""placeholder="Lastname" value="<?php echo $resData->LNAME; ?>">
                      <span class="text-danger" id="error_lname"></span>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <label style="margin-top: 15px;"><strong>Username</strong></label>
                      <input type="email" class="form-control" name="username" style="width: 360px;position: relative;" required="" placeholder="email" value="<?php echo $resData->USERNAME; ?>">
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
                      <button class="btn btn-primary" style="position: relative;margin: 0px;margin-bottom:15px;margin-top: 20px;width: 360px; " name="updateUserBtn"><i class=" fa fa-save"> SAVE</i></button>
                    </div>
                  </div>
           

      
            </div>


        </div>


 <?php
include('include/footer.php');
include('include/script.php');

function getUserData($user_id){

  global $mydb;

  $mydb->setQuery("select * from user where user_id = {$user_id}");
  $cur = $mydb->loadSingleResult();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}


  ?>


  <script type="text/javascript">


  $(document).ready(function(){

        <?php check_message(); ?>


    $('#repass').keyup(function(e){
    e.preventDefault();

      if($(this).val() != $('#pass1').val()){
        //not equal
        $('#error_pass').text('Password Not Match');
         $('#error_pass').attr('class','text-danger');
      }else{
        //equal
        $('#error_pass').text('Password Match!');
        $('#error_pass').attr('class','text-success');
      }

      if($(this).val() != ''){

      }else{
        $('#error_pass').text('');

      }


    });

  });


</script>