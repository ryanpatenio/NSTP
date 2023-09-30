<!-- Modal ADD SCHEDULE -->
<div class="modal" id="addSchedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">ADD NEW SCHEDULES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" id="addSchedForm">

        <div class="row">

          <div class="col">
              <label for="Topic"><strong>TOPIC</strong></label>
              <input type="text" id="addTopic" name="addTopic" placeholder="Topic" class="form-control" required="">
            
               <span id="error_topic" class="text-danger"></span>
          </div>

       
      </div>
<div class="row" style="margin-top: 20px;">

<?php

  $dt_acad = getSY();
  if($dt_acad !='0'){
    $acad = $dt_acad->ACAD_ID;
    $acad_sy = $dt_acad->SCHOOL_YEAR;
    $acad_sem = $dt_acad->SEMESTER;
  }else{
    $acad = '';
    $acad_sy = '';
    $acad_sem = '';
  }

 ?>


  <input type="hidden" name="hdd_acad" value="<?php echo $acad; ?>"> 

   <div class="col">
    <label><strong>SCHOOL YEAR</strong></label>
   <input type="text" class="form-control" name="" value="<?php echo $acad_sy; ?>" readonly="" placeholder="SCHOOL YEAR">
  </div>

  <div class="col">
    <label><strong>SEMESTER</strong></label>
   <input type="text" class="form-control" name="" readonly="" placeholder="SEMESTER" value="<?php echo $acad_sem; ?>">
  </div>
</div>

<div class="row" style="margin-top: 20px;"> 

  <div class="col">
    <label><strong>Select Class</strong></label>
    <select class="form-control" name="class">
      <?php
      $data_class = getClass($_SESSION['inst_id']);
      foreach ($data_class as $row_class) {
        # code...
        echo '<option value="'.$row_class['CLASS_ID'].'">'.$row_class['CLASS_NAME'].'</option>';

      }

       ?>   

    </select>
  </div>

</div>

<div class="row">
 

        <div class="col">
            <label for="schedule" style="margin-top: 20px;"><strong>SCHEDULE DATE</strong></label>
            <input type="date" id="scheduleDate" name="schedDate" class="form-control" required="">
             <span id="error_date" class="text-danger"></span>
        </div>

       
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="hidden" name="action" value="add">
        <input type="submit" class="btn btn-primary" name="" id="addBtn" value="ADD">
        
      </div>
      </form>
    </div>
  </div>
</div>

<?php

function getSY(){
  global $mydb;
  $mydb->setQuery("select * from acad_year where STATUS ='YES';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found;
  }else{
    return 0;
  }
}

function getClass($inst_id){
  global $mydb;
  $mydb->setQuery("select * from class WHERE INST_ID = '".$inst_id."';");
  $cur = $mydb->executeQuery();
  if($cur){
    return $cur;
  }else{
    return 0;
  }
}


 ?>
