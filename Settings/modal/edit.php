        <!------------MODAL UPDATE------------>
<div class="modal" id="Update" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">MODIFY SCHOOL YEAR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
 <form method="POST" id="modiSY">
  <input type="hidden" id="editID" name="editID">
                            <div class="form-group">
                            <div class="form-label-group">
                            <input type="text"  class="form-control" placeholder="Title" name="editSY" readonly=""id="editSY">
                            <label for="inputtitle1">School Year</label>
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="form-label-group">
                            <input type="text" class="form-control" placeholder="Semester" name="semester" readonly=""id="editSem">
                            <label for="sinputtitle1">Semester</label>
                            </div>
                            </div>
                            <label>Is Default</label>
                            <div class="form-group">
                            <div class="form-label-group">

                            <select class="form-control" name="editstatus">
                              <option id="editSYID"></option>
                              <option value="YES">YES</option>
                              <option value="NO">NO</option>
                            </select>

                            </div>
                            </div>                           
                          
                 
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      Close
                      <span class="glyphicon glyphicon-remove-sign"></span>
                    </button>
                    <input type="hidden" name="action" value="edit">
                    <input type="submit" name="modiBtn" id="modiBtn" value="Update" class="btn btn-success">
                  </div>
                  </form>

      </div>
     
    
    </div>
  </div>
</div>