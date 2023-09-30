
<!-- Modal ADD AY -->
<div class="modal" id="addClassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">ADD NEW CLASS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
 <form method="POST" id="addForm">
                       <div class="form-group">  
                        <?php
                        $code = getAutocode();

                         ?>


                              <label for="">Class Code : </label>
                          
                                   <input type="text" value="<?php echo $code->START+$code->END.'-'.$code->DESCRIPTION ?>" class="form-control" placeholder="Sample: Class 101" name="classCode" readonly>
                                            
                        </div>


                        <div class="form-group">                        
                              <label for="">Class Name : </label>
                              <input type="text" class="form-control" name="classname" placeholder="Sample: CWTS BSIT 1-1" required="">
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

<?php
function getAutocode(){
  global $mydb;
  $mydb->setQuery("select * from autocode where DESCRIPTION = 'CLASS';");
  $cur = $mydb->loadSingleResult();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}


 ?>