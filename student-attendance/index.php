<?php

include('../student-asset/header.php');
include('../student-asset/sidebar.php');

?>

 <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">NOTIFICATIONS</h4>
        </ol>

<div class="card mb-3" style="margin-top: 50px;">
          <div class="card-header">
            <i class="fas fa-table">  ATTENDANCE RECORD</i> 
            </div>
          <div class="card-body">
            <div class="table-responsive">
                
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
               
                  <tr>
                    <th>NO.</th>
                    <th>TOPIC</th>
                    <th>DATE</th>
                    <th>STATUS</th>
                    
                   
                  </tr>
                </thead>
                <tbody>
                 
                 <?php
                 $data = getData($IDNO);
                 $i = 1;

                 foreach ($data as $row) {
                   # code...
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['TOPIC']; ?></td>
                    <td><?php echo date("d M Y",strtotime($row['SESS_DATE'])); ?></td>

                    <?php

                    #color status
                    if($row['STATUS']=='Present'){
                      $color = 'green';
                    }else{
                      $color = 'red';
                    }

                     ?>


                    <td style="color:<?php echo $color; ?>;"><?php echo $row['STATUS']; ?></td>
                  </tr>


                  <?php


                 $i++; }



                  ?>
             
                 
                </tbody>
              </table>
            </div>
          </div>
          
        </div>

<?php


include('../student-asset/footer.php');
include('../student-asset/script.php');


function getData($IDNO){
  global $mydb;
  $mydb->setQuery("select cl.TOPIC,cl.SESS_DATE,att.`STATUS` from attendance att,acad_year ac,class_sched cl where att.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and att.IDNO = '".$IDNO."' and att.CLASS_SCHED_ID = cl.CLASS_SCHED_ID");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }

}

 ?>