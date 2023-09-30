<?php session_start(); ?>
<?php require_once("include/initialize.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>

 <?php require_once("theme/link-header.php"); ?>
 <link rel="icon" type="image/x-icon" href="images/chmsc.png">
</head>
<style type="text/css">
  @media screen and (max-width: 600px){
    #hh{
      font-size: 20px;
      position: absolute;
     
    }
  }
</style>

<body class="has-bg-img bg-dark" style="background-image:url('images/wirele.gif');overflow: hidden;background-size: 70%;">
<!------background-image:url('images/cover2.jpeg');------------>

  <div class="container">

   <div class="row">

     <div class="col-md-6">
       <img src="images/chmsc.png" style="width: 35%;position: relative;"> <h1 id="hh" style="font-family: Broadway;color: #ffe700;position: fixed;margin-top: -100px;margin-left: 220px;">NSTP MANAGEMENT SYSTEM</h1>
     </div>
   </div>
     

    <div class="card card-login mx-auto mt-5" style="background-color: rgba(236,236,236);box-shadow: 0 3px 20px 2px rgb(1 1 1 / 0.98);position: relative;">
      <div class="card-header">Login as Instructor</div>
      <div class="card-body">
        <div class="alert alert-danger error_alert" style="display: none;">
          <strong id="error_message"></strong>
        </div>

        <form method="post" id="processMe">
          
          <div class="form-group">
            <div class="form-label-group">
              <input name="user_email" type="email" id="inputEmail" class="form-control" placeholder="Email" required="required" autofocus="autofocus">
              <label for="inputEmail">E-mail</label>
              <span class="text-danger" id="errorEmail"></span>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input name="user_pass" type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
              <span class="text-danger" id="errorPass"></span>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
             
                  <hr class="mb-3">
               
            
            </div>
          </div>
            <input type="hidden"  name="action" value="process">
            <input type="submit" name="" id="btnLg" class="btn btn-primary btn-block" value="Login">
          

        </form>

        <div class="text-center divLink">
          <a class="d-block small mt-3" href="AD.php?">Login as ADMIN</a>
          
        </div>

        <!--<div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
         
        </div>-->
      </div>
    </div>
  </div>
  <!-- <h1 style="font-family: tahoma,verdana,sans-serif;color: orange;">CHMSC NSTP MANAGEMENT SYSTEM</h1> -->

  <?php require_once("theme/js-cript.php"); ?>

</body>

</html>
<script src="adminAction/myScript.js"></script>

