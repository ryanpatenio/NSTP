<?php
session_start();
require_once("../include/initialize.php");

if($_POST['action'] == "uploadAvatar"){

	if(!empty($_POST['user_id'])){
		$user_id = $_POST['user_id'];

		
		/* Getting file name */
	   $getfile = $_FILES['avatar2'];

	   /*get the old photo to delete*/
	   $oldImg = $_POST['old_img'];

	   //getting the file name and the file size
	   $getfileName = $getfile['name'];
	   $getfileSize = $getfile['size'];


	    if($getfileSize < 20971520){
	    	//true less than 20MB
	    	//check the Extension of the IMAGE
	    	$type = strtolower(pathinfo($getfileName,PATHINFO_EXTENSION));
	   		if($type=='png' OR $type=='jpg' OR $type=='jpeg'){
	   			//valid Image
	   			//then set location variable
	   			$location = "image/";

	   			//add to name extesnion char
	   			$length = 10;
	   			$gen = str_shuffle(str_repeat($x='02132mnopqrstuvwxyz', ceil($length/strlen($x))));
	   			$addtonameDate = date("dmYHis");
	   			$addChar = $gen."".$addtonameDate;
	   			$newfile = $addChar.str_replace("", "", $getfileName);

	   			//get the function to execute the Query
	   			$execQuery = executeCodes($newfile,$user_id);

	   			//check the query 
	   			if($execQuery){
	   				//expecting true
	   				//then check if the img is new or OLD
	   				if(!empty($_POST['old_img'])){
	   					//..codes
	   					//check if the same in the default image
	   					if($_POST['old_img'] == '../accounts/image/default2.jpeg'){
	   						//default Image
	   						move_uploaded_file($getfile['tmp_name'], $location.$newfile);
	   						$output = array('success'=>'success');
	   					}else{
	   						//not default Image
	   						//then unlink the current Image Replace New
	   						move_uploaded_file($getfile['tmp_name'], $location.$newfile);
			   				unlink($oldImg);
			   				$output = array('success'=>'success');
	   					}


	   				}else{
	   					//empty old image
	   					$output = array('error_oldImg'=>'Old image is empty');
	   				}
	   			}else{
	   				//query failed
	   				$output = array('query_error'=>'Query Error Not executed');
	   			}
	   			

	   		}else{
	   			//not an image or Invalid
	   			$output = array('img_invalid'=>'Not an image');
	   		}


	    }else{
	    	//greater than 20MB
	    	$output = array('imgLarge'=>'Image was to large');
	    }
	}


echo json_encode($output);
}


function executeCodes($img,$ID){
	global $mydb;

	$mydb->setQuery("UPDATE user SET AVATAR='".$img."' WHERE USER_ID ={$ID}; ");

	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}

}



 ?>