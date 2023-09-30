<?php
session_start();
require_once("../../include/initialize.php");

//this code is for updating newly added or not already assigned module
if($_POST['action']== 'updateModule'){
	$error = 0;
	$error_title = '';
	$error_desc = '';

	if(!empty($_POST['EditTitle'])){
		$TITLE = $_POST['EditTitle'];
	}else{
		$error++;
		$error_title = 'Input Field is Required!';
	}

	if(!empty($_POST['Editdescript'])){
		$description = $_POST['Editdescript'];
	}else{
		$error++;
		$error_desc = 'Input Field is Required!';
	}

	if($error > 0){
		#set all the error into array
		$output = array('error'=>true,
			'error_title'=>$error_title,
			'error_description'=> $error_desc

	);

	}else{

		if(!empty($_POST['hiddenMOD_ID'])){
			//empty:: update Module Details Only
				$MOD_ID = $_POST['hiddenMOD_ID'];
				$due_date = $_POST['Editdue'];
				$edit_MOD_TYPE = $_POST['editmodType'];

			if($_FILES['editNewFile']['name']=='' && $_FILES['editNewFile']['size'] ==0){
			
				$res = editDetails($MOD_ID,$TITLE,$description,$edit_MOD_TYPE,$due_date);

					if($res==1){
						//true
						$output = array('success'=>'updating details success');
					}else{
						//error in executing Query 
						$output = array('error_query'=>'Edit Module Details Query Failed');
					}


			}else{
				//Not Empty::when the user change the current File
				#get the New File
				/* Getting file name */
				   $getfile = $_FILES['editNewFile'];

				   //getting the file name and the file size
				   $getfileName = $getfile['name'];
				   $getfileSize = $getfile['size'];

				    if($getfileSize < 20971520){
				    	//Limit File into 20MB only or less
				    	//get the file extension for validating
				    	$type = strtolower(pathinfo($getfileName,PATHINFO_EXTENSION));
				    	 if($type=='docx' OR $type=='ppt' OR $type=='pdf' OR $type=='pptx' OR $type=='xls'){
				    	 	//valid File
				    	 	#set the location of file after changing it
				    	 	$location = "../../myAddFile/";

				    	 	#check if the hidden current file is not empty
				    	 	if(!empty($_POST['hiddenFile'])){
				    	 		//true not Empty:: it will use to unlink in the folder
				    	 		$currentFile = $_POST['hiddenFile'];

				    	 		//random char
				    	 		$length = 10;
   				   $gen = str_shuffle(str_repeat($x='012789qrstuvwxyz', ceil($length/strlen($x))));

								$addtoname = $gen.date("dmYHis");

								$newfile = $addtoname.str_replace("", "", $getfileName);

								//called the function
							$res2 = editDetailsWithNewFile($MOD_ID,$TITLE,$description,$due_date,$newfile,$edit_MOD_TYPE);
								if($res2==1){
									//true
									//move the new file in the Folder location
									move_uploaded_file($getfile['tmp_name'], $location.$newfile);

									//then the curren file will unlink in the folder
									unlink("../../myAddFile/".$currentFile);
									$output = array('success'=>'success Module FIle Updated');

								}else{
									//false
									$output = array('error_query2'=>'updating New File Query is Failed!');

								}


				    	 	}else{
				    	 		//hidden file Not Found!
				    	 		$output = array('error_hidden_file'=>'hidden File Not Found!');
				    	 	}

				    	 }else{
				    	 	//file is not valid
				    	 	$output = array('error_file'=>'Invalid File!');
				    	 }


				    }else{
				    	//greater than 20MB
				    	$output = array('error_file_large'=>'The File was to Large!');
				    }
				
			}

		}else{
			//empty MODULE ID
			$output = array('error_MOD_ID'=>'MOD ID is Empty');
		}


		
	}


echo json_encode($output);
}


