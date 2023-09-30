
<!-- Modal ADD GRADES FORM -->
<div class="modal" id="addIncModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">ADD TO INCOMPLETE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" id="incForm">

        <input type="hidden" name="student_idno" id="student_idno">
        <input type="hidden" name="hidden_grd_id" id="hidden_grd_id">
        <input type="hidden" name="hidden_enroll_id" id="hidden_enroll_id">
        <input type="hidden" name="hdd_class_id" id="hdd_class_id">

        <div class="row">
          <div class="col">

              <label><strong>FULL NAME</strong></label>
              <input type="text" name="" id="incFullname" readonly="" class="form-control">
          </div>
 
        </div>
        <hr>
        <div class="row">
          
          <div class="col">
        
              <div class="float-left">
                <div class="row">
                  <div class="col">

                    <label><strong>REASON</strong></label>
                    <textarea class="form-control" style="width: 350px;position: relative;height: 150px;" name="inc1Reason" required=""></textarea>
                    <span class="text-danger" id="error_reason1"></span>

                  </div>
                </div>
              </div>

              <div class="float-right">
                <div class="row">
                  <div class="col">
                    <label><strong>LIST OF MISSING MODULES</strong></label>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width: 360px;">
                      <thead>

                        <tr>
                          <th>NO.</th>
                          <th>TOPIC</th>
                          <th>DATE</th>
                          <th>STATUS</th>
                         
                        </tr>
                      </thead>
                      <tbody id="lst1">
                        
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
        <input type="hidden" name="action" value="Inc1">
        <input type="submit" name="updateInc1Btn" id="updateInc1Btn" class="btn btn-primary" value="ADD">

        </form>
      </div>
    </div>
  </div>
</div>