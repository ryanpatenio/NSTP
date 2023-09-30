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

      	 <center><h4 class="center">NOTIFICATIONS</h4></center>

      	 <br>
      	 <br>

        <table id="ready" class="table table-striped tabled-bordered" width="100%;">
          <thead>

           
            <tr>
                <th>No.</th>
                <th>STUDENT</th>
                <th>MESSAGE</th>
                <th>DATE</th>
                               
            </tr>
          </thead>
         

            <tbody>

            <?php
                  $data = getT_notif($inst_id);
                  if($data !='0'){
                    $i = 1;
                    foreach ($data as $row) {
                      # code...
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['MESSAGE']; ?></td>
                        <td><?php  echo date("d M Y",strtotime($row['UPLOADED_DATE'])); ?></td>
                      </tr>

                      <?php



                  $i++;  }


                  }

                   ?>
              
             
             
            </tbody>
        </table>



 <?php
include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');
#set function
function getT_notif($inst_id){
  global $mydb;
  $mydb->setQuery("select tf.T_NOTIF_ID,concat(s.FNAME,'',s.LNAME) name,tf.MESSAGE,tf.READM,tf.UPLOADED_DATE from teacher_notif tf,students s,acad_year ac,class cl where tf.IDNO = s.IDNO and tf.ACAD_ID = ac.ACAD_ID and tf.CLASS_ID = cl.CLASS_ID and ac.`STATUS` = 'YES' and cl.INST_ID = '".$inst_id."' order by tf.T_NOTIF_ID desc;");
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
		window.location.href="../Inst-Notif/";
	});
</script>
