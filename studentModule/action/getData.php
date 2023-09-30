<?php
session_start();
require_once("../../include/initialize.php");

if(isset($_POST['MOD_ID'])){

	if(!empty($_POST['MOD_ID'])){
		if(!empty($_POST['IDNO'])){

			$IDNO = $_POST['IDNO'];
			$MOD_ID = $_POST['MOD_ID'];

			#get the data
			$data = getModData($IDNO,$MOD_ID);
			if($data !='0'){

				$posted = date("d M Y",strtotime($data->FILE_IN));
						if($data->DUE=='0000-00-00'){
							$due = 'No Due Date';

						}else{
							$due = date("M d",strtotime($data->DUE));
						}

				$output = array('MOD_ID'=>$data->MOD_ID,
					'ass_id'=>$data->ASSIGN_ID,
					'title'=>$data->FILE_TITLE,
					'due'=>$due,
					'posted'=>$posted,
					'desc'=>$data->FILE_DESC,
					'file_loc'=>$data->FILE_LOC,
					'class_id'=>$data->CLASS_ID

			);
			}else{
				//error
				$output = array('error_no_data'=>'no data!');
			}

		}
	}
	

	echo json_encode($output);
}


function getModData($IDNO,$MOD_ID){
	global $mydb;
	$mydb->setQuery("select ass.ASSIGN_ID,mo.MOD_ID,ass.CLASS_ID,mo.FILE_TITLE,mo.FILE_IN,mo.DUE,mo.FILE_DESC,mo.FILE_LOC from assign_module ass,module mo where ass.MOD_ID = mo.MOD_ID and ass.MOD_ID = '".$MOD_ID."' and ass.IDNO = '".$IDNO."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$found = $mydb->loadSingleResult();
		return $found;
	}else{
		return 0;
	}

}


 ?>