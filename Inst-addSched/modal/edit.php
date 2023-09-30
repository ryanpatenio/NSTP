<!-- Modal ADD SCHEDULE -->
<div class="modal" id="editSchedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">EDIT SCHEDULE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" id="edit_schedForm">
   
  <input type="hidden" id="hdd_edit_sched_id" name="hdd_edit_sched_id">

<div class="row">

        <div class="col">
            <label for="Topic"><strong>Topic</strong></label>
            <input type="text" name="editTopic" id="editTopic" value="" class="form-control" required="">
            <span id="error_topic2" class="text-danger"></span>
        </div>

        
</div>

<div class="row" style="margin-top: 15px;">
  <div class="col">
    <label><strong>Class</strong></label>

       <input type="text" class="form-control" name="" id="editClass" readonly="">

  </div>
</div>


<div class="row">
 

        <div class="col">
            <label for="schedule" style="margin-top: 20px;"><strong>Schedule</strong></label>
            <input type="date" name="editSchedDate" id="editSchedDate" value="" class="form-control" required="">
        </div>

       
</div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="hidden" name="action" value="editS">
        <input type="submit" class="btn btn-primary" name="" id="saveSchedule" value="Update">
        
      </div>
      </form>
    </div>
  </div>
</div>
