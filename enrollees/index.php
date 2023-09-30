<?php
include('../themeAsset/header.php');
include('../themeAsset/adminSidebar.php');

?>

 <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">LIST OF ENROLLEES</h4>
        </ol>


<div class="card mb-3" id="table-container">
          <div class="card-header">
            <i class="fas fa-table"></i> 

          <?php
          
          #if the semester is second you cant enroll new students
          #the valid can enroll students if the semester is first
          #you can only enroll existing once
           $whatSem = getSy();
            if($whatSem =='FIRST'){
              
              echo '</i> <a class="btn btn-sm btn-success sm" style="margin-left: 8px;" href="#" data-target="#enrollModal" data-toggle="modal"><i class="fa fa-plus" aria-hidden=true> New Enroll</i></a>';


            }else{
              //second sem
              #so you cant enroll new students
              #the existing ones only
            }


           ?>  


  <a class="btn btn-sm btn-primary sm" style="margin-left: 8px;" href="#" data-target="#re_enrollModal" data-toggle="modal"><i class="fa fa-plus" aria-hidden=true> Re-Enroll</i></a>

  <a href="printme.php" class="btn btn-sm btn-warning"><i class="fa fa-print"> Print</i></a>

            </div>
          <div class="card-body">

         
            <div class="table-responsive">
                
              <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                  <th>IDNO</th>                    
                    <th>NAME</th>
                    <th>STATUS</th>
                    
                    <th>CLASS</th>
                    <th>SEMESTER</th>
                    <th>SCHOOL YEAR</th>
                    
                  </tr>
                </thead>
               
                <tbody>

                  <?php
                
                  $enrolleesData = getAllEnrolleesData();
                  foreach ($enrolleesData as $rowData) {
                    #enrollees List
                    ?>  
                  <tr>
                    <td><?php echo $rowData['IDNO']; ?></td>
                      <td><?php echo $rowData['name']; ?></td>
                      <td><?php echo $rowData['STATUS']; ?></td>
                      <td><?php echo $rowData['CLASS_NAME']; ?></td>

                      <td><?php echo $rowData['SEMESTER']; ?></td>
                      <td><?php echo $rowData['SCHOOL_YEAR']; ?></td>
                      <!-- <td><button class="btn btn-sm btn-warning fa fa-edit re-enroll" id="<?php //echo $rowData['ENROLL_ID']; ?>" data-value="<?php  //echo $row['IDNO']; ?>"> Re-Enroll</button></td> -->
                      <!-- <td>
                         <a href="re_enroll.php?IDNO=<?php echo $rowData['IDNO'];?>&enroll_id=<?php echo $rowData['ENROLL_ID']; ?>" class="btn btn-sm btn-warning fa fa-edit ">Re-Enroll</a> 

                      </td> -->
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
include('modal/notAlreadyEnrollModal.php');
include('modal/search.php');
include('modal/newEnrollModal.php');
include('../themeAsset/footer.php');
include('../themeAsset/script.php');


 ?>
 <script type="text/javascript" src="action/script.js"></script>
 <script type="text/javascript" src="action/enrollingSecondScript.js"></script>
 <style type="text/css">
/*  setting the second modal z-index above the first modal     */
  #addNew{
    z-index: 9999;
   
    border-radius: 10px;
    justify-content: center;
     position: fixed;
     top: 0%;


  }

</style>

<?php
function getAllEnrolleesData(){
global $mydb;
  $mydb->setQuery("select concat(s.FNAME,' ',s.LNAME) as 'name',en.ENROLL_ID,s.IDNO,en.`STATUS`,cl.CLASS_NAME,ac.SEMESTER,ac.SCHOOL_YEAR from students s,enrollees en,class cl,acad_year ac where s.IDNO = en.IDNO and en.CLASS_ID = cl.CLASS_ID and en.ACAD_ID = ac.ACAD_ID and ac.STATUS ='YES';");

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