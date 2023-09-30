
<!-- Modal ADD AY -->
<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">ADD NEW COURSE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
 <form method="POST" id="addForm">
                       <div class="form-group">                      
                              <label for="">Course Name : </label>
                          
                                   <input type="text"  value="" class="form-control" placeholder="Sample: BSIT" name="course" required>
                                            
                        </div>


                        <div class="form-group">                        
                              <label for="">Description : </label>
                              <input type="text" class="form-control" name="descript" placeholder="Sample: Bachelor of Science in Information Technology" required="">
                        </div>

                        
                                           
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      Close
                      <span class="glyphicon glyphicon-remove-sign"></span>
                    </button>
                    <input type="hidden" name="action" value="add">
                    <input type="submit" name="" id="addFbtn" value="Save" class="btn btn-success">
                  </div>
                  </form>

      </div>
     
    
    </div>
  </div>
</div>