
<!-- Modal ADD GRADES FORM -->
<div class="modal grd" id="addGradesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-bg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">ADD GRADES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" id="addForm">

        <input type="hidden" name="grade_id" id="grade_id">
        <input type="hidden" name="hdd_enroll_id" id="hdd_enroll_id">

        <div class="row">
          <div class="col">

              <label><strong>FULL NAME</strong></label>
              <input type="text" name="" id="fullname" readonly="" class="form-control">
          </div>

        </div>
<hr>
        <div class="row">
          
          <div class="col">
          
              <label style="margin-top: 10px;"><strong>MID TERM</strong></label>
              <input type="number" min="75" max="100" name="mid" id="mid_term" class="form-control">
               <span id="error_mid" class="text-danger"></span>

                <div class="col"></div>

              <label style="margin-top: 10px;"><strong>END TERM</strong></label>
              <input type="number" min="75" max="100" name="end" id="end_term" class="form-control">
               <span id="error_end" class="text-danger"></span>

                <div class="col"></div>

              <label style="margin-top: 10px;"><strong>FINAL</strong></label >
              <input type="number" min="75" max="100" name="final" id="final" class="form-control" readonly="">

               <span id="error_final" class="text-danger"></span>
                <div class="col"></div>




              
          </div>


          
        </div>
        
         
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="hidden" name="action" value="add_grades">
        <input type="submit" id="updateGradeBtn" class="btn btn-primary" value="UPDATE">
      </div>

      </form>
    </div>
  </div>
</div>