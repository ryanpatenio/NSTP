<?php 
require_once '../include/initialize.php';
// Four steps to closing a session
// (i.e. logging out)

// 1. Find the session
@session_start();

// 2. Unset all the session variables
// unset( $_SESSION['USERID'] );
// unset( $_SESSION['FULLNAME'] );
// unset( $_SESSION['USERNAME'] );
// unset( $_SESSION['PASS'] );
// unset( $_SESSION['ROLE'] );



unset( $_SESSION['student_id'] );

unset( $_SESSION['sect_id']);
unset($_SESSION['account_name']);
unset($_SESSION['statusReg']);

//unset( $_SESSION['ACCOUNT_PASSWORD'] );
//unset( $_SESSION['ACCOUNT_TYPE'] );
// 4. Destroy the session
//session_destroy();
//redirect(WEB_ROOT."login.php?");
redirect(WEB_ROOT."student/");
?>