<?php

session_start();

require_once("../../include/initialize.php");

if($_POST['action'] == 'assignModule'){
	
	if(!empty($_POST['hdd_id_mod'])){
		if(!empty($_POST['ass_acad'])){
			

				if(!empty($_POST['class_id'])){


					#set all the Important value into new Variable Name
					$MODI_ID = $_POST['hdd_id_mod'];
					$ACAD_ID = $_POST['ass_acad'];
					

					#important array Variable
					$CLASS_ID = $_POST['class_id'];

					foreach ($_POST['class_id'] as $class) {
						global $mydb;
						$counter = count($_POST['class_id']);

							for($x = 0;$x < $counter;$x++){

							//this query will search in the database table students in their different class sections
							$mydb->setQuery("select * from enrollees where ACAD_ID = '".$ACAD_ID."' and R_STATUS not in('DROP','INC','DONE') and CLASS_ID ='".$class."';");

							$cur = $mydb->executeQuery();
							$num_row = $mydb->num_rows($cur);
								
							}



							if($num_row > 0){
								//for each data result in the query above it will transfer into new Variable name $row
							foreach ($cur as $row) {
								//after executing the query above that search query The DATA IDNO of the students will fetch and will be stored in this Array
								$data = array(
									'IDNO'		=>	$row['IDNO']

								);

								//this query will assign Module :: all the students and different class
								$mydb->setQuery("INSERT INTO assign_module (IDNO,MOD_ID,CLASS_ID,ACAD_ID,STATUS) VALUES('".$data['IDNO']."','".$MODI_ID."','".$class."','".$ACAD_ID."','0')");
								$cur1 = $mydb->executeQuery();

								if($cur1){
									//true

									
									//after Inserting Multiple Data in the Assign Module The File Module Status will be updated into Status 1 it means it already assigned.
									$mydb->setQuery("UPDATE module SET STATUS = '1' WHERE MOD_ID = '".$MODI_ID."';");
									$cur2 = $mydb->executeQuery();

										if($cur2){
											//true
											$_SESSION['true']='tuod';	
											//msgBox("Successfully Assigned Module");
											$output = array('success'=>'success');

											}else{
												//false
												//msgBox("Failed To Insert Data! Please Contact Administrator!");
												
												$output = array('error_query2'=>'error Query Number 2');
												
												}
									

								}else{
									//false
										//msgBox("Failed To Insert Data! Please Contact Administrator!");
									
									$output = array('error_query1'=>'Query 1 Error');
										
								}
							
								
							}
						}					


					}

					if(isset($_SESSION['true'])){
							//true
						}else{
							
							$output = array('error_class_NoData'=>'Class Selected Has No Data!');
						  	
						}
						unset($_SESSION['true']);

				}else{
					$output = array('error_class_id'=>'Empty Class ID');					
				}
			
		}else{
			$output = array('error_ACAD'=> 'Empty ACAD ID');
		}
	}else{
		$output = array('error_mod_ID'=>'Empty MODULE ID');
	}
echo json_encode($output);
}

 ?>