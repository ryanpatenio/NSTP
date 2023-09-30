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

      	
         <center><h4 class="center">ANNOUNCEMENT</h4></center>
       	<br>
       	<br>


      	 <table id="ready" class="table table-striped tabled-bordered" width="100%;" cellspacing="0">
          <thead>

           
            <tr>
                <th>NO.</th>
                <th>ANNOUNCEMENT</th>
                <th>DATE</th>     
                               
            </tr>
          </thead>
         

            <tbody>

				<?php
                  $data = getAnnouncement($inst_id);
                  $i=1;
                  foreach ($data as $row) {
                    # code...
                    ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row['CONTENT']; ?></td>
                      <td><?php echo date("d M Y",strtotime($row['ANN_DATE'])); ?></td>
                      
                    </tr>

                    <?php
                $i++;  }


                   ?>
             
             
            </tbody>
        </table>

 <?php 
include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');


function getAnnouncement($inst_id){
  global $mydb;
  $mydb->setQuery("select ann.ANN_ID,ann.CONTENT,ann.ANN_DATE from announcement ann,acad_year ac,class cl where ann.ACAD_ID = ac.ACAD_ID and ann.CLASS_ID = cl.CLASS_ID and ac.STATUS ='YES' and cl.INST_ID = '".$inst_id."';");
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
		window.location.href="../Inst-Announcement/";
	});
</script>
