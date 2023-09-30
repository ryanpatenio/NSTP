<?php
include('../instructor-asset/header.php');
include('../inst-inside/sidebar-inside/sidebar.php');

if(!isset($_GET['IDNO'])){
	redirect(WEB_ROOT.'login.php');
}
$get_IDNO = $_GET['IDNO'];
$class_id = $_GET['id'];

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

      	<center><h4 class="center">STUDENT ATTENDANCE RECORD(s)</h4></center>
      	<br>
      	<br>
      	<?php
      	$data_name = getStudName($get_IDNO);
      	if($data_name !='0'){
      		?>

      		<p>Student Name : <b><?php echo $data_name; ?></b></p>

      		<?php
      	}


      	 ?>

      	
      	   <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>NO.</th>
                    <th>TOPIC</th>
                    <th>DATE</th>
                    <th>STATUS</th>
                   
                   
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $data_acad = getSY();

                  if($data_acad !='0'){
                    $acad = $data_acad->ACAD_ID;

                    $att_details = getStud_attendance($get_IDNO,$acad);
                    $i = 1;
                    foreach ($att_details as $res) {
                      # code...
                      ?>

                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $res['TOPIC']; ?></td>
                        <td><?php echo date("d M Y",strtotime($res['SESS_DATE'])); ?></td>
                        <td><?php echo $res['STATUS']; ?></td>
                        
                     </tr> 



                    <?php  

                   $i++; }

                  }

                   ?>



                 
                </tbody>
              </table>


 <?php

include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');

function getStud_attendance($IDNO,$acad){
  global $mydb;
  $mydb->setQuery("select att.ATT_ID,cl.TOPIC,cl.SESS_DATE,att.`STATUS` from class_sched cl,attendance att,students s where cl.CLASS_SCHED_ID = att.CLASS_SCHED_ID and att.IDNO = s.IDNO and att.ACAD_ID = '".$acad."' and att.IDNO ='".$IDNO."';");
  $cur = $mydb->executeQuery();
  
  if($cur){
    return $cur;
  }else{
    return 0;
  }
}

function getSY(){
  global $mydb;
  $mydb->setQuery("select * from acad_year where STATUS ='YES';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found;
  }else{
    return 0;
  }
}

function getStudName($IDNO){
  global $mydb;
  $mydb->setQuery("select * from students where IDNO = '".$IDNO."';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found->FNAME.' '.$found->LNAME;
  }else{
    return 0;
  }
}


  ?>

<script type="text/javascript">
	$(document).ready(function(){
		window.onload = window.print();
		window.location.href="../Inst-attendance/view.php?id=<?php echo $class_id; ?>&IDNO=<?php echo $get_IDNO; ?>";
	});
</script>