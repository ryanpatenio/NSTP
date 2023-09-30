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

      	<center><h4 class="center">USER LOG</h4></center>
      	<br>
      	<br>

 <table class="table table-bordered " width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>NO.</th>
                    <th>NAME</th>
                    <th>ACTIVITY</th>
                    <th>DATE</th>
                    <th>TYPE</th>
                    
                  </tr>
                </thead>                
                <tbody>

                  <?php
                  $fetchData = getUserlog();
                  if($fetchData){
                    //create an array
                    $i = 1;
                    foreach ($fetchData as $row) { ?>
                      <tr>

                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['NAME']; ?></td>
                        <td><?php echo $row['ACTIVITY']; ?></td>
                        <td style="color: green;"><?php echo date("d M Y --  h : m : a",strtotime($row['ACTIVITY_DATE'])); ?></td>
                        <td><?php echo $row['TYPE']; ?></td>

                      </tr>


                  <?php $i++; }
                  }



                   ?>
               
                </tbody>
              </table>


<?php

include('../themeAsset/footer.php');
include('../themeAsset/script.php');


       function getUserlog(){
          global $mydb;

          $mydb->setQuery("select * from user_log order by ACTIVITY_DATE desc");
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
		window.location.href="../admin-userlog/";
	});
</script>