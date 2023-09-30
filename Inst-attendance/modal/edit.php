
<!-- Modal ADD MODULE -->
<div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">EDIT ATTENDANCE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" id="editForm">

          <input type="hidden" name="ATT_ID" id="ATT_ID">
          <div class="row">
            <div class="col">
              <label><strong>TOPIC: </strong></label>
              <input type="text" readonly="" id="topic" class="form-control" name="">
            </div>
          </div>

          <div class="row">
            <div class="col">
              <label><strong>DATE: </strong></label>
              <input type="text" readonly="" id="attDate" class="form-control" name="">
            </div>
          </div>
          
          <div class="row">
            <div class="col">
              <label style="margin-top: 20px;position: relative;"><strong>STATUS: </strong></label>
              <select class="form-control" id="status" name="status">
                <option id="storedV"></option>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
              </select>
            </div>
          </div>

     
       
      </div>
      <div class="modal-footer">
        <!-- <input type="submit" name="btn_add" id="btn_add" class="btn btn-primary" value="ADD"> -->
        <input type="hidden" name="action" id="action" value="edit_att" />

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="" value="Update" class="btn btn-primary" id="btn_edit">
        
       <!--  <button type="button" id="addfile" class="btn btn-primary">ADD</button> -->

        
      </div>

      </form>
    </div>
  </div>
</div>
