<?php

session_start();
require_once("../../include/initialize.php");

if($_POST['action']=='ADD'){

if(!empty($_POST['ass_id'])){
	$assMod = $_POST['ass_id'];

	if(!empty($_POST['IDNO'])){
		$IDNO = $_POST['IDNO'];

		if(!empty($_POST['class_id'])){
			$class_id = $_POST['class_id'];
					#check if the acad year exist
		$isAcad = getSY();
		if($isAcad !='0'){
			//have academic year
			$acad_id = $isAcad->ACAD_ID;

					/* Getting file name */
			   $getfile = $_FILES['passFile'];

			   //getting the file name and the file size
			   $getfileName = $getfile['name'];
			  
			  //getting the file size
			   $getfileSize = $getfile['size'];

			    if($getfileSize != 0){

			    	if($getfileSize < 20971520){
			    		$type = strtolower(pathinfo($getfileName,PATHINFO_EXTENSION));
			    		if($type=='docx' OR $type=='ppt' OR $type=='pdf' OR $type=='pptx' OR $type=='doc'){

			    			$location = "../../studentPassMod/";
							$randomNum = rand(100,10000);
							$addtoname = "aS".$randomNum."sTs".$randomNum."XhrT0016sH".date("dmYHis");

							$newfile = $addtoname.str_replace("", "", $getfileName);


							
							//call a function then execute the Data
							//inserting in the table pass Module
							$cur = addPassModule($assMod,$IDNO,$acad_id,$newfile);
							$pass_id = $mydb->insert_id();
							if($cur=='1'){
								//true

								$cur2 = updateAssignModuleStatus($assMod);
								if($cur2 == '1'){
									//true::updating the assign Module into STATUS = 1

									//getting the file size to display in the output message
									$kb = $getfileSize /1024;
									$mb = $kb / 1048576;
									move_uploaded_file($getfile['tmp_name'], $location.$newfile);

									$message='UPLOADED FILE MODULE';
									$mydb->setQuery("INSERT INTO teacher_notif (IDNO,CLASS_ID,ASSIGN_ID,PASS_ID,ACAD_ID,UPLOADED_DATE,MESSAGE,READM) VALUES('".$IDNO."','".$class_id."','".$assMod."','".$pass_id."','".$acad_id."',now(),'".$message."','0')");
									$res2 = $mydb->executeQuery();
									
									if($res2){

										$output = array(
											'success'=>'success',
											'file_size'=>$mb
										);

									}

									
								}else{
									//Updating assign Module Error!
									$output = array('error_query2'=>'Updating Assign Module Failed!');
								}
							}else{
								//adding Pass Module Error
								$output = array('error_query1'=>'Adding Module Query Error!');
							}

			    		}else{
			    			//file must be DOcx or PPT or PDF
			    			$output = array('error_fileType'=>'Must Be Docx or ppt or pdf');
			    		}

			    	}else{
			    		//file was To large
			    		$output = array('error_toolarge'=>'File was To Large! 20MB');
			    	}

			    }else{
			    	//File is Empty Or Broken
			    	$output = array('error_file'=>'File is Empty Or Broken');
			    }



		}else{
			//no academic year detected!
			$output = array('error_acad'=>'no academic year!');
		}




		}else{
			//empty class id
			$output = array('error_class_id'=>'empty class id');
		}

		
			
		
	}else{
		//IDNO not Found! Error!
		$output = array('error_IDNO'=>'IDNO Not FOund!');
	}
}else{
	//assign ID Not Found Error!
	$output = array('error_assID'=>'Assign ID not Found!');
}

echo json_encode($output);
}


#set function 

function getSY(){
  global $mydb;
  $mydb->setQuery("select * from acad_year where STATUS ='YES';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found;
  }else{
    return 0;
  }
}

function addPassModule($ass_id,$IDNO,$acad,$file){
	global $mydb;
	$mydb->setQuery("INSERT INTO pass_module (ASSIGN_ID,IDNO,ACAD_ID,FILE_LOC,UPLOAD_DATE) VALUES('".$ass_id."','".$IDNO."','".$acad."','".$file."',now());");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

function updateAssignModuleStatus($ass_id){
	global $mydb;
	$mydb->setQuery("UPDATE assign_module SET STATUS = 1 WHERE ASSIGN_ID = '".$ass_id."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}


 ?>