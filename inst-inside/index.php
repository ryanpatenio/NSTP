<?php
include('../instructor-asset/header.php');
include('sidebar-inside/sidebar.php');


 ?>
 <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">LIST OF STUDENTS</h4>
        </ol>

<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i><!-- <a class="btn btn-sm btn-primary sm" style="margin-left: 8px;" href="../Inst-inside/addStudent.php?<?php //echo 'id='.$id; ?>"><i class="fa fa-plus" aria-hidden=true> New</i></a> -->


            <?php

            #lets check if the school year semester is first or second
            #if first the instructor can add new student but if it is second semester the instructor cannot but can only re enroll students
            $whatSem = getSy();
            if($whatSem =='FIRST'){
              //the instructor can add new student
              echo '<button class="btn btn-sm btn-primary sm" style="margin-left: 8px;" id="btn_addStudent"><i class="fa fa-plus" aria-hidden=true> New</i></button>';

            }else{
              //the instructor cannot add new student but it can only re enroll students
             
            }


             ?>

            

           <a href="printme.php?class_id=<?php echo $id; ?>&id=<?php echo $id; ?>" class="btn btn-sm btn-success" style="position: relative;margin: 0px;margin-top: 20px;margin-bottom: 20px;width: 100px;"><i class="fa fa-print"> Print</i></a>

            </div>
          <div class="card-body">

            <div class="table-responsive">
                
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

     
                <thead>
                  <tr>
                    <th>ID NO.</th>
                    <th>NAME</th>
                    <th>GENDER</th>
                    <th>ADDRESS</th>
                    <th>CONTACT</th>
                  
                  </tr>
                </thead>

                <tbody>
                  <?php
                  $data = getStudents($id);
                  foreach ($data as $row) {
                    # code...
                    echo '<tr>';
                      echo '<td>'.$row['IDNO'].'</td>';
                      echo '<td>'.$row['name'].'</td>';
                      echo '<td>'.$row['GENDER'].'</td>';
                      echo '<td>'.$row['ADDRESS'].'</td>';
                      echo '<td>'.$row['CONTACT'].'</td>';

                     
                    echo '</tr>';
                  }


                   ?>
                </tbody>
              </table>
            </div>
          </div>
         
        </div>



 <?php
include('modal/addModal.php');
include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');


  ?>

  <script type="text/javascript" src="action/script.js"></script>

  <?php
function getStudents($id){
  global $mydb;
  $mydb->setQuery("select en.IDNO,concat(s.FNAME,' ',s.LNAME) as 'name',st.GENDER,st.ADDRESS,st.CONTACT from enrollees en,students s,stud_details st,acad_year ac where en.IDNO = s.IDNO and en.IDNO = st.IDNO and en.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and en.CLASS_ID='".$id."';");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}

function getSy(){
  global $mydb;
  $mydb->setQuery("select * from acad_year where STATUS ='YES';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found->SEMESTER;
  }else{
    return 0;
  }

}

   ?>