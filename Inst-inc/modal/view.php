<!-- Modal ADD GRADES FORM -->
<div class="modal" id="infoModalInc" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">INCOMPLETE STUDENT INFORMATION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        
          <div class="form-group">

            <label for="recipient-name" class="col-form-label"><strong>NAME:</strong></label>
           <p id="modTitle" style="font-family: Verdana,sans-serif">Ryan Wong</p>
          </div>

          <div class="form-group">

            <label for="message-text" class="col-form-label"><strong>SEMESTER:</strong></label>
            <!-- <textarea class="form-control" id="message-text" style="height: 180px;" readonly=""></textarea> -->
            <p id="modDesc" style="font-family: Verdana,sans-serif"><?php echo $sem; ?></p>

          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label"><strong>REASON:</strong></label>
            <label id="modReason" style="width: 450px;height: 200px;color: red;"></label>
           
          </div>
        </form>
       
      </div>
      <div class="modal-footer">
       <!--  <input type="hidden" name="action" id="action" value="getInfo"> -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>

      
    </div>
  </div>
</div>