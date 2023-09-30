
<!-- Modal ADD AY -->
<div class="modal" id="editInstModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">EDIT INSTRUCTOR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
 <form method="POST" id="editForm">
  <input type="hidden" id="h_editID" name="h_editID">
                       <div class="form-group">                      
                        <label for="">First Name : </label>
                          
                       <input type="text" id="editFname" value="" class="form-control" placeholder="First Name" name="editfname" required>
                                            
                        </div>


                        <div class="form-group">                        
                              <label for="">Last Name : </label>
                              <input type="text" class="form-control" id="editlname" name="editlname" placeholder="Last Name" required="">
                        </div>

                          <div class="form-group">                        
                              <label for="">Username : </label>
                              <input type="email" class="form-control" id="edituname" name="edituname" placeholder="Email Or Username" required="">
                        </div>
                          <div class="form-group">                        
                              <label for="">New Password : </label>
                              <input type="password" class="form-control" name="editpass" placeholder="New Password" required="">
                        </div>
                        
                          <div class="form-group">                        
                              <label for="">Position : </label>

                             <select class="form-control" name="edpos">
                              <option value="INSTRUCTOR">INSTRUCTOR</option>
                             </select>
                        </div>
                        
                                           
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      Close
                      <span class="glyphicon glyphicon-remove-sign"></span>
                    </button>
                    <input type="hidden" name="action" value="edit">
                    <input type="submit" name="editIbtn" id="editIbtn" value="Update" class="btn btn-success">
                  </div>
                  </form>

      </div>
     
    
    </div>
  </div>
</div>