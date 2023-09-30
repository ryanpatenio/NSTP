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

      	<center><h4 class="center">LIST OF INSTRUCTOR(s)</h4></center>
      	<br>
      	<br>


              <table class="table table-bordered" width="100%" cellspacing="0">

                <thead>
                  <tr>
                    <th>NO.</th>
                    <th>Instructor Name</th>
                    <th>Email</th>                   
                  </tr>
                </thead>
                
                <tbody>


                  <?php 

                    $data = getInstructor();
                   

                      $i= 1;
                      while($row = mysqli_fetch_array($data)){  ?>

                      <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['FNAME'].' '.$row['LNAME']; ?></td>
                            <td><?php echo $row['USERNAME']; ?></td>

                  </tr>


                   <?php   $i++; }

                   ?>


                  
                 
                </tbody>
              </table>

<?php

include('../themeAsset/footer.php');
include('../themeAsset/script.php');


function getInstructor(){
  global $mydb;
  $mydb->setQuery("select * from instructor");
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
		window.location.href="../instructor/";
	});
</script>