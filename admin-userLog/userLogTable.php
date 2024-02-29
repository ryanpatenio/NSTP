<div class="card mb-3" id="table-container">
          <div class="card-header">
            <i class="fas fa-table"></i> 

             <a href="printme.php" class="btn btn-sm btn-primary pr" ><i class="fa fa-print"> Print</i></a>
            </div>
          <div class="card-body">

          


            <div class="table-responsive">
                
              <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <?php

                    // $adminTbl = new myTable();

                    // $data = $adminTbl->displayIndexTable();

                   ?>

                  <tr>
                    <th>NO.</th>
                    <th>NAME</th>
                    <th>ACTIVITY</th>
                    <th>DATE</th>
                    <th>TYPE</th>
                    
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>NO.</th>
                    <th>NAME</th>
                    <th>ACTIVITY</th>
                    <th>DATE</th>
                    <th>TYPE</th>
                  </tr>
                </tfoot>
                <tbody>

                  <?php
                  $fetchData = getUserlog();
                  if($fetchData){
                    //create an array
                    $i = 1;
                    foreach ($fetchData as $row) { ?>
                      <tr>

                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['NAME']; ?></td>
                        <td><?php echo $row['ACTIVITY']; ?></td>
                        <td style="color: green;"><?php echo date("d M Y --  h : m : a",strtotime($row['ACTIVITY_DATE'])); ?></td>
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
        function getUserlog(){
          global $mydb;

          $mydb->setQuery("select * from user_log order by ACTIVITY_DATE desc");
          $cur = $mydb->executeQuery();

          if($cur){
            return $cur;
          }else{
            return 0;
          }
        }


         ?>