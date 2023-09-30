<?php
include('../instructor-asset/header.php');
include('../instructor-asset/sidebar.php');

if(!isset($_GET['inst_id']))
{
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

      	
         <center><h4 class="center">LIST OF INC STUDENTS</h4></center>
       	<br>
       	<br>

       	    <table class="table table-bordered"  width="100%" cellspacing="0">
                <thead>

                  
                  <tr>
                    <th>ID NO.</th>
                    <th>NAME</th>
                    <th>STATUS</th>                
                    <th>CLASS</th>
                    <th>SEMESTER</th>
                    <th>SCHOOL YEAR</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php

                  $data_inc = getInc($inst_id);

                  foreach ($data_inc as $row) {
                    # code...
                    ?>

                  <tr>
                    <td><?php echo $row['IDNO']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['R_STATUS']; ?></td>
                    <td><?php echo $row['CLASS_NAME']; ?></td>
                    <td><?php echo $row['SEMESTER']; ?></td>
                    <td><?php echo $row['SCHOOL_YEAR']; ?></td>
                   

                    <?php


                  }


                   ?>

              
                </tbody>
              </table>


 <?php
include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');

function getInc($inst_id){
  global $mydb;
  $mydb->setQuery("select en.IDNO,concat(s.FNAME,' ',s.LNAME) as 'name',en.R_STATUS,cl.CLASS_NAME,ac.SEMESTER,ac.SCHOOL_YEAR from enrollees en,students s,acad_year ac,class cl where en.IDNO = s.IDNO and en.ACAD_ID = ac.ACAD_ID and en.CLASS_ID = cl.CLASS_ID and ac.`STATUS` = 'YES' and en.R_STATUS = 'INC' and cl.INST_ID = '".$inst_id."';");
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
		window.location.href="../Inst-inc/";
	});
</script>