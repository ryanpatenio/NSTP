<!-- Modal ADD STUDENT FORM -->



<div class="modal fade bd-example-modal-lg" id="enrollModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">LIST OF STUDENT NOT ALREADY ENROLL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<div class="card mb-3" id="table-container">
          <div class="card-header">
            <i class="fas fa-table"></i> 

            <input type="text" class="form-control" name="search" id="search" placeholder="Search">
            </div>
          <div class="card-body">

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
                  <?php
                  $list = getNotAlreadyEnrollStudent();
                  
                  foreach ($list as $row) {
                    # display all the data in the table

                    ?>
                <tr id="trr">
                    <td><?php echo $row['IDNO']; ?></td>
                    <td><?php echo $row['FNAME'].' '.$row['LNAME']; ?></td>
                    
                    <td>
                      <button class="btn btn-sm btn-success newEnrollBtn" id="<?php echo $row['IDNO']; ?>"><i class="fa fa-edit ">New Enroll</i></button>
                    </td>
                </tr>
                    <?php

                  }

                   ?>
                  
                </tbody>
              </table>
            </div>
          </div>
          
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="dis" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
<!-- Modal ADD STUDENT FORM -->
<?php
#function we will use

function getNotAlreadyEnrollStudent(){
  global $mydb;
  $mydb->setQuery("select * from students where ENROLLED = 0");
  $cur = $mydb->executeQuery();
  if($cur){
    return $cur;
  }else{
    return 0;
  }
}


 ?>
