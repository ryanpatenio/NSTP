
<!-- Modal ADD GRADES FORM -->
<div class="modal " id="assignModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-bg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">ASSIGN MODULE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">

              <label><strong>TITLE</strong></label>
              <input type="text" name="" id="mod_title" readonly="" class="form-control">
          </div>
     

          
        </div>

        <div class="row">
          
          <div class="col">
            <label></label>          
                <div class="row">
                  <div class="col">

                    <form id="AssignModForm" method="POST">

                      <input type="hidden" id="hdd_id_mod" name="hdd_id_mod">
                      <input type="hidden" id="ass_acad" name="ass_acad" value="<?php echo $acad; ?>">
                    <div class="card mb-3">

                      <div class="card-header">
                        <h5>CLASS LIST</h5>
                      </div>


                         <div class="card-body">

                              <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
                  <tr>
                   <th>
                     Check?
                   </th>
                    <th>ID</th>
                    <th>Class Name</th>                  
                  </tr>
                </thead>               
                <tbody>

                  <?php

                  $class_data = getClass($_SESSION['inst_id']);
                  $i = 1;
                  foreach ($class_data as $row_class) {
                    # code...
                    ?>
                  <tr>

                      <td>
                        <input  type="checkbox" name="class_id[]" value="<?php echo $row_class['CLASS_ID']; ?>" class="btn btn-sm btn-danger">
                      </a>
                      </td>

                      <td><?php echo $i; ?></td>
                      <td><?php echo $row_class['CLASS_NAME']; ?></td>
                  </tr>


                    <?php

                $i++;  }

                   ?>

              
                </tbody>
              </table>

                        </div>
                    </div>
                  </div>
                </div>
              </div>            
          </div>          
        </div>
               
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="hidden" name="action" value="assignModule">
        <input type="submit" name="ModAssignBtn" id="ModAssignBtn" class="btn btn-primary" value="ADD">

        </form>
      </div>
    </div>
  </div>
</div>


<?php

function getClass($id){
  global $mydb;
  $mydb->setQuery("select * from class where INST_ID = '".$id."';");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}

 ?>