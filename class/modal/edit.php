
<!-- Modal ADD AY -->
<div class="modal" id="editClassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">MODIFY CLASS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
 <form method="POST" id="editForm">
  <input type="hidden" id="hidden_id" name="hidden_id">
                       <div class="form-group">                      
                              <label for="">Class Code : </label>
                          
                                   <input type="text" id="cl_code"  value="" class="form-control" placeholder="Sample: Class 101" name="editClassCode" required readonly="">
                                            
                        </div>


                        <div class="form-group">                        
                              <label for="">Class Name : </label>
                              <input type="text" id="cl_name" class="form-control" name="editClassName" placeholder="Sample: CWTS BSIT 1-1" required="">
                        </div>

                        
                                           
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      Close
                      <span class="glyphicon glyphicon-remove-sign"></span>
                    </button>
                    <input type="hidden" name="action" value="edit">
                    <input type="submit" name="editFbtn" id="editFbtn" value="Save" class="btn btn-success">
                  </div>
                  </form>

      </div>
     
    
    </div>
  </div>
</div>