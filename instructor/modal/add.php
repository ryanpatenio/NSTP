
<!-- Modal ADD AY -->
<div class="modal" id="addInstModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">ADD NEW INSTRUCTOR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
 <form method="POST" id="addForm">
                       <div class="form-group">                      
                        <label for="">First Name : </label>
                          
                       <input type="text" id="fname" value="" class="form-control" placeholder="First Name" name="fname" required>
                                            
                        </div>


                        <div class="form-group">                        
                              <label for="">Last Name : </label>
                              <input type="text" class="form-control" name="lname" placeholder="Last Name" required="">
                        </div>

                          <div class="form-group">                        
                              <label for="">Username : </label>
                              <input type="email" class="form-control" name="uname" placeholder="Email Or Username" required="">
                        </div>
                          <div class="form-group">                        
                              <label for="">Password : </label>
                              <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required="">
                        </div>
                          <div class="form-group">                        
                              <label for="">Re-Password : </label>
                              <input type="password" class="form-control" id="repass" name="repass" placeholder="Re-Password" required="" readonly="">
                              <span class="text-danger" id="err_pass"></span>
                        </div>
                          <div class="form-group">                        
                              <label for="">Position : </label>

                             <select class="form-control" name="pos">
                              <option value="INSTRUCTOR">INSTRUCTOR</option>
                             </select>
                        </div>
                        
                                           
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      Close
                      <span class="glyphicon glyphicon-remove-sign"></span>
                    </button>
                    <input type="hidden" name="action" value="add">
                    <input type="submit" name="addFbtn" id="addFbtn" value="Save" class="btn btn-success">
                  </div>
                  </form>

      </div>
     
    
    </div>
  </div>
</div>