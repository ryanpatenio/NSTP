<?php

session_start();
require_once("../include/initialize.php");


if(isset($_POST['IDNO'])){
	#setting all the error

	$error = 0;
	$error_fname ='';
	
	$error_bday = '';
	$error_gender = '';
	$error_address = '';
	$error_contact = '';

	if(!empty($_POST['fname'])){
		$fname = $_POST['fname'];
	}else{
		$error_fname = 'Input Field is Required!';
		$error++;
	}


	if(!empty($_POST['bday'])){
		$bday = $_POST['bday'];
	}else{
		$error_bday='Input Field is Required!';
		$error++;
	}

	if(!empty($_POST['gender'])){
		$gender = $_POST['gender'];
	}else{
		$error_gender='Input Field is Required!';
		$error++;
	}

	if(!empty($_POST['address'])){
		$address = $_POST['address'];
	}else{
		$error_address = 'Input Field is Required!';
		$error++;
	}

	if(!empty($_POST['contact'])){
		$contact = $_POST['contact'];
	}else{
		$error_contact = 'Input Field is Required!';
		$error++;
	}

	if($error > 0){
		//true
		$output = array(
			'error'=>true,
			'error_fname' => $error_fname,
			
			'error_bday' => $error_bday,
			'error_gender' => $error_gender,
			'error_address' => $error_address,
			'error_contact' => $error_contact

		);
	}else{
		// false no Error!
		// $output = array(
		// 	'success'=>'success'
		// );

		$IDNO = $_POST['IDNO'];
		$STUD_ID = $_POST['STUD_ID'];

		$NSTP_ID = $_POST['NSTP_COURSE'];
		$CYS = $_POST['cys'];


		$hiddenSECT_ID = $_POST['hiddenSECT_ID'];
		$hiddenNSTP_ID = $_POST['hiddenNSTP_ID'];

		//declaring all method to use
		$rotcData = new adminRotc();
		$dataChecker = new check();

		if($hiddenNSTP_ID!=$NSTP_ID || $hiddenSECT_ID!=$CYS){
			//theres changes in section lets check if the student have already existed grades
			$data = $dataChecker->getDataGradesCheck($IDNO);

			$mid = $data->MID_TERM;
			$final = $data->FINAL;
			$end = $data->END_TERM;

			$mid2 = $data->MID_TERM2;
			$end2 = $data->END_TERM2;
			$final2 = $data->FINAL2;

			if(!empty($mid) || !empty($final) || !empty($end) || !empty($mid2) || !empty($end2) || !empty($final2)){
				//student Grades Not Null, This Student Have already Data return info message
				$output = array(
					'error_HaveData'=>'Student Have already Data'
				);

			}else{
				//student have no data yet

				//update function for students table
				$upStud = $rotcData->updateStudentTbl($STUD_ID,$CYS,$fname);
				if($upStud){
					//expecting true

					// update function for student details table
				$upStud_details = $rotcData->updateStu_details($IDNO,$bday,$gender,$address,$contact);

					if($upStud_details){
						//expecting true

						$output = array(
							'success'=>'success'
						);
					}else{
						//error
						$output = array(
							'error_query2'=>'Query 2 Not Executed return False'
						);
					}

				}else{
					//error
					$output = array(
						'error_query1'=>'Query 1 Not Executed Return False'
					);
				}
			}
			
		}else{
			//theres is no changes: only student Details, not the sections or NSTP PROGRAM  can be change or edit

			//update function for students table
			$upStud2 = $rotcData->updateStudentTbl($STUD_ID,$CYS,$fname);
			if($upStud2){
				//expecting true

				// update function for student details table
				$upStud_details2 = $rotcData->updateStu_details($IDNO,$bday,$gender,$address,$contact);
				if($upStud_details2){
					//expecting true

						$output = array(
							'success'=>'success'
						);
				}else{
					//error
					$output = array(
							'error_query21'=>'Query 2 Not Executed return False'
						);
				}
			}else{
				//error!
				$output = array(
							'error_query12'=>'Query 2 Not Executed return False'
							
						);
			}
			
		}


	}
//then return JSON ouput array 
echo json_encode($output);
}


 ?>