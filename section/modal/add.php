
<!-- Modal ADD AY -->
<div class="modal" id="addSect" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">ADD NEW SECTION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
 <form method="POST" id="addSectForm">
                       <div class="form-group">                      
                              <label for="">Section Code : </label>
                            <?php
                            #get Data from autocode
                            $autoCodeData = tblAutocode();

                             ?>
                                   <input type="text" value="<?php echo $autoCodeData->START+$autoCodeData->END.'-'.$autoCodeData->DESCRIPTION ?>" class="form-control" placeholder="Section Code" name="secCode" readonly="" required>
                                            
                        </div>


                        <div class="form-group">                        
                              <label for="">Year and Section : </label>
                              <input type="text" class="form-control" name="yrSec" placeholder="Year and Section" required="">
                        </div>

                        
                                           
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      Close
                      <span class="glyphicon glyphicon-remove-sign"></span>
                    </button>
                    <input type="hidden" name="action" value="add">
                    <input type="submit" name="addbtn" id="addbtn" value="Save" class="btn btn-success">
                  </div>
                  </form>

      </div>
     
    
    </div>
  </div>
</div>

<?php

function tblAutocode(){
  global $mydb;
  $mydb->setQuery("select * from autocode where DESCRIPTION = 'SEC'");
  $cur = $mydb->loadSingleResult();
  if($cur){
    return $cur;
  }else{
    return 0;
  }
}

 ?>