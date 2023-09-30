<?php
session_start();
require('../../include/initialize.php');

//displaying instructor details in assign modal form
if(isset($_POST['ID'])){

	if(!empty($_POST['ID'])){
		#lets proceed
		$ID = $_POST['ID'];
		$data = instructor_data($ID);

		if($data){
			//set all the data into json array
			$output = array('ID'=>$data->INST_ID,
				'name'=>$data->FNAME.' '.$data->LNAME

		);
		}
	}
	echo json_encode($output);
}
//displaying data in the edit form modal
if(isset($_POST['edit_id'])){
	if(!empty($_POST['edit_id'])){
		//secondary confirmation
		$inst_id = $_POST['edit_id'];
		#then lets call the object function
		$myData = instructor_data($inst_id);
		if($myData){
			$output = array('inst_id'=>$myData->INST_ID,
				'fname'=>$myData->FNAME,
				'lname'=>$myData->LNAME,
				'uname'=>$myData->USERNAME

		);
		}
	}


	echo json_encode($output);
}


//display in view modal
if(isset($_POST['view_id'])){
	if(!empty($_POST['view_id'])){
		$ID2 = $_POST['view_id'];
		#call the object function
		$data2 = instructor_data($ID2);
		if($data2){
			$res = $data2->FNAME.' '.$data2->LNAME;
		}
		?>
		 <div class="form-group">
         	 <label for="">Instructor Name : </label>
          	 <input type="text" class="form-control" value="<?php echo $res; ?>" readonly="">
       	</div> 

		<?php

		echo '<div class="form-group"> ';
		echo ' <ul class="list-group">';
		echo '<li class="list-group-item list-group-item-dark">CLASS</li>';
		$i = 1;
		$class_data = getAssignClass($ID2);
		foreach ($class_data as $row) {
			#lets loop the data and put it in the list
			?>				 
				     
				    <li class="list-group-item"><?php echo $i.'. '.$row['CLASS_NAME']; ?></li>
				    
				
			<?php
		$i++; }
		echo ' </ul>';
		echo '</div>';
		echo ' <div class="modal-footer">
                    <button type="button" class="btn btn-default btn btn-secondary" data-dismiss="modal">
                      Close
                      <span class="glyphicon glyphicon-remove-sign"></span>
                    </button>
                   
                  </div>
                 ';
	}

}

#set all the function to be use
function instructor_data($ID){
	global $mydb;
	$mydb->setQuery("select * from instructor where INST_ID = '".$ID."';");
	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

function getAssignClass($inst_id){
	global $mydb;
	$mydb->setQuery("select * from class where INST_ID = '".$inst_id."';");
	$cur = $mydb->executeQuery();
	if($cur){
		return $cur;
	}else{
		return 0;
	}
}


 ?>