<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            <a class="btn btn-sm btn-primary sm" style="margin-left: 8px;" href="<?php echo WEB_ROOT; ?>addStudents/"><i class="fa fa-plus" aria-hidden=true> New</i></a>
            </div>
          <div class="card-body">

          


            <div class="table-responsive">
                
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <?php $rotcData = new myTable(); ?>
                <thead>
                  <tr>
                    <th>ID NO.</th>
                    <th>Full Name</th>
                    <th>NSTP Program</th>
                    <th>Course</th>
                    <th>Academic Year</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID NO.</th>
                    <th>Full Name</th>
                    <th>NSTP Program</th>
                    <th>Course</th>
                    <th>Academic Year</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>

                  <?php 

                    $data = $rotcData->displayRotcAdmin();
                    $i = 1;
                    while($row = mysqli_fetch_array($data)){?>

                      <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row[2]; ?></td>
                          <td><?php echo $row[3]; ?></td>
                          <td><?php echo $row[4]; ?></td>
                          <td><?php echo $row[5]; ?></td>

                          <td>
                           <button class="btn btn-sm btn-danger editModal" id="<?php echo $row[0]; ?>"><i class="fa fa-edit"> Edit</i>
                       
                      </button>

                            <button class="btn btn-sm btn-primary view_student" id="<?php echo $row[0] ?>"><i class="fa fa-search"> View</i>
                          </button>
                          </td>
                   
                  </tr>

                 <?php  $i++; }

                  ?>
                  
                 
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>