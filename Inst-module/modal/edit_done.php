
<!-- Modal ADD MODULE -->
<div class="modal" id="editDoneModuleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">EDIT MODULE 2</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form  method="POST" id="editDoneModule" enctype="multipart/form-data">
          
          <input type="hidden" id="done_mod_id" name="done_mod_id">

        <div class="row">

        <div class="col">
            <label for="Topic" style=""><strong>TITLE</strong></label>
            <input type="text" name="EditTitle2" placeholder="Title" id="EditTitle2" class="form-control"required>
            <span id="error_titleMod2" class="text-danger"></span>
        </div>

      
</div>
<div class="row">

        <div class="col">
            <label for="Topic" style="margin-top: 10px;"><strong>DESCRIPTION</strong></label>
           
            <textarea class="form-control"name="Editdescript2" id="Editdescript2" placeholder="Short Description"required ></textarea>
            <span id="error_descMod2" class="text-danger"></span>
        </div>

       
</div>

<div class="row">
  <div class="col">
    <label style="margin-top: 20px;"><strong>DUE DATE (Optional)</strong></label>
    <input type="date" class="form-control" id="Editdue2" name="Editdue2">
  </div>
</div>

<div class="row" style="margin-top: 10px;">
 <input type="hidden" id="edit_done_acad" name="edit_done_acad" value="<?php echo $acad; ?>">


  <div class="col">
    <label><strong>SCHOOL YEAR : </strong></label>
    <input type="text" class="form-control" readonly="" required="" name="" value="<?php echo $data_sy; ?>" placeholder="School Year">
  </div>
  <div class="col">
    <label><strong>SEMESTER</strong></label>
    <input type="text" class="form-control" readonly="" value="<?php echo $data_sem; ?>" required="" name="" placeholder="Semester">
  </div>
</div>
<div class="row">
 
<div class="form-group mb-3 dvBtn2" style="margin-top: 20px;margin-left: 10px;">
  <label><strong>If you want to change the current File, Then please Click the button below</strong></label>
<button class="btn btn-sm btn-primary changeFileBtn2"> Change File</button>

</div>


        <div class="form-group mb-3 uploadNew2" style="display: none;">
            <label for="module" style="margin-top: 10px;"><strong>FILE</strong></label>
            <input type="file" name="editNewFile2" id="editNewFile2" class="form-control">
            
        </div>
        <div class="form-group mb-3 displayFile">
          
          <input type="hidden" id="hiddenFile2" name="hiddenFile2" value="">
        </div>

       
</div>

<div class="row">
 

        <div class="col">
            <label for="file type" style="margin-top: 10px;"><strong> TYPE</strong></label>
            <select class="form-control" name="editmodType2" id="editmodType2" required="">
              <option id="editType22"></option>
              
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
        <input type="hidden" name="action" id="action" value="updateDoneModule" />

        <button type="button" class="btn btn-secondary" id="dff_close" data-dismiss="modal">Close</button>
         <input type="submit" name="btn_update2" id="btn_update2" class="btn btn-primary" value="UPDATE">
       <!--  <button type="button" id="addfile" class="btn btn-primary">ADD</button> -->
      </div>
    </div>
  </div>
</div>
</form>