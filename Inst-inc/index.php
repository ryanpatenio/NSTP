<?php

include('../instructor-asset/header.php');
include('../instructor-asset/sidebar.php');

 ?>

<div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">INCOMPLETE</h4>
        </ol>

<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>

           <a href="printme.php?inst_id=<?php echo $_SESSION['inst_id']; ?>" class="btn btn-sm btn-primary" style="position: relative;margin: 0px;margin-top: 20px;margin-bottom: 20px;width: 100px;"><i class="fa fa-print"> Print</i></a>
          </div>
          <div class="card-body">

          


            <div class="table-responsive">
                
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>

                  
                  <tr>
                    <th>ID NO.</th>
                    <th>NAME</th>
                    <th>STATUS</th>                
                    <th>CLASS</th>
                    <th>SEMESTER</th>
                    <th>SCHOOL YEAR</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  $data_inc = getInc($_SESSION['inst_id']);

                  foreach ($data_inc as $row) {
                    # code...
                    ?>

                  <tr>
                    <td><?php echo $row['IDNO']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['R_STATUS']; ?></td>
                    <td><?php echo $row['CLASS_NAME']; ?></td>
                    <td><?php echo $row['SEMESTER']; ?></td>
                    <td><?php echo $row['SCHOOL_YEAR']; ?></td>
                    <td>
                      <a href="edit.php?IDNO=<?php echo $row['IDNO']; ?>" class="btn btn-sm btn-warning" id="editIncBtn" data-value=""><i class="fa fa-edit"> Edit</i></a>
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
include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');

  ?>

  <?php

function getInc($inst_id){
  global $mydb;
  $mydb->setQuery("select en.IDNO,concat(s.FNAME,' ',s.LNAME) as 'name',en.R_STATUS,cl.CLASS_NAME,ac.SEMESTER,ac.SCHOOL_YEAR from enrollees en,students s,acad_year ac,class cl where en.IDNO = s.IDNO and en.ACAD_ID = ac.ACAD_ID and en.CLASS_ID = cl.CLASS_ID and ac.`STATUS` = 'YES' and en.R_STATUS = 'INC' and cl.INST_ID = '".$inst_id."';");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}

   ?>