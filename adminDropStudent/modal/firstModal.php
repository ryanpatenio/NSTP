<!-- Modal ADD STUDENT FORM -->



<div class="modal fade bd-example-modal-sm" id="dropEnroll1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Re-Enroll Drop Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST">
        <div class="card card-register mx-auto mt-2" style="margin-bottom: 10%;">
          <div class="card-header">Re-Enroll</div>
            <div class="card-body">

              <div class="form-group">
                  <div class="form-row">
                      <div class="col-md">
                          <label for="">Class:</label>
                            
                             <select class="form-control">
                               <option value="">CWTS IRREGULAR</option>
                               <option value="">LTS IRREGULAR</option>
                               <option value="">ROTC FOXTROT</option>
                             </select>
                      </div>
                    </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                      <div class="col-md">
                          <label for="">School Year:</label>
                           <select class="form-control">
                               <option value="">2021-2022</option>
                             </select>
                             
                      </div>
                    </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                      <div class="col-md">
                          <label for="">Semester:</label>
                           
                             <input class="form-control input-sm" id="sem" readonly name="sem" placeholder=
                                "Semester" type="text" value="" required >
                      </div>
                    </div>
                </div>

          </div>
       </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="dis" data-dismiss="modal">Close</button>
        <input type="button" class="btn btn-primary" name="reEn" value="ADD">
       <!--  <button type="button" id="addStudentBtn" class="btn btn-primary">ADD</button> -->
       </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal ADD STUDENT FORM -->