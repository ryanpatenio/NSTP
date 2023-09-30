<?php
include('../instructor-asset/header.php');
include('../inst-inside/sidebar-inside/sidebar.php');

 ?>

  <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">ENROLLEES</h4>
        </ol>


<div class="card mb-3" id="table-container">
	<input type="hidden" id="hidden_id" name="" value="<?php echo $id; ?>">

          <div class="card-header">
            <i class="fas fa-table"></i> 
</i>


 <a class="btn btn-sm btn-primary sm" style="margin-left: 8px;" href="#" data-target="#enrollModal" data-toggle="modal"><i class="fa fa-plus" aria-hidden=true> Re-Enroll</i></a>
 <a href="printme.php?class_id=<?php echo $id; ?>&id=<?php echo $id; ?>" class="btn btn-sm btn-success" style="position: relative;margin: 0px;margin-top: 20px;margin-bottom: 20px;width: 100px;"><i class="fa fa-print"> Print</i></a>
            
            </div>
          <div class="card-body">

         
            <div class="table-responsive">
                
              <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>IDNO</th>                   
                    <th>NAME</th>
                    <th>CLASS</th>
                    <th>SEMESTER</th>
                    <th>SCHOOL YEAR</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
               
                <tbody>
                <?php
                $data_enrollees = getEnrollees($id);
                foreach ($data_enrollees as $row) {
                  # code...
                  echo '<tr>';

                    echo '<td>'.$row['IDNO'].'</td>';
                    echo '<td>'.$row['name'].'</td>';
                    echo '<td>'.$row['CLASS_NAME'].'</td>';
                    echo '<td>'.$row['SEMESTER'].'</td>';
                    echo '<td>'.$row['SCHOOL_YEAR'].'</td>';
                    echo '<td>
                      <button class="btn btn-sm btn-warning" id="btn_edit" data-value="'.$row['ENROLL_ID'].'"><i class="fa fa-edit"> Modify</i></button>
                    </td>';

                  echo '</tr>';
                }

                 ?>
                </tbody>
              </table>
            </div>
          </div>
          
        </div>


<?php
include('modal/search.php');
include('modal/edit.php');
include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');

 ?>

 <script type="text/javascript" src="action/script.js"></script>

 <?php

function getEnrollees($id){
  global $mydb;
  $mydb->setQuery("select en.ENROLL_ID, en.IDNO,concat(s.FNAME,' ',s.LNAME) as 'name',cl.CLASS_NAME,ac.SEMESTER,ac.SCHOOL_YEAR from enrollees en,students s,class cl,acad_year ac where en.IDNO = s.IDNO and en.CLASS_ID = cl.CLASS_ID and en.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and en.CLASS_ID='".$id."';");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}

  ?>