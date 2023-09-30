<?php

session_start();

require_once("../../include/initialize.php");


	if($_POST["action"] == "Add")
	{
		$attendance_date = '';
		$error_attendance_date = '';
		$error = 0;
		if(empty($_POST["attendance_date"]))
		{
			//if Null
			$error_attendance_date = 'Attendance Date is required';
			$error++;
		}
		else
		{

			//else get the value
			$attendance_date = $_POST["attendance_date"];
		}

		if($error > 0)
		{
			//setting the error 0 for the attendance
			$output = array(
				'error'							=>	true,
				'error_attendance_date'			=>	$error_attendance_date
			);
		}
		else
		{
			global $mydb;
						
			#check if the student id is not empty
			if(!empty($_POST['student_id'])){

				$student_IDNO = $_POST['student_id'];

				#check if have default school year
				$data_acad = getSY();

				if($data_acad !='0'){
					$acad = $data_acad->ACAD_ID;



				// //then we will count the id to insert all the data in it in the database tingob
				for($count = 0; $count < count($student_IDNO); $count++)
				{
					//we store the data into array form
					$data = array(
						'sched_CLASS_ID'=>	$attendance_date,
						'IDNO'			=>	$student_IDNO[$count],
						'ACAD_ID'		=>	$acad,
						'STATUS'	=>	$_POST["attendance_status".$student_IDNO[$count].""]						
						
					);


					$mydb->setQuery("INSERT INTO attendance 
					(CLASS_SCHED_ID, IDNO, ACAD_ID, STATUS) 
					VALUES ('".$data['sched_CLASS_ID']."', '".$data['IDNO']."', '".$data['ACAD_ID']."','".$data['STATUS']."')
					;");


					$mydb->executeQuery();

				
				}				
					#then lets update the class sched STATUS into DONE	
					$mydb->setQuery("UPDATE class_sched SET STATUS='DONE' WHERE  CLASS_SCHED_ID='".$attendance_date."';");

					$cur = $mydb->executeQuery();

					if($cur){
								//if the data is successfully! inserted it will return success message
						$output = array(
							'success'		=>	'Data Added Successfully',
						);
					}else{
						//return false error inserting
						$output = array('err_up_class_sched_status'=>'Error');

					}			

				}else{
					//no academic year detected
					$output = array('err_sy'=>'no academic year');
				}

			}else{
				//empty student id no  data
				$output = array('err_no_stud_data'=>'no student data');
			}
			


			
		}
		echo json_encode($output);
	}


//algo for editing student attendance
	if($_POST['action'] == 'edit_att'){

		#check if not empty the attendance ID
		if(!empty($_POST['ATT_ID'])){
			$att_id = $_POST['ATT_ID'];
			$status = $_POST['status'];

			$isUpdate = editAtt($att_id,$status);
			if($isUpdate == '1'){
				//return true
				$output = array('success'=>'update success');
			}else{
				//return false;
				$output = array('err_update'=>'update error');
			}
		}else{
			//empty att id
			$output = array('err_empty_att_id'=>'empty');
		}


		echo json_encode($output);
	}



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

function editAtt($att_id,$status){
	global $mydb;
	$mydb->setQuery("UPDATE attendance SET STATUS = '".$status."' WHERE ATT_ID = '".$att_id."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return 1;
	}else{
		return 0;
	}
}

 ?>