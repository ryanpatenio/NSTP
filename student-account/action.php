<?php
session_start();
require_once("../include/initialize.php");

if($_POST['action']=="addimg"){

	if(!empty($_POST['stud_id'])){
		$student_id = $_POST['stud_id'];

		/* Getting file name */
	   $getfile = $_FILES['avatar'];

	   /*get the old photo to delete*/
	   $oldImg = $_POST['oldimg'];

	   //getting the file name and the file size
	   $getfileName = $getfile['name'];
	   $getfileSize = $getfile['size'];

	   if($getfileSize < 20971520){
	   	//true less than 20MB
	   		$type = strtolower(pathinfo($getfileName,PATHINFO_EXTENSION));
	   		if($type=='png' OR $type=='jpg' OR $type=='jpeg'){
	   			//valid picture
	   			$location = "../student-account/img/";
	   			$addtoname = date("dmYHis");
	   			$newfile = $addtoname.str_replace("", "", $getfileName);

	   			global $mydb;
	   			$mydb->setQuery("UPDATE students SET avatar ='".$newfile."' WHERE IDNO ='".$student_id."';");
	   			$cur = $mydb->executeQuery();

	   			if($cur){
	   				//success:: check if this is the first time he/she change her avatar
	   				if($_POST['oldimg']=="../images/default2.jpeg"){
	   					move_uploaded_file($getfile['tmp_name'], $location.$newfile);
	   					$output = array('success'=>'success');
	   					
	   				}else{
	   					move_uploaded_file($getfile['tmp_name'], $location.$newfile);
		   				unlink($oldImg);
		   				$output = array('success'=>'success');
		   				
	   				}

	   			}else{
	   				//failed to upload
	   				$output = array('error_query'=>'system error!!');

	   			}				

	   		}else{
	   			//invalid picture
	   			$output = array('error_img'=>'not Image!');
	   		}
	   }else{
	   	//file was to large
	   	$output = array('error_file_size'=>'Img size was to large!');
	   }
	}else{
		//instructor ID not found
		$output = array('error_student_id'=>'system error!!');
	}



	echo json_encode($output);
}


//for editing details

if($_POST['action']=='editDetails'){

	$error = 0;
	
	$error_email ='';
	$error_old ='';
	$error_new ='';


	

	if(!empty($_POST['username'])){
		$email = trim($_POST['username']);
	}else{
		$error++;
		$error_email= 'Input Field is required!';
	}

	if(!empty($_POST['oldpass'])){
		$oldpass = trim($_POST['oldpass']);
		$md5OldPass = md5($oldpass);
	}else{
		$error++;
		$error_old= 'Input Field is required!';
	}


	if(!empty($_POST['pass1'])){
		$newpass = trim($_POST['pass1']);
	}else{
		$error++;
		$error_new= 'Input Field is required!';
	}

	if($error > 0){
		//set all errors into array
		$output = array(
			'error'=>true,
			'error_email'=>$error_email,
			'error_old'=>$error_old,
			'error_new'=>$error_new
		);
	}else{

		
		if(!empty($_POST['student_id'])){
			$student_id2 = $_POST['student_id'];
			global $mydb;
			$mydb->setQuery("select * from students where IDNO = '".$student_id2."' LIMIT 1");
			$cur = $mydb->executeQuery();
			$numrow = $mydb->num_rows($cur);

			if($numrow > 0){
				$foundpass = $mydb->loadSingleResult();
				$getOldPass = $foundpass->PASSWORD;

				if($md5OldPass != $getOldPass){
					//input Old password and Instructor Existing password Not Match!
					$output = array('error_oldpass'=>'input Old Password and Instructor Password not Match');
				}else{
					//match
					$mydb->setQuery("UPDATE students SET USERNAME='".$email."',PASSWORD= md5('".$newpass."') WHERE IDNO = '".$student_id2."'");
					$cur2 = $mydb->executeQuery();
					if($cur2){
						//expecting true
						 $output = array('success'=>'success');
					}else{
						//failed
						$output = array('error_query'=>'failed');
					}
				}

			}else{
				// Zero result Rows
				$output = array('error_numrows'=>'No Num row results');
			}



		}else{
			//inst id not found!
			$output = array('error_student_id'=>'Instructor ID not found!');
		}

	}

	echo json_encode($output);
}

?>