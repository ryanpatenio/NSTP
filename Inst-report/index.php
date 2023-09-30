<?php

include('../instructor-asset/header.php');
include('../instructor-asset/sidebar.php');

if(!isset($_GET['class_id'])){
  redirect(WEB_ROOT.'login.php');
}

$class_id = $_GET['class_id'];

 ?>

 <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">STUDENT LIST</h4>
        </ol>


          

 <a href="print.php?mpt=exportPrint&cl=<?php echo $sect_id; ?>&acd=<?php echo $acad; ?>&sm=<?php echo $sem1; ?>" class="btn btn-sm btn-primary" style="position: relative;margin: 0px;margin-top: 20px;margin-bottom: 20px;width: 100px;"><i class="fa fa-print"> Print</i></a>



 <!-- <a href="exportData.php?xpt=export&cl=<?php echo $sect_id; ?>&acd=<?php echo $acad; ?>&sm=<?php echo $sem1; ?>&stsem=<?php echo $statSem; ?>&cyst=<?php echo $cyss; ?>&name=<?php echo $name_inst; ?>&ctz=<?php echo $CYS; ?>" class="btn btn-sm btn-success" style="position: relative;margin: 0px;margin-top: 20px;margin-bottom: 20px;width: 150px;"><i class="fa fa-download"> EXPORT CSV</i></a> -->

<a href="createCsv.php?class_id=<?php echo $class_id; ?>" class="btn btn-sm btn-success"><i class="fa fa-print"> EXPORT CSV FILES</i></a>


  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
                <th>No.</th>
                <th>ID NUMBER</th>
                <th>NAME OF STUDENTS</th>
                <th>MID TERM</th>
                <th>END TERM</th>
                <th>FINAL GRADE</th>
                <th>ACTION TAKEN</th>
            </tr>
          </thead>        
            <tbody id="row1">

              <?php

              $data = getData($class_id);
              $i=1;
              if($data != '0'){

                foreach ($data as $row) {
                  # code...
                  ?>

                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['IDNO']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['MID_TERM']; ?></td>
                    <td><?php echo $row['END_TERM']; ?></td>
                    <td><?php echo $row['FINAL']; ?></td>
                    <td><?php echo $row['REMARKS']; ?></td>
                  </tr>




                  <?php

               $i++; }


              }

               ?>



            </tbody>
        </table>


<?php
include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');


#set function
function getData($class_id){
  global $mydb;
  $mydb->setQuery("select s.IDNO,concat(s.FNAME,' ',s.LNAME) name,gr.MID_TERM,gr.END_TERM,gr.FINAL,gr.REMARKS from enrollees en,students s,grades gr,class cl,acad_year ac where en.IDNO = s.IDNO and en.ENROLL_ID = gr.ENROLL_ID and en.CLASS_ID = cl.CLASS_ID and en.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and cl.CLASS_ID = '".$class_id."';");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;

  }
}



 ?>