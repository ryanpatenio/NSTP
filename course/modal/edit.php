
<!-- Modal ADD AY -->
<div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">MODIFY COURSE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
 <form method="POST" id="editForm">
  <input type="hidden" name="hidden_ID" id="hidden_ID">
                       <div class="form-group">                      
                              <label for="">Course Name : </label>
                          
                                   <input type="text" id="editcourse" value="" class="form-control" placeholder="Sample: BSIT" name="editcourse" required>
                                            
                        </div>


                        <div class="form-group">                        
                              <label for="">Description : </label>
                              <input type="text" class="form-control" name="editdescript" id="editdescript" placeholder="Sample: Bachelor of Science in Information Technology" required="">
                        </div>

                        
                                           
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      Close
                      <span class="glyphicon glyphicon-remove-sign"></span>
                    </button>
                    <input type="hidden" name="action" value="edit">
                    <input type="submit" id="editFBtn" value="Save" class="btn btn-success">
                  </div>
                  </form>

      </div>
     
    
    </div>
  </div>
</div>