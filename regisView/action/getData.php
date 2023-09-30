<?php 
session_start();
require_once('../../include/initialize.php');

if(isset($_POST['live_table'])){

  if(!empty($_POST['live_table'])){
    if(!empty($_POST['sm'])){


    $sy = $_POST['live_table'];
    $sem = $_POST['sm'];


    $data = getStudent($sy,$sem);

    foreach ($data as $res) {
      # code...

      echo '<tr>';

        echo '<td>'.$res['IDNO'].'</td>';
        echo '<td>'.$res['name'].'</td>';
        echo '<td>'.$res['SCHOOL_YEAR'].'</td>';
        echo '<td>'.$res['SEMESTER'].'</td>';

        echo '<td>

        <a href="view.php?IDNO='.$res['IDNO'].'" class="btn btn-sm btn-warning"><i class="fa fa-search"> View</i>


        </td>';


      echo '</tr>';


    }

  


    }else{
      //empty semester
      echo 'empty semester';
    }
  }else{
    //empty year
    echo 'empty year';
  }
// echo 'wala';

}


//for event listener of school year
if(isset($_POST['fetching2'])){

	if(!empty($_POST['fetching2'])){

		if(!empty($_POST['sm3'])){


			$yr3 = $_POST['fetching2'];
			$sm3 = $_POST['sm3'];

			$data3 = getStudent($yr3,$sm3);

		foreach ($data3 as $row2) {
			# code...

			echo '<tr>';

				echo '<td>'.$row2['IDNO'].'</td>';
				echo '<td>'.$row2['name'].'</td>';
				echo '<td>'.$row2['SCHOOL_YEAR'].'</td>';
				echo '<td>'.$row2['SEMESTER'].'</td>';

				echo '<td>

				<a href="view.php?IDNO='.$row2['IDNO'].'" class="btn btn-sm btn-warning"><i class="fa fa-search"> View</i>


				</td>';


			echo '</tr>';


		}

		}
	}


}

//event listener for semester drop down
if(isset($_POST['fetching'])){

	if(!empty($_POST['fetching'])){

		if(!empty($_POST['sm2'])){


			$yr2 = $_POST['fetching'];
			$sm2 = $_POST['sm2'];

			$data2 = getStudent($yr2,$sm2);

		foreach ($data2 as $row) {
			# code...

			echo '<tr>';

				echo '<td>'.$row['IDNO'].'</td>';
				echo '<td>'.$row['name'].'</td>';
				echo '<td>'.$row['SCHOOL_YEAR'].'</td>';
				echo '<td>'.$row['SEMESTER'].'</td>';

				echo '<td>

				<a href="view.php?IDNO='.$row['IDNO'].'" class="btn btn-sm btn-warning"><i class="fa fa-search"> View</i>


				</td>';


			echo '</tr>';


		}

		}
	}


}


//for viewing grades
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




function getStudent($year,$sem){
	global $mydb;
	$mydb->setQuery("select en.IDNO,concat(s.FNAME,' ',s.LNAME) as 'name',ac.SCHOOL_YEAR,ac.SEMESTER from enrollees en,acad_year ac,students s where en.ACAD_ID = ac.ACAD_ID and en.IDNO = s.IDNO and ac.SCHOOL_YEAR = '".$year."' and ac.SEMESTER = '".$sem."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
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