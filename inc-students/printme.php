<?php
include('../themeAsset/header.php');
include('../themeAsset/adminSidebar.php');

 ?>

 <style type="text/css">
  @media print{
    .sdd, .noprint, .ds, .comstud, .inc, .sched, .mod, .set,.set1, .ft *{
      display: none !important;
    }
  }

</style>

<div id="content-wrapper">

      <div class="container-fluid">

      	<center><h4 class="center">LIST OF INC STUDENT(s)</h4></center>
      	<br>
      	<br>

      	<table class="table table-bordered" width="100%" cellspacing="0">
                <thead>

                  <tr>
                  	<th>NO.</th>
                    <th>IDNO</th>
                    <th>FULL NAME</th>                   
                    <th>CLASS</th>                   
                    <th>SCHOOL YEAR</th>
                    <th>SEMESTER</th>
                    
                  </tr>
                </thead>
               
                <tbody>

                  <?php

                  $data = getInc();
                  if($data !='0'){
                  	$i = 1;
                    foreach ($data as $row) {
                      # code...
                      ?>

                  <tr>
                  	<td><?php echo $i; ?></td>
                    <td><?php echo $row['IDNO']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['CLASS_NAME']; ?></td>
                    <td><?php echo $row['SCHOOL_YEAR']; ?></td>
                    <td><?php echo $row['SEMESTER']; ?></td>
                   
                  </tr>


                      <?php


                  $i++;  }

                  }


                   ?>
               
                 
                </tbody>
              </table>

 <?php

include('../themeAsset/footer.php');
include('../themeAsset/script.php');

function getInc(){
  global $mydb;
  $mydb->setQuery("select en.IDNO,concat(s.FNAME,' ',s.LNAME) name,cl.CLASS_NAME,ac.SCHOOL_YEAR,ac.SEMESTER from enrollees en,students s,class cl,acad_year ac where en.IDNO = s.IDNO and en.CLASS_ID = cl.CLASS_ID and en.ACAD_ID = ac.ACAD_ID and en.R_STATUS = 'INC';");
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
		window.location.href="../inc-students/";
	});
</script>