<div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Modify Students</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form method="post" id="editForm">

       <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                      <label for=
                      "Status"><strong>IDNO : </strong></label>
                      <input type="text" id="IDNO" name="IDNO" value="" readonly="" class="form-control" placeholder="IDNO">
                       
                  </div>
                  <div class="col-md">
                    
                  </div>
              </div>
           </div>
           <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                      <label for=
                      "Status"><strong>First Name : </strong></label>
                      <input type="text" id="fname" name="fname" value="" class="form-control" placeholder="First Name">
                       
                  </div>
                  <div class="col-md">
                      <label for=
                      "Status"><strong>Last Name : </strong></label>
                      <input type="text" id="lname" name="lname" value="" class="form-control" placeholder="Last Name">
                       
                  </div>
              </div>
           </div>

            <div class="form-group">
              <div class="form-row">
                  <div class="col-md">
                      <label for=
                      "Status"><strong>CLASS : </strong></label>
                      
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
                  <div class="col-md">
                      <label for=
                      "Status"><strong>SCHOOL YEAR : </strong></label>
                      <input type="text" id="sy" name="sy" value="" class="form-control" placeholder="School Year" readonly="">
                       
                  </div>
                  <div class="col-md">
                      <label for=
                      "Status"><strong>SEMESTER : </strong></label>
                      <input type="text" id="sem" name="sem" value="" class="form-control" placeholder="Semester" readonly="">
                       
                  </div>
              </div>
           </div>
        

      </div>
      <div class="modal-footer">
        <input type="hidden" name="action" value="edit">
        <button type="button" class="btn btn-secondary" id="dis" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="editFbtn" id="editFbtn" value="Save">
          </form>
      </div>
      </form>
    </div>
  </div>
</div>
