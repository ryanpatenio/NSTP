<?php
session_start();
require('../../include/initialize.php');

if(isset($_POST['md_id'])){
	if(!empty($_POST['md_id'])){

		$mod_id = $_POST['md_id'];

		$data = getModuleData($mod_id);

		if($data !='0'){
			$output = array('mod_id'=>$data->MOD_ID,
				'file_loc'=>$data->FILE_LOC,
				'title'=>$data->FILE_TITLE,
				'desc'=>$data->FILE_DESC,
				'due'=>$data->DUE,
				'type'=>$data->FILE_TYPE

		);
		}else{
			//no data : error query
			$output = array('err_getting_data'=>'error');
		}


		echo json_encode($output);


	}
}


//for edit done modal
if(isset($_POST['mod_done_id'])){
	if(!empty($_POST['mod_done_id'])){

		$mod_id2 = $_POST['mod_done_id'];
		$data2 = getModuleData($mod_id2);
		if($data2 !='0'){
			$output = array('mod_id2'=>$data2->MOD_ID,
				'file_loc2'=>$data2->FILE_LOC,
				'title2'=>$data2->FILE_TITLE,
				'desc2'=>$data2->FILE_DESC,
				'due2'=>$data2->DUE,
				'type2'=>$data2->FILE_TYPE

		);
		}

	}
	echo json_encode($output);
}


if(isset($_POST['m_id'])){
	if(!empty($_POST['m_id'])){

		$m_id = $_POST['m_id'];
		$s_data = getModuleData($m_id);
		if($s_data !='0'){
			$output = array('m_id'=>$s_data->MOD_ID,
				'title'=>$s_data->FILE_TITLE
		);
		}else{
			$output = array('err_get_m_data'=>'query return false');
		}


	}
	echo json_encode($output);
}

if(isset($_POST['vh_mod_id'])){
	if(!empty($_POST['vh_mod_id'])){

		$vh_mod_id = $_POST['vh_mod_id'];
		$viewData = getViewData($vh_mod_id);

		$data_name = getModuleData($vh_mod_id);
		if($data_name !='0'){
			echo '<div class="form-group">
           <label for="">TITLE : </label>
             <input type="text" class="form-control" value="'.$data_name->FILE_TITLE.'" readonly="">
        </div> ';
			
	
		}



		if($viewData !='0'){
			//return true
			echo ' <div class="form-group">
              <ul class="list-group">
                  <li class="list-group-item list-group-item-dark">CLASS ASSIGNED</li>';

			$i = 1;
			foreach ($viewData as $datarow) {
				# code...
				echo '
				 <li class="list-group-item">'.$i.' '.$datarow['CLASS_NAME'].'</li>
				';
			$i++; }

			echo '</ul>
            </div>';
		}else{
			//return false
			echo '<li class="list-group-item">No Class</li>';
		}

	}
}



#set all function to be used
function getModuleData($id){
	global $mydb;
	$mydb->setQuery("select * from module WHERE MOD_ID = '".$id."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$found = $mydb->loadSingleResult();
		return $found;
	}else{
		return 0;
	}
}

function getViewData($mod_id){
	global $mydb;
	$mydb->setQuery("select distinct(cl.CLASS_NAME) from assign_module ass,class cl where ass.CLASS_ID = cl.CLASS_ID and ass.MOD_ID = '".$mod_id."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		
		return $cur;
	}else{
		return 0;
	}
}

 ?>