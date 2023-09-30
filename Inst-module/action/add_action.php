<?php
session_start();
require_once("../../include/initialize.php");


// the $_POST 'action' is the attribute name of input element that has value of ADD
if($_POST["action"] == 'ADD'){


	$error = 0;

	$error_title ='';
	
	$error_desc ='';

	if(!empty($_POST['title'])){
		$title = $_POST['title'];
	}else{
		$error_title ='No title';
		$error++;
	}

	if(!empty($_POST['descript'])){
		$desc = $_POST['descript'];
	}else{
		$error_desc = 'No Description!';
		$error++;
	}


//setting all the error into array 
	if($error > 0){
		$output = array(
			'error'=>true,
			'error_title'=>$error_title,
			'error_desc'=>$error_desc
		);

	}else{
		
			//true

			//declaring variable with POST METHOD
			
			$ModType = $_POST['modType'];
			

	/* Getting file name */
   $getfile = $_FILES['moduleFile'];

   //getting the file name and the file size
   $getfileName = $getfile['name'];
   $getfileSize = $getfile['size'];

   //validating the file
   if($getfileSize < 20971520){
   	//true less than 20mb
   
   		

   		//validating the file type
	   	$type = strtolower(pathinfo($getfileName,PATHINFO_EXTENSION));
	   if($type=='docx' OR $type=='ppt' OR $type=='pdf' OR $type=='pptx'){
	   		//true valid file
	   		

			//check if there is academic year in the database that status = ongoing or On process
			if(!empty($_POST['hdd_acad'])){
				$acad = $_POST['hdd_acad'];
				//true 
					$location = "../../myAddFile/";

					$length = 10;
   				   $gen = str_shuffle(str_repeat($x='019abcdjklrstuvwxyz', ceil($length/strlen($x))));

					$addtoname = $gen.date("dmYHis");

					$newfile = $addtoname.str_replace("", "", $getfileName);

					

					global $mydb;
						//creating query to insert into the database table module
						$mydb->setQuery("INSERT INTO module (FILE_LOC, FILE_IN,DUE ,FILE_TYPE, FILE_TITLE, FILE_DESC, ACAD_ID,INST_ID, STATUS) VALUES ('".$newfile."', now(),'".$_POST['due']."' ,'".$ModType."', '".$title."' ,'".$desc."','".$acad."','".$_SESSION['inst_id']."', '0');");

						//executing query using function executeQuery
						$cur = $mydb->executeQuery();

						//checking if the query was inserted then return message
						if($cur){
							//expecting true
							move_uploaded_file($getfile['tmp_name'], $location.$newfile);
							//getting the file size to display in the output message
							$kb = $getfileSize /1000;
							$mb = $kb / 1000;

							$output	=array(
								'success'=>'inserting module success',
								'file_size'=>$mb
							);

						}else{
								// catch for error the query is false
								$ouput = array(
									'error_insertData'=>'System Error!'
							);

						}


				}else{
					//no academic year detected

					$output = array(
						'error_acad'=>'No Academic Year Detected!'
				);

			}

					

	   	}else{
		   		//invalid file
		   		$output= array(
		   			'error_file_invadid'=>'invalid'
		   	);

	   }
   

   	}else{
   		//greater than 20mb

	   		$output = array(
	   			'error_tooLargeFile'=>'The File are too Large it must be less than to 20mb only!'
	   	);

   }


		
}
	

//json script	
echo json_encode($output);

}




?>