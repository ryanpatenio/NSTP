
<!-- Modal ADD GRADES FORM -->
<div class="modal" id="addDropModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">ADD TO DROP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" id="dropForm">

        <input type="hidden" name="hdd_dr_idno" id="hdd_dr_idno">
        <input type="hidden" name="hdd_dr_grd_id" id="hdd_dr_grd_id">
        <input type="hidden" name="hdd_dr_enroll_id" id="hdd_dr_enroll_id">
        <input type="hidden" name="hdd_dr_class_id" id="hdd_dr_class_id">

        <div class="row">
          <div class="col">

              <label><strong>FULL NAME</strong></label>
             <input type="text" class="form-control" name="" id="fullNameFuckingDrop" readonly="">
          </div>

         
        </div>
<hr>
        <div class="row">
          
          <div class="col">
              <div class="float-left">
                <div class="row">
                  <div class="col">

                  
                    <label><strong>REASON</strong></label>
                    <textarea class="form-control" style="width: 350px;position: relative;" name="drop1Reason" id="drop1Reason" required=""></textarea>
                    <span class="text-danger" id="error_reason_drop1"></span>

                  </div>
                </div>
              </div>

              <div class="float-right">
                <div class="row">
                  <div class="col">
                    <label><strong>STUDENT ATTENDANCE</strong></label>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width: 360px;">
                      <thead>

                        <tr>
                          <th>NO.</th>
                          <th>TOPIC</th>
                          <th>DATE</th>
                          <th>STATUS</th>
                         
                        </tr>
                      </thead>
                      <tbody id="lstDrop1">
                        
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
              
          </div>
         
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="hidden" name="action" value="drop1">
        <input type="submit" name="updateDrop1Btn" id="updateDrop1Btn" class="btn btn-primary" value="ADD">

        
      </div>
      </form>
    </div>
  </div>
</div>