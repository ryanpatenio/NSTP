<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'nstp');

defined('LIB_PATH') ? null : define ('LIB_PATH',SITE_ROOT.DS.'include');

// load config file first 
require_once(LIB_PATH.DS."config.php");
//load basic functions next so that everything after can use them
require_once(LIB_PATH.DS."function.php");
require_once(LIB_PATH.DS."member.php");
//load database
require_once(LIB_PATH.DS."database.php");
//require_once(LIB_PATH.DS."adminTable.php");
require_once(LIB_PATH.DS."student.php");


require_once(LIB_PATH.DS."adminTable.php");
require_once(LIB_PATH.DS."checker.php");
require_once(LIB_PATH.DS."inc.php");
require_once(LIB_PATH.DS."attendance.php");
require_once(LIB_PATH.DS."module.php");
require_once(LIB_PATH.DS."notif.php");





 ?>