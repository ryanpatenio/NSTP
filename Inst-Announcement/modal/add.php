<!-- Modal ADD SCHEDULE -->
<div class="modal" id="addModalAnnouncement" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">ADD NEW ANNOUNCEMENT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="addForm" method="POST">


        <div class="row">

        <div class="col">
            <label for="Topic"><strong>ANNNOUNCEMENT</strong></label>
           <textarea class="form-control" id="annData" name="annData" placeholder="Type here!..." style="height: 150px;" required=""></textarea>
       
        </div>

       
</div>
<div class="row" style="margin-top: 20px;">

<?php

$mydb->setQuery("select * from acad_year where STATUS = 'YES'");
  $cur3 = $mydb->executeQuery();
  $sy = mysqli_fetch_assoc($cur3);



 ?>
  <div class="col">

    <input type="hidden" name="hidden_acad" value="<?php echo $sy['ACAD_ID']; ?>">

    <label><strong>SCHOOL YEAR</strong></label>
    <input type="hidden" name="hidden_SY" value="<?php echo $sy['ACAD_ID']; ?>">
    <input type="text" class="form-control" name="" readonly="" value="<?php echo $sy['SCHOOL_YEAR']; ?>">
  </div>

  <div class="col">
    <label><strong>SEMESTER</strong></label>
   <input type="text" class="form-control" name="" value="<?php echo $sy['SEMESTER']; ?>" readonly>
  </div>
</div>

<div class="row">
  <div class="col" style="margin-top: 20px">
    <label><strong>SELECT CLASS</strong></label>
       <select class="form-control" name="listClass" id="listClass" required="">
    <?php
    $class = getClass();
    foreach ($class as $dataC) {
      # code...
      echo '<option value="'.$dataC['CLASS_ID'].'">'.$dataC['CLASS_NAME'].'</option>';

    }

     ?>
         
        </select>
        <span id="error_class" class="text-danger"></span>
  </div>
</div>

      </div>
      <div class="modal-footer">
        <input type="hidden" name="action" value="add">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="hidden" name="action" value="add">
        <input type="submit" id="addBtn" name="" value="ADD" class="btn btn-primary">
       
      </div>
      </form>
    </div>
  </div>
</div>

<?php

function getClass(){
global $mydb;
    $mydb->setQuery("select * from class where INST_ID = '".$_SESSION['inst_id']."'");
    $cur = $mydb->executeQuery();


    if($cur){
      return $cur;
    }else{
      return 0;
    }

    }




 ?>
