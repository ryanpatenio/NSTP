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

      	
         <center><h4 class="center">LIST OF MODULES</h4></center>
       	<br>
       	<br>


       	        <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                   <th>NO.</th>
                    <th>TITLE</th>
                    <th>DATE UPLOADED</th>
                    
                  </tr>
                </thead>

                <tbody>

                  <?php
                  $data_mod = getModule($inst_id);
                  $i = 1;
                  foreach ($data_mod as $row) {
                    # code...
                    ?>

                  <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row['FILE_TITLE']; ?></td>
                      <td><?php echo date("d M Y",strtotime($row['FILE_IN'])); ?></td>
                     
           
                  </tr>

                    <?php


                 $i++; }

                   ?>


              
                 
                </tbody>
              </table>



 <?php

include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');

function getModule($inst_id){
  global $mydb;
  $mydb->setQuery("select mo.MOD_ID,mo.FILE_TITLE,mo.FILE_IN,mo.`STATUS` from module mo,acad_year ac,instructor inst where mo.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and mo.INST_ID = inst.INST_ID and inst.INST_ID = '".$inst_id."';");
  $cur = $mydb->executeQuery();

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
		window.location.href="../Inst-module/";
	});
</script>