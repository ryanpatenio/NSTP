<?php

include('../themeAsset/header.php');
include('../themeAsset/adminSidebar.php');


?>

 <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">LIST OF SCHOOL YEAR</h4>
        </ol>




<!------Table------->

<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>

            <button class="btn btn-sm btn-primary" id="addModal" style="margin-bottom: 2px;"><i class="fa fa-plus"> Add New</i></button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
                
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
             
                <thead>
                  <tr>
                    <th>SCHOOL YEAR</th>
                    <th>SEMESTER</th>
                    <th>IS DEFAULT?</th>                   
                    <th>Action</th>
                    
                  </tr>
                </thead>            
                <tbody>

                  <?php

                  $mydb->setQuery("Select * from acad_year");
                  $cur = $mydb->executeQuery();
                  foreach ($cur as $row) { ?>
                    <tr>
                      <td><?php echo $row['SCHOOL_YEAR']; ?></td>
                      <td><?php echo $row['SEMESTER']; ?></td>
                      <td><?php echo $row['STATUS']; ?></td>
                      <td>
                        <button type="button" class="btn btn-sm btn-warning fas fa-edit" id="modi" data-value="<?php echo $row['ACAD_ID']; ?>">Modify</button>

                      </td>
                   </tr>
             <?php    } ?>


               
                </tbody>
              </table>
            </div>
          </div>
         
        </div>


<?php
include('modal/add.php');
include('modal/edit.php');
include('../themeAsset/footer.php');
include('../themeAsset/script.php');

 ?>
 <script type="text/javascript" src="action/script.js"></script>