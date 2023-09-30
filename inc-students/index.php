<?php
include('../themeAsset/header.php');
include('../themeAsset/adminSidebar.php');

?>
<div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">LIST OF INC STUDENTS</h4>
        </ol>

<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
             <a href="printme.php?>" class="btn btn-sm btn-primary" style="position: relative;margin: 0px;margin-top: 20px;margin-bottom: 20px;width: 100px;"><i class="fa fa-print"> Print</i></a>
          </div>
          <div class="card-body">

            <div class="table-responsive">
                
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>

                  <tr>
                    <th>IDNO</th>
                    <th>FULL NAME</th>                   
                    <th>CLASS</th>                   
                    <th>SCHOOL YEAR</th>
                    <th>SEMESTER</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
               
                <tbody>

                  <?php

                  $data = getInc();
                  if($data !='0'){

                    foreach ($data as $row) {
                      # code...
                      ?>

                  <tr>

                    <td><?php echo $row['IDNO']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['CLASS_NAME']; ?></td>
                    <td><?php echo $row['SCHOOL_YEAR']; ?></td>
                    <td><?php echo $row['SEMESTER']; ?></td>
                    <td>
                      <a href="editInc.php?IDNO=<?php echo $row['IDNO']; ?>" class="btn btn-sm btn-warning fa fa-edit"> Edit</a>
                    </td>
                  </tr>


                      <?php


                    }

                  }


                   ?>
               
                 
                </tbody>
              </table>
            </div>
          </div>
        
        </div>


<?php


include('../themeAsset/footer.php');
include('../themeAsset/script.php');

function getInc(){
  global $mydb;
  $mydb->setQuery("select en.IDNO,concat(s.FNAME,' ',s.LNAME) name,cl.CLASS_NAME,ac.SCHOOL_YEAR,ac.SEMESTER from enrollees en,students s,class cl,acad_year ac where en.IDNO = s.IDNO and en.CLASS_ID = cl.CLASS_ID and en.ACAD_ID = ac.ACAD_ID and en.R_STATUS = 'INC';");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}


 ?>