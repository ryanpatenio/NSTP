<?php

include('../themeAsset/header.php');
include('../themeAsset/adminSidebar.php');


if(!isset($_SESSION['user_id'])){
  redirect(WEB_ROOT."login.php");
}else{


      $userID  = $_SESSION['user_id'];

      //code:: get the user ID and fetching data from the database
      $userData = new user();

      $fetchData = $userData->getUserInfo($userID);
}

 ?>


<div id="content-wrapper">

      <div class="container-fluid">
       <ol class="breadcrumb">
         <h4 class="center">MANAGE MY ACCOUNT</h4>
        </ol>

<!-------------Form------>
<div class="row">
<div class="col-md-3">

           <form method="post" id="imgupload" enctype="multipart/form-data">
              <!------USER ID-------->

              <input type="hidden" name="user_id" value="<?php echo $userID; ?>">

              <?php

              if($fetchData['img'] == 'null'){
                $res_img = "../accounts/image/default2.jpeg";
              }else{
                $res_img = "image/".$fetchData['img'];
              }



               ?>


              <!-------Fetch the OlD IMG---------->
              <input type="hidden" class="form-control" name="old_img" value="<?php echo $res_img; ?>">

              <!-- for displaying pictures -->
              <img id="curImg" name="curImg" style="height: 250px;width: 300px;" src="<?php echo $res_img; ?>" class="img-thumbnail" data-value="<?php echo $res_img; ?>" />



              <!-- Files only accept pictures -->
              <label style="margin-top: 10px;"><strong>Change Avatar?</strong></label>
              <input type="file" class="form-group" id="avatar2" accept="image/*" name="avatar2">
             
            <!--   for uploading avatar picture -->
            <input type="hidden" name="action" id="action" value="uploadAvatar">
           <input type="submit" id="saveBtn" class="btn btn-primary saveBtn" value="Upload" style="width: 200px;margin-top: 20px;position: relative;margin-left: 20px;display: none;">

            </form>
          

            </div>


            <div class="col-md-9">


              <form method="post" id="editMyAccount">
                <input type="hidden" name="account_id" value="<?php echo $userID; ?>" name="">

                 <div class="row">
                   <div class="col">
                     <label><strong>First Name</strong></label>
                     <input type="text" class="form-control" name="fname" value="<?php echo $fetchData['fname']; ?>" style="width: 360px;position: relative;" required="">
                     <span class="text-danger" id="error_fname"></span>
                   </div>           
                 </div>

                 <div class="row">
                   <div class="col" style="margin-top: 10px;">
                     <label><strong>Last Name</strong></label>
                     <input type="text" class="form-control" name="lname" value="<?php echo $fetchData['lname']; ?>" style="width: 360px;position: relative;" required="">
                     <span class="text-danger" id="error_lname"></span>
                   </div>
                 </div>

                 <div class="row">
                   <div class="col" style="margin-top: 10px;">
                     <label><strong>Username</strong></label>
                     <input type="email" class="form-control" name="newUserEmail" value="<?php echo $fetchData['username']; ?>" style="width: 360px;position: relative;" required="">
                     <span class="text-danger" id="error_user"></span>
                   </div>
                 </div>

                 <div class="row">
                   <div class="col" style="margin-top: 10px;">
                     <label><strong>Old Password</strong></label>
                     <input type="password" class="form-control" name="oldPass" id="oldPass" style="width: 360px;position: relative;" required="" placeholder="Old Password">
                     <span class="text-danger" id="error_old"></span>
                   </div>
                 </div>

                 <div class="row">
                   <div class="col" style="margin-top: 10px;">
                     <label><strong>New Password</strong></label>
                     <input type="password" class="form-control" name="newPass" id="newPass" style="width: 360px;position: relative;" required="" placeholder="New Password">
                    <span class="text-danger" id="error_new"></span>

                   </div>
                 </div>

                 <div class="row">
                  <div class="col" style="margin-top: 10px;">
                     <label><strong>Confirm Password</strong></label>
                     <input type="password" class="form-control" name="cfPass" id="cfPass" style="width: 360px;position: relative;" required="" placeholder="Confirm-Password">
                     <span class="text-danger" id="span_error"></span>
                   </div>
                 </div>

                 <div class="row">
                   <div class="col">
                    <input type="hidden" name="action" value="EDIT">
                     <button class="btn btn-primary" id="saveDetailsBtn" style="width: 360px;margin-top: 30px;margin-bottom: 30px;position: relative;"><i class="fa fa-save"> Save</i></button>
                   </div>
                 </div>
                


              </form>
            </div>
        
</div>


          

<?php

include('../themeAsset/footer.php');
include('../themeAsset/script.php');

 ?>
 <!-------Script for action------->
<script src="server_action/script.js"></script>
