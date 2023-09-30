<?php session_start(); ?>
<?php require_once("include/initialize.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>

 <?php require_once("theme/link-header.php"); ?>
<link rel="icon" type="image/x-icon" href="images/chmsc.png">
</head>

<body class="bg-dark" style="background-image:url('images/wirele.gif');overflow: hidden;background-size: 70%;">

  <div class="container">

    <div class="row">

     <div class="col-md-6">
       <img src="images/chmsc.png" style="width: 35%;position: relative;"> <h1 style="font-family: broadway;color:#ffe700;position: fixed;margin-top: -100px;margin-left: 220px;">NSTP MANAGEMENT SYSTEM</h1>
     </div>
   </div>

    <div class="card card-login mx-auto mt-5" style="background-color: rgba(236,236,236);box-shadow: 0 3px 20px 2px rgb(1 1 1 / 0.98);position: relative;">
      <div class="card-header">ADMIN</div>
      <div class="card-body">

        <div class="alert alert-danger error_alert2" style="display: none;">
          <strong id="error_message2"></strong>
        </div>

        <form method="post" id="AdProcess">
          
          <div class="form-group">
            <div class="form-label-group">
              <input name="Myemail" type="email" id="inputEmail" class="form-control" placeholder="Email" required="required" autofocus="autofocus">
              <label for="inputEmail">E-mail</label>
              <span class="text-danger" id="email_error"></span>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input name="Mypass" type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
              <span class="text-danger" id="pass_error"></span>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
             
                  <hr class="mb-3">
               
            
            </div>
          </div>
            <input type="hidden" name="action" value="AdmProcess">
            <input type="submit" name="" id="btnAdLg" value="Login" class="btn btn-primary btn-block">
           

        </form>

        <div class="text-center" id="linkAdDiv">
          <a class="d-block small mt-3" href="login.php?">Login as Instructor</a>
          
        </div>

        <!--<div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
         
        </div>-->
      </div>
    </div>
  </div>

  <?php require_once("theme/js-cript.php"); ?>

</body>


</html>
<script src="adminAction/myScriptAd.js"></script>
