<!-- Modal ADD SCHEDULE -->
<div class="modal" id="createReportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">EXPORT STUDENT WITH GRADES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST"  action="action/controller.php?action=export">
        <hr>
        <div class="row">
          <div class="col">
            <label><strong>Select Year</strong></label>
              <select class="form-control" name="ay" required="">

                <?php

                $sy = getSy();
                foreach ($sy as $sy_data) {
                  # code...
                  echo '<option value='.$sy_data['SCHOOL_YEAR'].'>'.$sy_data['SCHOOL_YEAR'].'</option>';
                }

                 ?>

              
              </select>
          </div>
          <div class="col">
            <label>Semester</label>
            <select class="form-control" name="sem" required="">
              <option value="FIRST">FIRST</option>
              <option value="SECOND">SECOND</option>
            </select>
          </div>

         
        </div>

        <div class="row" style="margin-top: 20px;">
           <div class="col">
              <label><strong>CLASS</strong></label>

              <select class="form-control" name="class" id="class" required="">

                <?php

                $data_class = getClass();
                foreach ($data_class as $cl_name) {
                  # code...
                  echo '<option value='.$cl_name['CLASS_ID'].'>'.$cl_name['CLASS_NAME'].'</option>';

                }

                 ?>


              </select>

          </div>
        </div>
       
    <hr>
      </div>
      <div class="modal-footer">
       
         <button type="button" class="btn btn-default btn-secondary" data-dismiss="modal">
             Close
            <span class="glyphicon glyphicon-remove-sign"></span>
           </button>
           <input type="hidden" name="action" value="report">
        <input type="submit" class="btn btn-primary" name="csvExport" value="Export as csv file">
      </div>
    </form>
    </div>
  </div>
</div>
<?php

  function getClass(){

    global $mydb;
    $mydb->setQuery("select * from class");
    $cur = $mydb->executeQuery();

    if($cur){
      return $cur;
    }else{
      return 0;
    }

  }

function getSy(){
  global $mydb;
  $mydb->setQuery("select distinct(SCHOOL_YEAR) from acad_year;");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}


 ?>

