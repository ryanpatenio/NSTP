
<!-- Modal ADD AY -->
<div class="modal" id="addAy" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">ADD NEW SCHOOL YEAR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
 <form method="POST" action="#" id="addNewSY">

                       <div class="form-group">                      
                              <label for="">School Year : </label>
                          <input type="text" class="form-control" placeholder="School Year" name="addSY" required="">                         
                        </div>


                        <div class="form-group">                        
                              <label for="">Semester : </label>
                              <div class="form-label-group">
                                  <select class="form-control" name="sem">
                                    <option value="FIRST">FIRST</option>
                                    <option value="SECOND">SECOND</option>
                                  </select>
                            </div>
                        </div>

                            <label>Is Default</label>
                        <div class="form-group">
                            <div class="form-label-group">
                              <select class="form-control" name="status">
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
                    <input type="hidden" name="action" value="add">
                    <input type="submit" name="addAYBtn" id="addAYBtn" value="Save" class="btn btn-success">
                  </div>
                  </form>

      </div>
     
    
    </div>
  </div>
</div>