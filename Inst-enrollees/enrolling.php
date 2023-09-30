<?php 
include('../instructor-asset/header.php');
include('../inst-inside/sidebar-inside/sidebar.php');


?>

<div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">ADD ENROLLMENT</h4>
        </ol>

<div class="row">
<?php


if(isset($_GET['IDNO'])){ 
$get_IDNO = $_GET['IDNO'];
$set_class_id = $_GET['id'];
$res = getStudentData($get_IDNO);

if($res !='0'){

  ?>

  <div class="col-md-3">
  <img id="curImg" name="curImg" style="height: 300px;" src="../images/default1.jpeg" class="img-thumbnail" />
</div>


  <div class="col-lg-6" style="float: none;margin: auto;">
    <div class="card mb-3">
     <div class="card-header">
      <div class="card-header">
                <i class="fa fa-bar-chart"></i>Student Details</div>
         <div class="card-body">
              <div class="form-group">
               <div class="form-row">
                      <div class="col-md">
                  <label  for="">Student Name : </label>

                  <!----------stored IDNO------------->
                  <input type="hidden" name="hidden_idno" id="hidden_idno" value="<?php echo $get_IDNO; ?>">

                  <!----------------stored the page Class id------------------>
                  <input type="hidden" value="<?php echo $set_class_id; ?>" id="hidden_set_class_id" name="">
                     <!----------------stored the page Class id------------------>


                  <!----------stored IDNO------------->
                    <input class="form-control input-sm" id="mid" readonly name="studname" placeholder=
                        "Student Name" type="text" value="<?php echo $res->name ?>">
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="form-row">
                      <div class="col-md">
                  <label  for="">Gender : </label>

                    <input class="form-control input-sm" id="gender" readonly name="gender" placeholder=
                        "Gender" type="text" value="<?php echo $res->GENDER ?>">
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="form-row">
                      <div class="col-md">
                  <label  for="">Address : </label>

                    <input class="form-control input-sm" id="address" readonly name="address" placeholder=
                        "Address" type="text" value="<?php echo $res->ADDRESS ?>">
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="form-row">
                      <div class="col-md">
                  <label  for="">Status : </label>

                    <input class="form-control input-sm" id="status" readonly name="status" placeholder=
                        "Status" type="text" value="<?php echo $res->STATUS ?>">
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="form-row">
                      <div class="col-md">
                  <label  for="">Class: </label>

                  <!------------stored class ID----------------->
                  <input type="hidden" value="<?php echo $res->CLASS_ID; ?>" name="class_id" id="class_id">
                   <!------------stored class ID----------------->
                    <input class="form-control input-sm" id="class" readonly name="class" placeholder=
                        "Class" type="text" value="<?php echo $res->CLASS_NAME ?>">
                  </div>
                </div>
              </div>
              <div class="form-group">
               <div class="form-row">

                 <div class="col-md">
                  <label  for="">Course: </label>

                   <!------------stored course ID----------------->
                   <input type="hidden" value="<?php echo $res->COURSE_ID; ?>" name="course_id" id="course_id" >
                    <!------------stored course ID----------------->
                    <input class="form-control input-sm" id="course" readonly name="course" placeholder=
                        "Course" type="text" value="<?php echo $res->COURSE_NAME ?>">
                  </div>
                     

                   <div class="col-md">
                  <label  for="">Year and Section : </label>

                   <!------------stored Section ID----------------->
                   <input type="hidden" value="<?php echo $res->SECT_ID; ?>" name="section_id" id="section_id" >
                    <!------------stored Section ID----------------->
                    <input class="form-control input-sm" id="section" readonly name="section" placeholder=
                        "Section" type="text" value="<?php echo $res->YR_SECTION ?>">
                  </div>

                </div>
              </div>
        </div>

     </div>
    </div>
  </div>


<?php


}else{
  //have no Data
  #lets include the blank data
  include('empty/stud_details_empty.php');


}//end of upper student details


?>



</div>

<hr>
<hr>
<br>
<div class="row">
<?php

$res2 = getFirstSemester($get_IDNO);

if($res2 !='0'){
  //have data for first semester

  ?>

  <div class="col-lg-6">
 <div class="card mb-3">
  <div class="card-header">

     <div class="card-header">
              <i class="fa fa-bar-chart"></i>First Semester Records</div>
      <div class="card-body">
            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">MID-TERM</label>

                  <input class="form-control input-sm" id="mid" readonly name="mid" placeholder=
                      "Mid-term Grades" type="text" value="<?php echo $res2->mid1 ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">END-TERM : </label>

                
                <input class="form-control input-sm" id="end" readonly name="end" placeholder=
                      "End-Term Grades" type="text" value="<?php echo $res2->end1 ?>">
                   
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">FINAL : </label>

                
                <input class="form-control input-sm" id="fin" readonly name="fin" placeholder=
                      "Final Grades" type="text" value="<?php echo $res2->fn1 ?>">
                   
                </div>
              </div>
            </div>

             <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">REMARKS : </label>

                
                <input class="form-control input-sm" id="stats" readonly name="stats" placeholder=
                      "REMARKS" type="text" value="<?php echo $res2->REMARKS ?>">
                   
                </div>
              </div>
            </div>

             <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">SCHOOL YEAR : </label>

                
                <input class="form-control input-sm" readonly="" id="sy" name="sy" placeholder=
                      "SCHOOL-YEAR" type="text" value="<?php echo $res2->SCHOOL_YEAR ?>">
                   
                </div>
              </div>
            </div>


            <?php

            #check if the student INC or DROP or pending
            if($res2->REMARKS == 'not good'){
              echo '

           <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">STATUS : </label>

                <input class="form-control" value="Pending..." readonly></input>
                
                   
                </div>
              </div>
            </div>
            



              ';


            }else if($res2->REMARKS == 'INC'){

              echo '
                 <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">STATUS : </label>

                
                <input class="form-control btn btn-danger" readonly="" id="sy" name="sy" placeholder=
                      "INC" type="text" value="" style="color: white;">
                   
                </div>
              </div>
            </div>
            <a class="btn btn-sm btn-danger " href="../Inst-inc/" style="cursor: pointer;color: white;">Click here to go INC Page!</a>

              ';

            }else if($res2->REMARKS == 'DROP'){
              echo '
                             <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">STATUS : </label>

                <input class="form-control" value="DROP" readonly></input>
                
                   
                </div>
              </div>
            </div>


              ';

            }else if($res2->REMARKS == 'PASSED'){
              echo '

           <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">STATUS : </label>

                <input class="form-control" value="PASSED" readonly style="color:green;"></input>
                
                   
                </div>
              </div>
            </div>

              ';


            }else{

            } //end of else of REMARKS STATUS


             ?>



      </div>


   </div>
  </div>
</div>



<?php

}else{
//no data for first semester
  include('empty/firstsemester.php');


}//end of first semester


 ?>



<?php

#check if the query have data: check if the student have already enrolled in second semester
#if already enrolled display the form without button `enroll`
$res3 = getSecondSemester($get_IDNO);

if($res3 !='0'){
#true have data!
	?>


<div class="col-lg-6">
  <div class="card mb-3">
   <div class="card-header">

       <div class="card-header">
                <i class="fa fa-bar-chart"></i>Second Semester Records</div>
        <div class="card-body">
                 <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">MID-TERM</label>

                  <input class="form-control input-sm" id="mid" readonly name="mid" placeholder=
                      "Mid-term Grades" type="text" value="<?php echo $res3->mid2 ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">END-TERM : </label>

                
                <input class="form-control input-sm" id="end" readonly name="end" placeholder=
                      "End-Term Grades" type="text" value="<?php echo $res3->end2 ?>">
                   
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">FINAL : </label>

                
                <input class="form-control input-sm" id="fin" readonly name="fin" placeholder=
                      "Final Grades" type="text" value="<?php echo $res3->fn2 ?>">
                   
                </div>
              </div>
            </div>

             <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">REMARKS : </label>

                
                <input class="form-control input-sm" id="stats" readonly name="stats" placeholder=
                      "REMARKS" type="text" value="<?php echo $res3->REMARKS ?>">
                   
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">SCHOOL YEAR : </label>

                
                   <select class="form-control">
                      <option><?php echo $res3->SCHOOL_YEAR ?></option>
                    </select>
                   
                </div>
              </div>
            </div>

            <?php
            #check if the student status is INC, DROP,Pending.. or PASSED

            if($res3->REMARKS == 'not good'){
            	echo '

            	 <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">STATUS : </label>

                <input class="form-control" value="Pending..." readonly style="color: blue;"></input>
                
                   
                </div>
              </div>
            </div>

            	';

            }else if($res3->REMARKS == 'INC'){
            	echo '

					<div class="form-group">
		              <div class="form-row">
		                  <div class="col-md">
		                <label for=
		                "section">STATUS : </label>

		                
		                <input class="form-control btn btn-danger" readonly="" id="sy" name="sy" placeholder=
		                      "INC" type="text" value="" style="color: white;">
		                   
		                </div>
		              </div>
		            </div>
		            <a class="btn btn-sm btn-danger " href="../Inst-inc/" style="cursor: pointer;color: white;">Click here to go INC Page!</a>


            	';

            }else if($res3->REMARKS == 'DROP'){
            	echo '
            	 <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">STATUS : </label>

                <input class="form-control" value="DROP" readonly style="color: blue;"></input>
                
                   
                </div>
              </div>
            </div>

            	';

            }else if($res3->REMARKS =='PASSED'){
            	echo '
            	 <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">STATUS : </label>

                <input class="form-control" value="PASSED" readonly style="color: green;"></input>
                
                   
                </div>
              </div>
            </div>

            	';
            }

             ?>
 			<div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">STATUS : </label>

                <input class="form-control" value="Already Enrolled" readonly style="color: blue;"></input>
                
                   
                </div>
              </div>
            </div>
          
            

        </div>


     </div>
  </div>
</div>




<?php


}else{
#have no Data : second Semester
?>


<div class="col-lg-6">
  <div class="card mb-3">
   <div class="card-header">

       <div class="card-header">
                <i class="fa fa-bar-chart"></i>Second Semester Records</div>
        <div class="card-body">
                 <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">MID-TERM</label>

                  <input class="form-control input-sm" id="mid" readonly name="mid" placeholder=
                      "Mid-term Grades" type="text" value="">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">END-TERM : </label>

                
                <input class="form-control input-sm" id="end" readonly name="end" placeholder=
                      "End-Term Grades" type="text" value="">
                   
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">FINAL : </label>

                
                <input class="form-control input-sm" id="fin" readonly name="fin" placeholder=
                      "Final Grades" type="text" value="">
                   
                </div>
              </div>
            </div>

             <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">REMARKS : </label>

                
                <input class="form-control input-sm" id="stats" readonly name="stats" placeholder=
                      "REMARKS" type="text" value="">
                   
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">SCHOOL YEAR : </label>
                 <select class="form-control" required="" id="sy2">

 <?php

#if the function returns 0 it means the year is not compatible to enroll
 #must be second semester in the School year
 $SY_second_sem = getSYforSecondSemester();

 if($SY_second_sem != '0'){
 	echo '
 	 <option value="'.$SY_second_sem->ACAD_ID.'">'.$SY_second_sem->SCHOOL_YEAR.'</option>

 	';
 }else{
 	#not compatible or have not SY yet
 	echo '
 	 <option value=""></option>

 	';
 }


  ?>               
                  
                     
                    </select>
                   
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">SEMESTER : </label>

                
                <input class="form-control input-sm" readonly name="stats" id="sem2" placeholder=
                      "" type="text" value="<?php if($SY_second_sem !='0'){ echo $SY_second_sem->SEMESTER; }else{echo ''; } ?>">
                   
                </div>
              </div>
            </div>  
            <?php
            
            if($res2 !='0'){

                #check if the first semester Remarks if pass or inc or drop
                #if the remarks is passed the student can proceed into enrollment for second semester
                if($res2->REMARKS == 'PASSED'){
                  //the button will show for enrolling for second semester
                  echo '<button type="submit" class="btn btn-warning fa fa-arrow-left" name="re-enroll" id="re-enrolled"><i class="fa fa-arrow-right"> Enroll</i></button>';
                }else if($res2->REMARKS == 'INC'){
                  //the button enroll will hide
                  echo '';
                }else if($res2->REMARKS == 'DROP'){
                  //the button will also be hide

                  echo '';
                }else if($res2->REMARKS == 'not good'){
                  //pending and the button will also hide
                  echo '';
                }

            }



             ?>

            

        </div>


     </div>
  </div>
</div>




<?php 





} //end of second semester if and else



 ?>




</div>


	

<?php } //end of 'if' getting the $_GET method IDNO value



 ?>




