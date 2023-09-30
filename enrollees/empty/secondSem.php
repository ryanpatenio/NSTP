
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
                 <select class="form-control" required="" id="sy3">

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
                    echo '<button type="submit" class="btn btn-warning fa fa-arrow-left" name="re-enroll" id="re-enrolled2"><i class="fa fa-arrow-right"> Enroll</i></button>';
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