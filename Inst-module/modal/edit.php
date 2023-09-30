
<!-- Modal ADD MODULE -->
<div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">EDIT MODULE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form  method="POST" id="editModule1" enctype="multipart/form-data">
          
          <input type="hidden" id="hiddenMOD_ID" name="hiddenMOD_ID">

        <div class="row">

        <div class="col">
            <label for="Topic" style=""><strong>TITLE</strong></label>
            <input type="text" name="EditTitle" placeholder="Title" id="EditTitle" class="form-control"required>
            <span id="error_titleMod" class="text-danger"></span>
        </div>

      
</div>
<div class="row">

        <div class="col">
            <label for="Topic" style="margin-top: 10px;"><strong>DESCRIPTION</strong></label>
           
            <textarea class="form-control"name="Editdescript" id="Editdescript" placeholder="Short Description" required=""></textarea>
            <span id="error_descMod" class="text-danger"></span>
        </div>

       
</div>
<div class="row">
  <div class="col">
    <label style="margin-top: 20px;"><strong>DUE DATE (Optional)</strong></label>
    <input type="date" class="form-control" id="Editdue" name="Editdue">
  </div>
</div>

<div class="row" style="margin-top: 10px;">
 <input type="hidden" id="edit_acad" name="edit_acad" value="<?php echo $acad; ?>">


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
 
<div class="form-group mb-3 dvBtn" style="margin-top: 20px;margin-left: 10px;">
  <label><strong>If you want to change the current File, Then please Click the button below</strong></label>
<button class="btn btn-sm btn-primary changeFileBtn"> Change File</button>

</div>


        <div class="form-group mb-3 uploadNew" style="display: none;">
            <label for="module" style="margin-top: 10px;"><strong> NEW FILE</strong></label>

            <input type="file" name="editNewFile" id="editNewFile" class="form-control">
            
        </div>
        <div class="form-group mb-3 displayCurFile">
          
          <input type="hidden" id="hiddenFile" name="hiddenFile" value="">
        </div>

       
</div>

<div class="row">
 

        <div class="col">
            <label for="file type" style="margin-top: 10px;"><strong> TYPE</strong></label>
            <select class="form-control" name="editmodType" id="editmodType">
              <option id="editType"></option>
              
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
        <input type="hidden" name="action" id="action" value="updateModule" />

        <button type="button" class="btn btn-secondary" id="df_close" data-dismiss="modal">Close</button>
         <input type="submit" name="btn_update" id="btn_update" class="btn btn-primary" value="UPDATE">
       <!--  <button type="button" id="addfile" class="btn btn-primary">ADD</button> -->
      </div>
    </div>
  </div>
</div>
</form>