<?php

include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');


function getStudentData($IDNO){
	global $mydb;
	$mydb->setQuery("select s.IDNO,concat(s.FNAME,' ',s.LNAME) as 'name',st.GENDER,st.ADDRESS,en.`STATUS`,cl.CLASS_ID,cl.CLASS_NAME,co.COURSE_ID,co.COURSE_NAME,sec.SECT_ID,sec.YR_SECTION from enrollees en,students s,stud_details st,class cl,course co,sections sec where en.IDNO = s.IDNO and s.IDNO = st.IDNO and en.CLASS_ID = cl.CLASS_ID and en.COURSE_ID = co.COURSE_ID and en.SECT_ID = sec.SECT_ID and en.IDNO = '".$IDNO."' LIMIT 1");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$found = $mydb->loadSingleResult();
		return $found;
	}else{
		return 0;
	}
 
}

function getFirstSemester($IDNO){
	global $mydb;
	$mydb->setQuery("select s.IDNO, gr.MID_TERM as 'mid1',gr.END_TERM as 'end1',gr.FINAL as 'fn1', gr.REMARKS,ac.SCHOOL_YEAR from grades gr,students s,acad_year ac where s.IDNO = gr.IDNO and gr.ACAD_ID = ac.ACAD_ID and ac.SEMESTER = 'FIRST' and gr.IDNO = '".$IDNO."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$found_data = $mydb->loadSingleResult();
		return $found_data;
	}else{
		return 0;
	}

}

function getSecondSemester($IDNO){
	global $mydb;
	$mydb->setQuery("select s.IDNO, gr.MID_TERM as 'mid2',gr.END_TERM as 'end2',gr.FINAL as 'fn2', gr.REMARKS,ac.SCHOOL_YEAR from grades gr,students s,acad_year ac where s.IDNO = gr.IDNO and gr.ACAD_ID = ac.ACAD_ID and ac.SEMESTER = 'SECOND' and gr.IDNO = '".$IDNO."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$found_data = $mydb->loadSingleResult();
		return $found_data;
	}else{
		return 0;
	}

}

function getSYforSecondSemester(){
	global $mydb;
	$mydb->setQuery("select * from acad_year where STATUS ='YES' and SEMESTER = 'SECOND'");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$datF = $mydb->loadSingleResult();
		return $datF;
	}else{
		return 0;
	}
}


?>
<script type="text/javascript" src="action/enrolling-script.js"></script>