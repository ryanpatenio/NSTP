<?php
session_start();
global $mydb;
require_once("../../include/initialize.php");

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'export' :
	exportCsv();
	break;
	
	case 'up' :
	updateUserData();
	break;
	
	case 'delete' :
	doDelete();
	break;

	case 'photos' :
	doupdateimage();
	break;

 
	}


	function updateUserData(){

  if(isset($_POST['updateUserBtn'])){
    if($_POST['user_id']){
      $user_id = $_POST['user_id'];

      //first get the user old password
      $oldPass =  getOldPass($user_id);
      $checkOldPass = trim($_POST['oldpass']);
      $m_pass = md5($checkOldPass);
     
     //then check if the old pass are match in the old pass in the input field
      if($m_pass != $oldPass->PASSWORD){
        //not equal or not match
        //message('Old Password Not Match!','warning');
       	msgBox("Old password is incorrect!");
         redirect(WEB_ROOT."regisView/account.php");
      }else{
        //true:: password Match
        #then get all the input fields
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = trim($_POST['username']);
        $newPass = trim($_POST['repass']);
        $hashpass = md5($newPass);

        $pass1 = trim($_POST['pass1']);
        #lets check if the second retype password is the same
        if($pass1 == $newPass){
          
          //password pass 1 and pass 2 match!

             $willUpdate = getUpdated($user_id,$fname,$lname,$username,$hashpass);

              if($willUpdate == 1){
                //return true;
                //message('Account updated successfully!','info');
                msgBox("Account updated successfully!");  
                redirect(WEB_ROOT."regisView/account.php");
              }else{
                //return false;
                //message('Problem in inserting in database!','error');
                msgBox("Problem in insertring in database!");
                
               redirect(WEB_ROOT."regisView/account.php");
              }



        }else{
          msgBox('New Password and Confirm Password are not Match!');
          redirect(WEB_ROOT."regisView/account.php");
        }
       
      }

    }else{
      //user_id not found!
      //message('User id not found!','error');
    	msgBox("User ID not Found!");
      redirect(WEB_ROOT."regisView/account.php");
    }
  }

}




function getUpdated($user_id,$fname,$lname,$username,$password){
  global $mydb;
  $mydb->setQuery("UPDATE user SET FNAME ='".$fname."',LNAME = '".$lname."',USERNAME='".$username."',PASSWORD='".$password."' WHERE USER_ID = '".$user_id."';");

  $cur = $mydb->executeQuery();

  if($cur){
    return 1;
  }else{
    return 0;
  }
}

function getOldPass($user_id){
  global $mydb;
  $mydb->setQuery("select * from user where USER_ID = {$user_id}");
  $cur = $mydb->loadSingleResult();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}


?>