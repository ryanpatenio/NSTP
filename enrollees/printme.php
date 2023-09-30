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
 	<center><h4 class="center">LIST OF ENROLLEES</h4></center>
 	<br>
 	<br>

 	<table class="table table-bordered "  width="100%" cellspacing="0">
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
                      
                  </tr>

                    <?php

                  }

                   ?>

                	
                  

                 
                </tbody>
              </table>

<?php

include('../themeAsset/footer.php');
include('../themeAsset/script.php');


function getAllEnrolleesData(){
global $mydb;
  $mydb->setQuery("select concat(s.FNAME,' ',s.LNAME) as 'name',en.ENROLL_ID,s.IDNO,en.`STATUS`,cl.CLASS_NAME,ac.SEMESTER,ac.SCHOOL_YEAR from students s,enrollees en,class cl,acad_year ac where s.IDNO = en.IDNO and en.CLASS_ID = cl.CLASS_ID and en.ACAD_ID = ac.ACAD_ID and ac.STATUS ='YES' order by CLASS_NAME asc;");

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
		window.location.href="../enrollees/";
	});
</script>