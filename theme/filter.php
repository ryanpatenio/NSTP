 <?php
require_once("../include/initialize.php");



if(isset($_POST['request'])){

	$requests = $_POST['request'];

switch ($requests) {
	case 'none':
		# code...

	?>

	<div class="card mb-3" id="table-container">
          <div class="card-header">
            <i class="fas fa-table"></i> <a class="btn btn-sm btn-primary sm" style="margin-left: 8px;" href="<?php echo WEB_ROOT; ?>addStudents/"><i class="fa fa-plus" aria-hidden=true> New</i></a>
            </div>
          <div class="card-body">

          


            <div class="table-responsive">
                
              <table class="table table-bordered table-container" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <?php

                    $adminTbl = new myTable();

                    $data = $adminTbl->displayIndexTable();

                   ?>

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

                  while($res = mysqli_fetch_array($data)){?>

                    <tr>
                        <td><?php echo $res[0]; ?></td>
                        <td><?php echo $res[1]; ?></td>
                        <td><?php  echo $res[2]; ?></td>
                        <td><?php echo $res[3]; ?></td>
                        <td><?php echo $res[4]; ?></td>

                        <td>
                          
                          <a class="btn btn-sm btn-primary" href="theme/view.php?viewDetails=view&id=<?php echo $res[0]; ?>"><i class="fa fa-search"> View</i>
                          </a>

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
<?php
	
		break;

	default:
		# code...

	?>

		<div class="card mb-3" id="table-container">
          <div class="card-header">
            <i class="fas fa-table"></i> <a class="btn btn-sm btn-primary sm" style="margin-left: 8px;" href="<?php echo WEB_ROOT; ?>addStudents/"><i class="fa fa-plus" aria-hidden=true> New</i></a>
            </div>
          <div class="card-body">

          


            <div class="table-responsive">
                
              <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <?php

                    $adminTbl = new myTable();

                   $datas = $adminTbl::filterDisplay($requests);

                   ?>

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



                  while($res = mysqli_fetch_array($datas)){?>

                    <tr>
                        <td><?php echo $res[0]; ?></td>
                        <td><?php echo $res[1]; ?></td>
                        <td><?php  echo $res[2]; ?></td>
                        <td><?php echo $res[3]; ?></td>
                        <td><?php echo $res[4]; ?></td>

                        <td>
                          
                          <a class="btn btn-sm btn-primary" href="theme/view.php?viewDetails=view&id=<?php echo $res[0]; ?>"><i class="fa fa-search"> View</i>
                          </a>

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





	 	
	
	<?php	break;
}

}



?>