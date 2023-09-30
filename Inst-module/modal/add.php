
<!-- Modal ADD MODULE -->
<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">ADD NEW MODULE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form  method="POST" id="addMForm" enctype="multipart/form-data">
         

        <div class="row">

        <div class="col">
            <label for="Topic" style=""><strong>TITLE</strong></label>
            <input type="text" name="title" placeholder="Title" id="title" class="form-control" required="">
            <span id="error_title" class="text-danger"></span>
        </div>

      
</div>
<div class="row">

        <div class="col">
            <label for="Topic" style="margin-top: 10px;"><strong>DESCRIPTION</strong></label>
           
            <textarea class="form-control"name="descript" id="descript" placeholder="Short Description"required ></textarea>
            <span id="error_desc" class="text-danger"></span>
        </div>

       
</div>
<div class="row">
  <div class="col">
    <label style="margin-top: 20px;"><strong>DUE DATE (Optional)</strong></label>
    <input type="date" class="form-control" id="due" name="due">
  </div>
</div>

<div class="row" style="margin-top: 10px;">
<?php

$data_acc = getSY();

if($data_acc !='0'){
  $acad = $data_acc->ACAD_ID;
  $data_sem = $data_acc->SEMESTER;
  $data_sy = $data_acc->SCHOOL_YEAR;
}else{
  $acad = '';
   $data_sem = '';
  $data_sy = '';
}

 ?>


  <div class="col">
    <input type="hidden" id="hdd_acad" name="hdd_acad" value="<?php echo $acad; ?>">

    <label><strong>SCHOOL YEAR</strong></label>
    <input type="text" class="form-control" value="<?php echo $data_sy; ?>" name="" placeholder="School Year" readonly="" required="">
  </div>
  <div class="col">
    <label><strong>SEMESTER</strong></label>
    <input type="text" class="form-control" value="<?php echo $data_sem; ?>" placeholder="Semester" readonly="" name="" required="">
  </div>
</div>

<div class="row">
 

        <div class="col">
            <label for="module" style="margin-top: 10px;"><strong>FILE</strong></label>
            <input type="file" name="moduleFile" id="moduleFile" class="form-control" required="">
            
        </div>

       
</div>

<div class="row">
 

        <div class="col">
            <label for="file type" style="margin-top: 10px;"><strong> TYPE</strong></label>
            <select class="form-control" name="modType" id="modType" required="">
              
              <option value="1">Assignment</option>
              <option value="2">Exam</option>

              <option value="0">New Material</option>
              
            </select>
        </div>

       
</div>


<div class="progress" style="display: none;margin-bottom: 5px;margin-top: 10px;">
               <div class="progress-bar progress-bar-success" role="progresbar" aria-value="" aria-valuemax="100" style="width: 0%;"></div> 

            </div>



      </div>
      <div class="modal-footer">
        <!-- <input type="submit" name="btn_add" id="btn_add" class="btn btn-primary" value="ADD"> -->
        <input type="hidden" name="action" id="action" value="ADD" />

        <button type="button" class="btn btn-secondary" id="d_close" data-dismiss="modal">Close</button>
         <input type="submit" name="btn_add" id="btn_add" class="btn btn-primary" value="ADD">
       <!--  <button type="button" id="addfile" class="btn btn-primary">ADD</button> -->
      </div>
    </div>
  </div>
</div>
</form>

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



 ?>