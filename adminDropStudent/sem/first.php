

 <div class="col-lg-6" style="float: none;margin: auto;">
    <div class="card mb-3">
     <div class="card-header">
      <div class="card-header">
                <i class="fa fa-bar-chart"></i>Student Details</div>
         <div class="card-body">
          <form method="post" id="re_enroll1">

            <input type="hidden" id="hidden_enroll_id1" name="hidden_enroll_id1" value="<?php echo $get_enroll_id; ?>">
            <input type="hidden" id="hidden_idno1" name="hidden_idno1" value="<?php echo $get_IDNO; ?>">


              <div class="form-group">
               <div class="form-row">
                      <div class="col-md">
                  <label  for="">Student Name 1: </label>

                    <input class="form-control input-sm" id="mid" readonly name="studname" placeholder=
                        "Student Name" type="text" value="<?php echo $data->name; ?>">
                  </div>
                </div>
              </div>

 

              <div class="form-group">
                <div class="form-row">
                    <div class="col-md">
                  <label for=
                  "section">CLASS : </label>

                  
                  <input class="form-control input-sm" readonly="" id="class" name="class" placeholder=
                        "CLASS" type="text" value="<?php echo $data->CLASS_NAME; ?>">
                     
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="form-row">
                    <div class="col-md">
                  <label for=
                  "section">SCHOOL YEAR : </label>

                  
                  <input class="form-control input-sm" readonly="" id="sy" name="sy" placeholder=
                        "SCHOOL-YEAR" type="text" value="<?php echo $data->SCHOOL_YEAR; ?>">
                     
                  </div>
                </div>
              </div>

            <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                <label for=
                "section">Semester : </label>

                
                <input class="form-control input-sm" readonly="" id="semester101" name="semester101" placeholder=
                      "Semester" type="text" value="<?php echo $data->SEMESTER; ?>">
                   
                </div>
              </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-md">
                  <label for=
                  "section">STATUS : </label>

                  
                  <input class="form-control" readonly="" id="sy" name="sy" placeholder=
                        "DROP" type="text" value="<?php echo $data->R_STATUS; ?>">
                     
                  </div>
                </div>
              </div>


            <div class="form-group">
                <div class="form-row">
                    <div class="col-md">
                  <label for=
                  "section">Select Class : </label>

                  
                  <select class="form-control" name="sel_class" required="">
                    <?php 
                    $classlist = getClassFirst();
                    if($classlist !='0'){

                      foreach ($classlist as $data_class) {
                        # code...
                        ?>

                        <option value="<?php echo $data_class['CLASS_ID']; ?>"><?php echo $data_class['CLASS_NAME']; ?></option>


                        <?php


                      }


                    }

                    ?>


                    
                  </select>
                     
                  </div>
                </div>
              </div>

            <div class="form-group">
              <div class="form-row">

                <?php

                    $data_first = getDefaultSyFirstSem();
                    if($data_first !='0'){

                      ?>

             <div class="col-md">

                <label for=
                "section">Available School Year : </label>

                  <select class="form-control" name="avail_sy" required="">
                    <option value="<?php echo $data_first->ACAD_ID; ?>"><?php echo $data_first->SCHOOL_YEAR; ?></option>
                  </select>                  
              </div>

              <div class="col-md">
                  <label for="semester">SEMESTER</label>
                  <input type="text" class="form-control" name="avl_sem" readonly="" value="<?php echo $data_first->SEMESTER; ?>">
              </div>

                      <?php
                    }else{

                      //no available school year
                      ?>

                      <div class="col-md">
                        <label>NO Available School year for this semester! you cannot enroll this student!</label>
                      </div>



                      <?php

                    }

                     ?>

          

              </div>
            </div>
            <input type="hidden" name="action" value="re_enroll_first">
           <input type="submit" name="" id="btn-enroll1"  class="btn btn-warning" value="RE-ENROLL"></i>
            <!--  <button class="btn btn-warning " id="btn-first"><i class="fa fa-arrow-right"> Re-Enroll</i></button> -->

        </div>
</form>
     </div>
    </div>
  </div>