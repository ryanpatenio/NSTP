<div class="card mb-3" id="table-container">
          <div class="card-header">
            <i class="fas fa-table"></i> 

            
             <a href="add.php"class="btn btn-sm btn-primary" id="add" ><i class="fa fa-plus"> ADD</i></a>
            </div>
          <div class="card-body">

          


            <div class="table-responsive">
                
              <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                

                  <tr>
                    <th>NO.</th>
                    <th>NAME</th>
                    <th>USERNAME</th>
                  
                    <th>TYPE</th>
                    
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>NO.</th>
                    <th>NAME</th>
                    <th>USERNAME</th>
                  
                    <th>TYPE</th>
                  </tr>
                </tfoot>
                <tbody>

                  <?php
                   $fetchData =  getUserData();
                  if($fetchData){
                    //create an array
                    $i = 1;
                    foreach ($fetchData as $row) { ?>
                      <tr>

                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['FNAME'].' '.$row['LNAME']; ?></td>
                        <td><?php echo $row['USERNAME']; ?></td>
                       
                        <td><?php echo $row['TYPE']; ?></td>

                      </tr>


                  <?php $i++; }
                  }



                   ?>
               
                </tbody>
              </table>
            </div>
          </div>
          
        </div>

<?php

function getUserData(){
  global $mydb;
  $mydb->setQuery("select * from user");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}



 ?>