<!-- Modal ADD GRADES FORM -->
<div class="modal" id="uploadWork" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-scrollable" role="document" style="background-color: rgba(192,192,192,0.98);box-shadow: 0 3px 20px 2px rgb(1 1 1 / 0.98);" > 
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">UPLOAD WORK</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="form_addMod" method="post" enctype="multipart/form-data">
          
          <input type="hidden" name="IDNO" id="IDNO" value="<?php echo $IDNO; ?>">              
          <input type="hidden" id="ass_id" value="" name="ass_id">
          <input type="hidden" id="class_id" value="" name="class_id">


          <input type="file" class="form-control" name="passFile" id="passFile" accept="file"> 

       
       
        <div class="progress" style="display: none;margin-bottom: 5px;margin-top: 10px;">
               <div class="progress-bar progress-bar-success" role="progresbar" aria-value="" aria-valuemax="100" style="width: 0%;"></div> 

            </div>
       
      </div>
      <div class="modal-footer">
       <!--  <input type="hidden" name="action" id="action" value="getInfo"> -->
       <input type="hidden" name="action" id="action" value="ADD">
        <button type="button" class="btn btn-secondary" id="df_close_btn" data-dismiss="modal">Close</button>
        <input type="submit" name="submit_module" id="submit_module" class="btn btn-primary" value="Submit">
        
      </div>
 </form>
      
    </div>
  </div>
</div>