
<!-- Modal ADD AY -->
<div class="modal" id="viewGrades" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">View Grades</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      <form method="post" id="submit_edit_form">



      <div class="row">
        <div class="col-lg-12" id="fetchGrades">


        
         </div>

        </div>

        <input type="hidden" name="" id="hd_mid">
        <input type="hidden" name="" id="hd_end">
        <input type="hidden" name="" id="hd_fn">
      </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-default btn btn-secondary" id="df_close" data-dismiss="modal">
          Close
              <span class="glyphicon glyphicon-remove-sign"></span>
          </button>
          <input type="hidden" name="action" value="get_edit_grades">
          <input type="submit" class="btn btn-primary fa fa-save" name="" id="btn_save" value="Save" style="display: none;">
                   
        </div>
        </form>       
    </div>
  </div>
</div>