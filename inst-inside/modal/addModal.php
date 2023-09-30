
<!-- Modal ADD AY -->
<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">ADD NEW STUDENT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
 <form method="POST" id="addStudentForm">

  <div class="row">
    <div class="col">
      <label>IDNO : </label>
      <input type="text" class="form-control" name="IDNO" id="IDNO" required="" placeholder="IDNO">
    </div>
    <div class="col"></div>
  </div>

  <div class="row">
    <div class="col">
      <label>First Name : </label>
      <input type="text" class="form-control" name="fname" required="" placeholder="First Name">
    </div>
    <div class="col">
      <label>Last Name : </label>
      <input type="text" class="form-control" name="lname" required="" placeholder="Last Name">
    </div>
  </div>

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
                      <label for=
                      "Status" style="color: blue;"><strong>Select Class : </strong></label>

                        <select class="form-control input-sm" name="class" id="class">
                            <?php
                           $mydb->setQuery("select * from class where CLASS_ID = $id;");
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
                      "year">Year & Section</label>

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



<!-- 
  <div class="row">
    <div class="col">
      <label>Birth Day : </label>
      <input type="date" class="form-control" name="bday" required="">
    </div>
    <div class="col">
      <label>Gender : </label>
      <select class="form-control" name="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
    </div>
  </div> -->

<!-- <div class="row">
    <div class="col">
      <label>Address : </label>
      <input type="text" class="form-control" name="address" required="" placeholder="Address">
    </div>
    <div class="col">
      <label>Contact : </label>
      <input type="text" class="form-control" maxlength="11" name="contact" required="" placeholder="Contact">
    </div>
  </div>
 -->

                                           
      <div class="modal-footer" style="margin-top: 10px;">
         <button type="button" class="btn btn-default btn btn-secondary" data-dismiss="modal">
             Close
            <span class="glyphicon glyphicon-remove-sign"></span>
           </button>
         <input type="hidden" name="action" value="add">
         <input type="submit" name="addbFtn" id="addFbtn" value="Save" class="btn btn-success">
      </div>


      </div>
     </form>
    
    </div>
  </div>
</div>
