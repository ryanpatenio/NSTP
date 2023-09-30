<!-- Modal ADD GRADES FORM -->
<div class="modal" id="assign_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">ASSIGNING CLASS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

  <form method="post" id="assignForm">

    <input type="hidden" value="" id="hidden_inst_id" name="hidden_inst_id">

       

        <div class="row">
          <div class="col" style="margin-top: auto;margin-bottom: 20px;">
            <label><strong>INSTRUCTOR NAME: </strong></label>
            <input type="text" class="form-control" readonly="" id="inst_name" style="color: blue;font-family: verdana,sans-serif">
          </div>
        </div>



<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
           
          </div>
          <div class="card-body">

          


            <div class="table-responsive">
                
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              
                <thead>
                  <tr>
                    <th></th>
                    <th>CLASS CODE</th>
                    <th>CLASS NAME</th>                   
                  </tr>
                </thead>               
                <tbody>

                  <?php

                 $dataClass = getClass();

                  foreach ($dataClass as $cl) {?>
                    
                    <tr>
                    <td><input type="checkbox"  value="<?php echo $cl['CLASS_ID']; ?>" class="btn btn-sm btn-danger" name="class_id[]"></td>
                    <td><?php echo $cl['CLASS_CODE']; ?></td>
                    <td><?php echo $cl['CLASS_NAME']; ?></td>
                    

                 </tr>


               <?php   }

                   ?>

                 
               
                </tbody>
              </table>
            </div>
          </div>
          
        </div>


      </div>
      <div class="modal-footer">
        <input type="hidden" name="action" id="action" value="assigning">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        <input type="submit" name="assignFbtn" id="assignFbtn" class="btn btn-primary" value="ADD" />
      </div>

  </form>
      
    </div>
  </div>
</div>

<?php
function getClass(){
  global $mydb;
  $mydb->setQuery("select * from class where INST_ID = 0");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}


 ?>

