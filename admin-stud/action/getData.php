<?php
session_start();
require('../../include/initialize.php');

if(isset($_POST['edit'])){

	if(!empty($_POST['edit'])){
		$IDNO = $_POST['edit'];

		$data = getData($IDNO);
		if($data){
			//true
			$output = array('ID'=>$data->IDNO,
				'fname'=>$data->FNAME,
				'lname'=>$data->LNAME,
				'gender'=>$data->GENDER,
				'address'=>$data->ADDRESS,
				'bday'=>$data->BDAY,
				'contact'=>$data->CONTACT
		);
		}else{
			//error
			$output = array('error_query'=>'query for getting data from the database return error!');
		}
	}

	echo json_encode($output);
}


if(isset($_POST['viewP'])){

	if(!empty($_POST['viewP'])){
		$get_IDNO = $_POST['viewP'];
		$res_data = getPassImpKey($get_IDNO);

		if($res_data !='0'){

			?>

			 <div class="form-group">
               <div class="form-row">
                      <div class="col-md">
                  <label  for="">IDNO: </label>
                  <input type="text" class="form-control" name="" value="<?php echo $res_data->IDNO; ?>" readonly="" placeholder="IDNO" id="showIDNO">
                 
                  </div>
                </div>
              </div>


            <div class="form-group">
               <div class="form-row">
                      <div class="col-md">
                  <label  for="">Password: </label>
                  <input type="text" class="form-control" name="" value="<?php echo $res_data->PASSWORD; ?>" placeholder="password" id="showPass" readonly="">
                  
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="form-row">
                      <div class="col-md">
                  <label  for="">Recovery Key: </label>
                  <input type="text" class="form-control" name="" placeholder="Key" id="showPass" readonly="">
                  
                  </div>
                </div>
              </div>





			<?php


		}


	}


}

if(isset($_POST['viewG'])){
	
	if(!empty($_POST['viewG'])){
		$enroll_id = $_POST['viewG'];

		$data_G = getGrades($enroll_id);
		if($data_G !='0'){
			?>

			<input type="hidden" name="hdd_enroll_id" id="hdd_enroll_id" value="<?php echo $data_G->ENROLL_ID; ?>">
			 <div class="form-group">
               <div class="form-row">
                      <div class="col-md">
                  <label  for=""><b>NAME:</b> </label>
                  <input type="text" class="form-control" name="" value="<?php echo $data_G->name;  ?>" readonly="" placeholder="Name">
                 
                  </div>
                </div>
              </div>
             
              <div class="form-group">
               <div class="form-row">
                    <div class="col-md">  
                     <label  for=""><b>SEMESTER: </b></label>                                 
                       <input type="text" class="form-control" name="" value="<?php echo $data_G->SEMESTER;  ?>" readonly="" placeholder="SEMESTER">                
                    </div>
                    <div class="col-md">    
                     <label  for=""><b>SCHOOL YEAR: </b></label>                               
                       <input type="text" class="form-control" name="" value="<?php echo $data_G->SCHOOL_YEAR; ?>" readonly="" placeholder="SCHOOL YEAR">                
                    </div>

                </div>
              </div>

              <label  for=""><b>GRADES: </b></label>

              <button class="btn btn-sm btn-warning fa fa-edit" id="btn_enable"> Enable Editing</button>
              <button class="btn btn-sm btn-danger fa fa-cancel" id="btn_disabled" style="display: none;"> Cancel Editing</button>

               <div class="form-group">
               <div class="form-row">
                  <div class="col-md"> 
                  <label> MID TERM : </label>                                 
                     <input type="number" class="form-control" min="75" max="100" name="md" id="md" value="<?php echo $data_G->MID_TERM;  ?>" readonly="" placeholder="MID TERM">                
                  </div>
                   <div class="col-md"> 
                   <label>END TERM : </label>                                  
                     <input type="number" class="form-control" min="75" max="100" name="end" id="end" value="<?php echo $data_G->END_TERM; ?>" readonly="" placeholder="END TERM">                
                  </div>
                   <div class="col-md"> 
                   <label>FINAL :</label>                                  
                     <input type="number" class="form-control"  name="fn" id="fn" value="<?php echo $data_G->FINAL; ?>" readonly="" placeholder="FINAL">                
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="form-row">
                    <div class="col-md">  
                     <label  for=""><b>STATUS:</b> </label>                                 
                       <input type="text" class="form-control" name="" value="<?php echo $data_G->REMARKS; ?>" readonly="" placeholder="STATUS">                
                    </div>
                    
                </div>
              </div>




			<?php

		}
	}


}


#function we will use
function getData($IDNO){
	global $mydb;
	$mydb->setQuery("select s.IDNO,s.FNAME,s.LNAME,st.GENDER,st.ADDRESS,st.CONTACT,st.BDAY from students s,stud_details st where s.IDNO = st.IDNO and st.IDNO = '".$IDNO."';");
	$cur = $mydb->loadSingleResult();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

function getPassImpKey($IDNO){
	global $mydb;
	$mydb->setQuery("select IDNO,PASSWORD from students where IDNO = '".$IDNO."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$found = $mydb->loadSingleResult();
		return $found;
	}else{
		return 0;
	}
}

function getGrades($enroll_id){
	global $mydb;
	$mydb->setQuery("select en.ENROLL_ID,concat(s.FNAME,' ',s.LNAME) name,ac.SEMESTER,ac.SCHOOL_YEAR,gr.MID_TERM,gr.END_TERM,gr.FINAL,gr.REMARKS from enrollees en,grades gr,students s, acad_year ac where en.ENROLL_ID = gr.ENROLL_ID and en.IDNO = s.IDNO and en.ACAD_ID = ac.ACAD_ID and en.ENROLL_ID = '".$enroll_id."';");
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