//done module updating
if($_POST['action']=='updateDoneModule'){

	$error = 0;
	$error_title2 = '';
	$error_desc2 = '';

	if(!empty($_POST['EditTitle2'])){
		$TITLE2 = $_POST['EditTitle2'];
	}else{
		$error++;
		$error_title2 = 'Input Field is Required!';
	}

	if(!empty($_POST['Editdescript2'])){
		$DESC2 = $_POST['Editdescript2'];
	}else{
		$error++;
		$error_desc2 = 'Input Field is Required!';
	}

	if($error > 0){
		//true
		#set erro into array
		$output = array(
			'error'=>true,
			'error_title2'=>$error_title2,
			'error_desc2'=>$error_desc2
		);
	}else{
		#No Errors in Input Field

		#get all the important Value
		if(!empty($_POST['done_mod_id'])){
			//true
			#declare all important variable
			$MD_ID = $_POST['done_mod_id'];
			$MD_DUE = $_POST['Editdue2'];
			$MD_TYPE = $_POST['editmodType2'];

			

			if($_FILES['editNewFile2']['name']=='' && $_FILES['editNewFile2']['size'] ==0){

				//No New Files Detected! Only Details to be updated!
					$res2 = editDetails($MD_ID,$TITLE2,$DESC2,$MD_TYPE,$MD_DUE);
					if($res2==1){
						//true
						$output = array('success'=>'success updating already assign module');
					}else{
						//return false
						$output = array('error_queryMD1'=>'Query already assign Module Failed!');
					}
				
			}else{
				//New Files Detected! Changing Files and Details

				/* Getting file name */
				   $getfile2 = $_FILES['editNewFile2'];

				   //getting the file name and the file size
				   $getfileName2 = $getfile2['name'];
				   $getfileSize2 = $getfile2['size'];

				   if($getfileSize2 < 20971520){
				   		//valid File
				   	//get the file extension for validating
				    	$type2 = strtolower(pathinfo($getfileName2,PATHINFO_EXTENSION));
				    	 if($type2=='docx' OR $type2=='ppt' OR $type2=='pdf' OR $type2=='pptx' OR $type2=='xls'){
				    	 	//valid file to upload

				    	 	#set the location of file after changing it
				    	 $location2 = "../../myAddFile/";
				    	 #check if the hidden current file is not empty
				    	 	if(!empty($_POST['hiddenFile2'])){
				    	 		//true
				    	 		#it use to remove the current file in the MyAddFile Folder
				    	 		
				    	 		$currentFile2 = $_POST['hiddenFile2'];

				    	 		$length = 10;
   			 $Codegenerator = str_shuffle(str_repeat($x='01-78-9abcdefghijk', ceil($length/strlen($x))));

								$addtoname2 = $Codegenerator.date("dmYHis");

								$newfile2 = $addtoname2.str_replace("", "", $getfileName2);

							$result = editDetailsWithNewFile($MD_ID,$TITLE2,$DESC2,$MD_DUE,$newfile2,$MD_TYPE);

								if($result){
									//success

									//move the new file in the Folder location
									move_uploaded_file($getfile2['tmp_name'], $location2.$newfile2);
									//then the curren file will unlink in the folder
									unlink("../../myAddFile/".$currentFile2);

									$output = array('success'=>'success updating already assign module');
								}else{
									//return false:: Error!
									$output = array('error_queryMD2'=>'Error Query:: for uploading New File and New Details');
								}	


				    	 	}else{
				    	 		//hidden File Not Found!
				    	 		
				    	 		$output = array('error_hiddenFile_MD'=>'hidden File Not Found!');
				    	 	}

				    	 }else{
				    	 	//file is invalid not in Docx format etc
				    	 	$output = array('error_file_invalid'=>'file must be docx OR ppt OR pdf');
				    	 }

				   		
				   }else{
				   		//file was too large: 20MB maximum size only!
				   	$output = array('error_file_large'=>'The Input File Was too Large!');
				   }
				
			}


		}else{
			// Module ID not Found!
			$output = array('error_MD_ID'=>'Module ID not Found!');
		}

		
	}


	echo json_encode($output);
}




//this function will only Edit the Details of the Module selected
function editDetails($MOD_ID,$TITLE,$DESCRIPT,$TYPE,$DUE){
	global $mydb;

	$mydb->setQuery("UPDATE module SET FILE_TITLE='".$TITLE."',FILE_DESC='".$DESCRIPT."',DUE='".$DUE."',FILE_TYPE='".$TYPE."' WHERE  MOD_ID='".$MOD_ID."';");

	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}


//this function will edit Modune and Insert New File in the databasE!
function editDetailsWithNewFile($MOD_ID,$FILE_TITLE,$FILE_DESC,$DUE_DATE,$FILE_LOC,$FILE_TYPE){
	global $mydb;

	$mydb->setQuery("UPDATE module SET FILE_TITLE='".$FILE_TITLE."',FILE_DESC='".$FILE_DESC."',DUE='".$DUE_DATE."',FILE_LOC='".$FILE_LOC."',FILE_TYPE='".$FILE_TYPE."' WHERE MOD_ID ='".$MOD_ID."';");

	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}


 ?>