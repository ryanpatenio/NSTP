<?php

include('../student-asset/header.php');
include('../student-asset/sidebar.php');

?>
 <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">GRADES</h4>
        </ol>

<div class="row">


<?php

$first_sem_data = getFirstSem($IDNO);
if($first_sem_data !='0'){
	//true have data!
?>
	
	<div class="col-lg-6">
  <div class="card mb-3">
   <div class="card-header">
  
        <div class="card-body">
          <div class="card mb-3">
          
          <div class="card-body">


          <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">School Year: </label>

                  <input class="form-control input-sm" id="sy" readonly name="sy" placeholder=
                      "School Year" type="text" value="<?php  echo $first_sem_data->SCHOOL_YEAR; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">Semester: </label>

                  <input class="form-control input-sm" id="sem" readonly name="sem" placeholder=
                      "Semester" type="text" value="<?php echo $first_sem_data->SEMESTER ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">FINAL GRADES: </label>

                  <input class="form-control input-sm"  id="fin" readonly name="fin" placeholder=
                      "Final" type="text" value="<?php echo $first_sem_data->FINAL ?>">
                </div>
              </div>
            </div>

            <?php 

            #settle the color and status
            if($first_sem_data->REMARKS =='PASSED'){
            	$color = 'green';
            	$remarks = 'PASSED';
            }else if($first_sem_data->REMARKS=='INC'){
            	$color = 'red';
            	$remarks = 'INC';
            }else if($first_sem_data->REMARKS == 'DROP'){
            	$color = 'red';
            	$remarks = 'DROP';
            }else if($first_sem_data->REMARKS == 'not good'){
            	$color = 'blue';
            	$remarks = 'Pending...';
            }else{
            	$color = 'red';
            	$remarks = 'error 10029';
            }

            ?>



            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">REMARKS: </label>

                  <input class="form-control input-sm"  id="fin" readonly name="fin" placeholder=
                      "Remarks" type="text" value="<?php echo $remarks; ?>" style="color:<?php echo $color; ?>;">
                </div>
              </div>
            </div>

      
          </div>
          
        </div>

       </div>
     </div>
   </div>
</div>


<?php

}else{
//have no already data

include('empty/first.php');
}


 ?>	





<!----------------------- Second Semester------------------------------->


<!---------- check if have already data in second sem    ------------->

<?php

$second_sem_data = getSecondSem($IDNO);

if($second_sem_data !='0'){
	//true have data
?>


<div class="col-lg-6">
  <div class="card mb-3">
   <div class="card-header">
   
        <div class="card-body">
          <div class="card mb-3">
          
          <div class="card-body">


          <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">School Year: </label>

                  <input class="form-control input-sm" id="sy" readonly name="sy" placeholder=
                      "School Year" type="text" value="<?php  echo $second_sem_data->SCHOOL_YEAR; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">Semester: </label>

                  <input class="form-control input-sm" id="sem" readonly name="sem" placeholder=
                      "Semester" type="text" value="<?php echo $second_sem_data->SEMESTER ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">FINAL GRADES: </label>

                  <input class="form-control input-sm"  id="fin" readonly name="fin" placeholder=
                      "Final" type="text" value="<?php echo $second_sem_data->FINAL ?>">
                </div>
              </div>
            </div>

			<?php
			#settle the color and status
            if($second_sem_data->REMARKS =='PASSED'){
            	$color2 = 'green';
            	$remarks2 = 'PASSED';
            }else if($second_sem_data->REMARKS=='INC'){
            	$color2 = 'red';
            	$remarks2 = 'INC';
            }else if($second_sem_data->REMARKS == 'DROP'){
            	$color2 = 'red';
            	$remarks2 = 'DROP';
            }else if($second_sem_data->REMARKS == 'not good'){
            	$color2 = 'blue';
            	$remarks2 = 'Pending...';
            }else{
            	$color2 = 'red';
            	$remarks2 = 'error 10029';
            }


			 ?>


            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">REMARKS: </label>

                  <input class="form-control input-sm"  id="fin" readonly name="fin" placeholder=
                      "Remarks" type="text" value="<?php echo $remarks2; ?>" style="color:<?php echo $color2; ?>;">
                </div>
              </div>
            </div>

      
          </div>
          
        </div>

       </div>
     </div>
   </div>
</div>



<?php

}else{
	//false not already have data
	include('empty/second.php');


}



 ?>



<!-----------end of div class row------------->
</div>



<?php

include('../student-asset/footer.php');
include('../student-asset/script.php');


#set function
function getFirstSem($IDNO){
	global $mydb;
	$mydb->setQuery("select grd.GRD_ID,grd.MID_TERM,grd.END_TERM,grd.FINAL,grd.REMARKS,ac.SCHOOL_YEAR,ac.SEMESTER from grades grd,acad_year ac where grd.ACAD_ID = ac.ACAD_ID and ac.SEMESTER = 'FIRST' and grd.IDNO = '".$IDNO."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$found = $mydb->loadSingleResult();
		return $found;
	}else{
		return 0;
	}
}

function getSecondSem($IDNO){
	global $mydb;
	$mydb->setQuery("select grd.GRD_ID,grd.MID_TERM,grd.END_TERM,grd.FINAL,grd.REMARKS,ac.SCHOOL_YEAR,ac.SEMESTER from grades grd,acad_year ac where grd.ACAD_ID = ac.ACAD_ID and ac.SEMESTER = 'SECOND' and grd.IDNO = '".$IDNO."';");
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