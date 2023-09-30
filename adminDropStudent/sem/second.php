

 <div class="col-lg-6" style="float: none;margin: auto;">
    <div class="card mb-3">
     <div class="card-header">
      <div class="card-header">
                <i class="fa fa-bar-chart"></i>Student Details</div>
         <div class="card-body">
          <form method="post" id="re_enroll2">


            <input type="hidden" id="hidden_enroll_id2" name="hidden_enroll_id2" value="<?php echo $get_enroll_id; ?>">
            <input type="hidden" id="hidden_idno2" name="hidden_idno2" value="<?php echo $get_IDNO; ?>">


              <div class="form-group">
               <div class="form-row">
                      <div class="col-md">
                  <label  for="">Student Name 2 : </label>

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

              <hr>
              <h4 style="font-family: verdana,sans-serif;">Please fill all information below to re enroll this selected student</h4>
              <hr>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-md">
                  <label for=
                  "section"><strong>Select Class : </strong></label>

                  
                  <select class="form-control" name="sel_class2" required="">
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

                    $data_second = getDefaultSySecondSem();
                    if($data_second !='0'){


                      $datas_sy = $data_second->SCHOOL_YEAR;
                      $datas_sem = $data_second->SEMESTER;
                      $data_id = $data_second->ACAD_ID;

                    }else{
                       $datas_sy = '';
                      $datas_sem = '';
                      $data_id = '';
                    }

                     ?>

             <div class="col-md">

                <label for=
                "section"><strong>Available School Year :</strong> </label>

                  <select class="form-control" name="avail_sy2" required="">
                    <option value="<?php echo $data_id; ?>"><?php echo $datas_sy; ?></option>
                  </select>                  
              </div>

              <div class="col-md">
                  <label for="semester"><strong>SEMESTER</strong></label>
                  <input type="text" class="form-control" name="avl_sem2" readonly="" value="<?php echo $datas_sem; ?>">
              </div> 

                   

          

              </div>
            </div>
            <input type="hidden" name="action" value="re_enroll_second">
           <input type="submit" name="" id="btn-enroll2" class="btn btn-warning" value="RE-ENROLL"></i>
            <!--  <button class="btn btn-warning " id="btn-first"><i class="fa fa-arrow-right"> Re-Enroll</i></button> -->

        </div>
</form>
     </div>
    </div>
  </div>