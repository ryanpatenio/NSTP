
<!-- Modal ADD AY -->
<div class="modal" id="upModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">MODIFY SECTION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
 <form method="POST" id="editForm">
  <input type="hidden" id="hiddenID" name="hiddenID">
                       <div class="form-group">                      
                              <label for="">Section Code : </label>
                          
                                   <input type="text" id="editsec" value="" class="form-control" placeholder="Section Code" name="editsec" readonly="">
                                               
                        </div>


                        <div class="form-group">                        
                              <label for="">Year and Section : </label>
                              <input type="text" class="form-control" id="editYr" name="editYr" placeholder="Year and Section" required="">
                        </div>

                        
                                           
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      Close
                      <span class="glyphicon glyphicon-remove-sign"></span>
                    </button>
                    <input type="hidden" name="action" value="edit">
                    <input type="submit" name="editbtn" id="editbtn" value="Update" class="btn btn-success">
                  </div>
                  </form>

      </div>
     
    
    </div>
  </div>
</div>