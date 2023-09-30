<?php

include('../instructor-asset/header.php');
include('../instructor-asset/sidebar.php');

 ?>

<div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">SCHEDULE</h4>
        </ol>

<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i> <!-- <a class="btn btn-sm btn-primary sm" style="margin-left: 8px;" href="<?php //echo WEB_ROOT; ?>Inst-addSched/addSched.php"><i class="fa fa-plus" aria-hidden=true> New</i></a> -->


              <button class="btn btn-sm btn-primary sm" style="margin-left: 8px;" id="btn_addsched"><i class="fa fa-plus" aria-hidden=true> New</i></button>
              <a class="btn btn-sm btn-success" href="printme.php?inst_id=<?php echo $_SESSION['inst_id']; ?>"><i class="fa fa-print"> Print</i></a>

            </div>
          <div class="card-body">
            <div class="table-responsive">
                
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
                  <tr>
                    <th>NO.</th>
                    <th>TOPIC</th>
                    <th>DATE</th>
                    <th>CLASS</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $data_sched = getSched($_SESSION['inst_id']);
                  $i = 1;
                  foreach ($data_sched as $row) {
                    # code...
                    ?>
                     <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['TOPIC']; ?></td>
                        <td><?php echo date("d M Y",strtotime($row['SESS_DATE'])); ?></td>
                        <td><?php echo $row['CLASS_NAME']; ?></td>
                        <td><?php echo $row['STATUS']; ?></td>
                        <td>
                          <button class="btn btn-sm btn-warning" id="btn_edit" data-value="<?php echo $row['CLASS_SCHED_ID']; ?>"><i class="fa fa-edit"> Edit</i></button>
                        </td>
                    </tr>


                    <?php

               $i++;   }


                   ?>


                 
                 
                </tbody>
              </table>
            </div>
          </div>
        
        </div>


 <?php
 include('modal/add.php');
 include('modal/edit.php');
include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');

  ?>
  <script type="text/javascript" src="action/script.js"></script>

  <?php

  function getSched($inst_id){
    global $mydb;
    $mydb->setQuery("select cl.CLASS_SCHED_ID,cl.TOPIC,cl.SESS_DATE,cll.CLASS_NAME,cl.`STATUS` from class_sched cl, class cll,acad_year ac where cl.CLASS_ID = cll.CLASS_ID and cl.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and cll.INST_ID = '".$inst_id."';");
    $cur  = $mydb->executeQuery();

    if($cur){
      return $cur;
    }else{
      return 0;
    }
  }

   ?>