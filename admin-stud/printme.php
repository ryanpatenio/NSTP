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
      	<center><h4 class="center">LIST OF STUDENTS</h4></center>
      	<br>
      	<br>


      	       <table class="table table-bordered " width="100%" cellspacing="0">
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
                  $data = getStudentst();
                   
                  foreach ($data as $row) {
                    # display the data
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

 <?php
include('../themeAsset/footer.php');
include('../themeAsset/script.php');


function getStudentst(){
  global $mydb;
  $mydb->setQuery("select s.IDNO,concat(s.FNAME,' ',s.LNAME) as 'name',st.GENDER,st.ADDRESS,st.CONTACT from students s,stud_details st where s.IDNO = st.IDNO");
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
		window.location.href="../admin-stud/";
	});
</script>