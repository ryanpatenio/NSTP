<!-- Modal ADD STUDENT FORM -->
<div class="modal fade bd-example-modal-lg" id="addNew" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg " style="background-color: rgba(192,192,192,0.98);box-shadow: 0 3px 20px 2px rgb(1 1 1 / 0.98);">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">ADD ENROLLMENT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<form method="POST" id="letEnroll">

<div class="card card-register mx-auto mt-2" style="margin-bottom: 10%;">
      <div class="card-header">Add Enrollment</div>
      <div class="card-body">

        <div class="form-group">
            <div class="form-row">
                  <div class="col-md">
                      <label for="datetoday">Date</label>
                        <?php
                        function date_toText($datetime=""){
                        $nicetime = strtotime($datetime);
                        return strftime("%B %d, %Y at %I:%M %p", $nicetime);  
          
  }
                         date_default_timezone_set('Asia/Manila'); 
                          
                         $created =  strftime("%Y-%m-%d %H:%M:%S", time()); 
                       ?>
                         <input class="form-control input-sm" id="datetoday" readonly name="datetoday" placeholder=
                            "Date Today" type="text" value="<?php  echo date_toText($created); ?>">
                    </div>
              </div>
         </div>

          <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                      <label for="Idnum">ID Number:</label>
                        <input type="text" class="form-control" name="IDNO" id="IDNO" required="" readonly="">
                        
                  </div>
              </div>
          </div>


          <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                      <label for="Idnum">Student Name : </label>
                        <input name="Idnum" type="hidden" value="">
                         <input class="form-control input-sm" id="stud_name" readonly name="stud_name" placeholder=
                            "Student Name" type="text" value="" required >
                  </div>
              </div>
          </div>

          <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                      <label for=
                      "Status" style="color: blue;"><strong>Select Class : </strong></label>

                        <select class="form-control input-sm" name="class" id="class">
                            <?php
                           $mydb->setQuery("select * from class");
                           $cur5 = $mydb->executeQuery();


                            while($row5 = mysqli_fetch_assoc($cur5)){
                            ?>
                            <option value="<?php echo $row5['CLASS_ID'] ?>"><?php echo $row5['CLASS_NAME']; ?></option>
                            <?php
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
                      "Status">Status : </label>

                         <select class="form-control input-sm" name="Status" id="Status">
                            <option value="New Student">New Student</option>
                            <option value="Continuing">Continuing</option>  
                            <option value="Trasferee">Trasferee</option>
                            <option value="Irregular">Irregular</option>  
                          </select>
                  </div>
              </div>
           </div>

           <div class="form-group">
           <div class="form-row">
              <div class="col-md-12">
                  <label for=
                      "grdlvl">Course</label>

                          <select class="form-control input-sm" name="course" id="course">
                            <?php
                           $mydb->setQuery("select * from course");
                           $cur = $mydb->executeQuery();


                            while($row = mysqli_fetch_assoc($cur)){
                            ?>
                            <option value="<?php echo $row['COURSE_ID'] ?>"><?php echo $row['COURSE_DESC']; ?></option>
                            <?php
                          }
                            ?>
                    </select> 
                </div>
            </div>
          </div>

            <div class="form-group">
                <div class="form-row">
                   <div class="col-md-12">
                      <label for=
                      "year">YR & SECTION</label>

                          <select class="form-control input-sm" name="section" id="section">
                            <?php
                          $mydb->setQuery("select * from sections");
                          $cur2 = $mydb->executeQuery();
                            while($rowcount3 = mysqli_fetch_assoc($cur2)){
                            ?>
                            <option value="<?php echo $rowcount3['SECT_ID'] ?>"><?php echo $rowcount3['YR_SECTION']; ?></option>
                            <?php
                          }
                            ?>
                           </select> 
                   </div>
                </div>
             </div>

             <?php
             $mydb->setQuery("select * from acad_year where STATUS = 'YES'");
             $cur3 = $mydb->executeQuery();
             $row4 = mysqli_fetch_assoc($cur3);

              ?>

              <div class="form-group">
                    <div class="form-row">
                      <div class="col-md">
                      <label  for=
                      "ay">Academic Year:</label>
                        <input type="text" class="form-control input-sm" name="ay" id="ay" value="<?php echo $row4['SCHOOL_YEAR']; ?>" readonly>
                        <input type="hidden" class="form-control input-sm" name="sy_id" id="sy_id" value="<?php echo $row4['ACAD_ID']; ?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md">
                      <label  for=
                      "ay">Semester :</label>
                        <input type="text" class="form-control input-sm" name="sem" id="sem" value="<?php echo $row4['SEMESTER']; ?>" readonly>
                        
                      </div>
                    </div>
                  </div> 


  </div>
</div>
        


      </div>
      <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      Close
                      <span class="glyphicon glyphicon-remove-sign"></span>
                    </button>
                    <input type="hidden" name="action" value="addnewEnrollment">
                    <input type="submit" name="addFbtn" id="addFbtn" value="Save" class="btn btn-success">
                  </div>
    </div>
  </div>
</div>
</form>
<!-- Modal ADD STUDENT FORM -->