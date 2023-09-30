<!-- Modal ADD GRADES FORM -->
<div class="modal" id="impModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-scrollable" role="document" style="background-color: rgba(192,192,192,0.98);box-shadow: 0 3px 20px 2px rgb(1 1 1 / 0.98);" > 
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">IMPORT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="lll" method="POST" enctype="multipart/form-data">
    

          <div class="row">
            
            <div class="col">

              <label style="font-family: verdana,sans-serif;"><strong>CLASS: <?php echo $cur->NSTP_PROGRAM.' '.$cur->SEC_NAME.' '.$cur->YR_SECTION ?></strong></label>
              <hr>
              <br>
              <label style="font-family: verdana,sans-serif;"><STRONG>SEMESTER</STRONG></label>
              <select class="form-control">
                <option>FIRST SEMESTER</option>
              </select>
              <hr>

              <input type="file" class="form-control" name="importFile" id="importFile"> 
            </div>


          </div>

              <p id="hh"></p>
       
      </div>
      <div class="modal-footer">
       <!--  <input type="hidden" name="action" id="action" value="getInfo"> -->
       <input type="hidden" name="action" id="action" value="import">
        <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="importBtn" id="importBtn2" class="btn btn-primary" value="IMPORT">
 
        
      </div>
 </form>
      
    </div>
  </div>
</div>