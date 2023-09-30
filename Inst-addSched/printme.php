<?php

include('../instructor-asset/header.php');
include('../instructor-asset/sidebar.php');

if(!isset($_GET['inst_id'])){
	redirect(WEB_ROOT.'login.php');
}
$inst_id = $_GET['inst_id'];

 ?>


 <style type="text/css">
  @media print{
    .sd, .noprint, .ds, .comstud, .inc, .sched, .mod, .set,.set1, .ft *{
      display: none !important;
    }
  }

</style>

<div id="content-wrapper">

      <div class="container-fluid">

      	
         <center><h4 class="center">SCHEDULES</h4></center>
       	<br>
       	<br>

       	<table class="table table-bordered" width="100%" cellspacing="0">

                <thead>
                  <tr>
                    <th>NO.</th>
                    <th>TOPIC</th>
                    <th>DATE</th>
                    <th>CLASS</th>
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
                       
                        
                    </tr>


                    <?php

               $i++;   }


                   ?>


                 
                 
                </tbody>
              </table>


 <?php
include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');


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

<script type="text/javascript">
	$(document).ready(function(){
		window.onload = window.print();
		window.location.href="../Inst-addSched/";
	});
</script>