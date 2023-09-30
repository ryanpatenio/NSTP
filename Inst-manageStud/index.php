<?php
include('../instructor-asset/header.php');
include('../inst-inside/sidebar-inside/sidebar.php');

 ?>
<div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">Manage Students</h4>
        </ol>
<input type="hidden" name="hidden_class_id" id="hidden_class_id" value="<?php echo $id; ?>">

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i> 

            </div>
          <div class="card-body">
            <div class="table-responsive">
                
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID NO.</th>
                    <th>NAME</th>                 
                    <th>CLASS</th>
                    <th>SEMESTER</th>
                    <th>SCHOOL YEAR</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                
                <tbody>
                 <?php
                 $data = getEnrollees($id);
                 foreach ($data as $row) {
                   # code...
                  ?>
                   <tr>
                      <td><?php echo $row['IDNO']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['CLASS_NAME']; ?></td>
                      <td><?php echo $row['SEMESTER']; ?></td>
                      <td><?php echo $row['SCHOOL_YEAR']; ?></td>
                      <td>
                         <button class="btn btn-sm btn-primary addGrades" id="<?php echo $row['IDNO']; ?>" data-value="<?php echo $row['ACAD_ID']; ?>" value="<?php echo $row['ENROLL_ID']; ?>"><i class="fa fa-plus"> Grades</i></button>

                         <button class="btn btn-sm btn-danger addInc" id="<?php echo $row['IDNO']; ?>" data-value="<?php echo $row['ACAD_ID']; ?>"><i class="fa fa-plus"> INC</i></button>

                         <button class="btn btn-sm btn-secondary addDrop" id="<?php echo $row['IDNO']; ?>" data-value="<?php echo $row['ACAD_ID']; ?>"><i class="fa fa-plus"> DROP</i></button>
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
include('modal/addGrades.php');
include('modal/addInc.php');
include('modal/addDrop.php');
include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');

?>
<script type="text/javascript" src="action-grades/script-grades.js"></script>
<script type="text/javascript" src="action-inc/script-inc.js"></script>
<script type="text/javascript" src="action-drop/script-drop.js"></script>

<?php

#set all function to be used

function getEnrollees($id){
  global $mydb;
  $mydb->setQuery("select en.ENROLL_ID,en.ACAD_ID,en.IDNO,concat(s.FNAME,' ',s.LNAME) as 'name',cl.CLASS_NAME,ac.SEMESTER,ac.SCHOOL_YEAR from enrollees en,students s,class cl,acad_year ac where en.IDNO = s.IDNO and en.CLASS_ID = cl.CLASS_ID and en.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and en.CLASS_ID ='".$id."' and en.R_STATUS not in('INC','DROP','DONE');");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}

 ?>