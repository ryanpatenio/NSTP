<?php

include('../themeAsset/header.php');
include('../themeAsset/adminSidebar.php');

?>

<div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">LIST OF STUDENTS</h4>
        </ol>


<!--------Table-------->

<div class="card mb-3" id="table-container">
          <div class="card-header">
            <i class="fas fa-table"></i>
            <button class="btn btn-sm btn-primary " id="displayADDBtn"><i class="fa fa-plus"> New</i></button>
           



             <a href="printme.php" class="btn btn-sm btn-success" style="position: relative;margin: 0px;margin-top: 20px;margin-bottom: 20px;width: 100px;"><i class="fa fa-print"> Print</i></a>
             
             <button class="btn btn-sm btn-primary" id="disModalBtn"><i class="fa fa-file-export"> Export</i></button>
            </div>
          <div class="card-body">

            <div class="table-responsive">
                
              <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID NO.</th>
                    <th>NAME</th>
                    <th>GENDER</th>
                    <th>ADDRESS</th>
                    <th>CONTACT</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
               
                <tbody>
                  <?php
                  $data = getStudentst();
                   
                  foreach ($data as $row) {
                    # display the data
                   echo '<tr>';
                      echo '<td>'.$row['IDNO'].'</td>';
                      echo '<td>'.$row['name'].'</td>';
                      echo '<td>'.$row['GENDER'].'</td>';
                      echo '<td>'.$row['ADDRESS'].'</td>';
                      echo '<td>'.$row['CONTACT'].'</td>';
                      echo '<td><button class="btn btn-sm btn-warning fa fa-edit editBtnData" id="'.$row['IDNO'].'"> Modify</button>
                      <a href="view.php?IDNO='.$row['IDNO'].'" class="btn btn-sm btn-primary"><i class="fas fa-search"></i>View</a>


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

include('../themeAsset/footer.php');
include('../themeAsset/script.php');
include('modal/add.php');
include('modal/edit.php');
include('modal/report.php');
 ?>

<script type="text/javascript" src="action/script.js"></script>
 <?php

function getStudentst(){
  global $mydb;
  $mydb->setQuery("select s.IDNO,concat(s.FNAME,' ',s.LNAME) as 'name',st.GENDER,st.ADDRESS,st.CONTACT from students s,stud_details st where s.IDNO = st.IDNO");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}


  ?>