<div class="modal fade bd-example-modal-lg" id="enrollModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Enroll</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        
        <div class="input-group">
                   <input class="form-control" type="text" name="txtsearch" id="textsearch" placeholder="Enter Student ID NUMBER">
                       <span class="input-group-append">
                      <button class="btn btn-primary" name="searchBtn" id="searchBtn">
                                  <i class="fa fa-search"></i>
                      </button>
                   </span>
        </div>
       
        <hr>
 <div class="table-responsive">
                
              <table class="table table-bordered tb" id="dataTable1" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID NO.</th>
                    <th>NAME</th>
                    
                    <th>ACTION</th>
                  </tr>
                </thead>
               
                <tbody id="tb">
                
                </tbody>
              </table>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="dis" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>