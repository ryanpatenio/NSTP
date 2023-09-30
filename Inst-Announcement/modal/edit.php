<!-- Modal ADD SCHEDULE -->
<div class="modal" id="editAnnouncement" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">UPDATE ANNOUNCEMENT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="editForm" method="POST">
          <input type="hidden" id="hiddenAnnID" name="hiddenAnnID">

        <div class="row">

        <div class="col">
            <label for="Topic"><strong>ANNOUNCEMENT</strong></label>
           <textarea class="form-control" id="annDataEdit" name="annDataEdit" placeholder="Type here!..." required="" style="height: 150px;"></textarea>
            
             <span id="error_editcontent" class="text-danger"></span>
        </div>

       
</div>


<div class="row">
  <div class="col" style="margin-top: 20px">
    <label><strong>SELECTED CLASS</strong></label>

      <input type="text" class="form-control" name="" id="sel_class" readonly="">

        <span id="error_class" class="text-danger"></span>
  </div>
</div>

      </div>
      <div class="modal-footer">
        <input type="hidden" name="action" value="edit">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" id="editBtn" name="" value="UPDATE" class="btn btn-primary">
       
      </div>
      </form>
    </div>
  </div>
</div>
