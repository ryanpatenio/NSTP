<?php

include('../themeAsset/header.php');
include('../themeAsset/adminSidebar.php');

if(!isset($_GET['IDNO'])){
	redirect(WEB_ROOT.'login.php');
}

$get_IDNO = $_GET['IDNO'];

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

      	<center><h4 class="center">STUDENT DETAILS</h4></center>
      	<br>
      	<br>

      		

      <?php
      	$data_name = getStudentName($get_IDNO);
      	if($data_name !='0'){
      		?>

      		<p>Student Name : <b><?php echo $data_name; ?></b></p>

      		<?php
      	}


      	 ?>

      	<table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                  <td>NO.</td>                    
                    <th>ACTIVITY</th>
                    <th>CLASS</th>
                    
                    
                    <th>SEMESTER</th>
                    <th>SCHOOL YEAR</th>
                   
                  
                   <th>INCHARGE</th>
                   <th>TYPE</th>
                  </tr>
                </thead>              
                <tbody>	
                <?php
                $data = getStudentHistory($get_IDNO);
                if($data !='0'){
                	$i = 1;
                	foreach ($data as $row) {
                		# code...
                		?>

                		<tr>
                			<td><?php echo $i; ?></td>
                			<td><?php echo $row['ACTIVITY']; ?></td>
                			<td><?php echo $row['CLASS_NAME']; ?></td>
                			<td><?php echo $row['SEMESTER']; ?></td>
                			<td><?php echo $row['SCHOOL_YEAR']; ?></td>
                			
                		
                      <td><?php echo $row['PERSON_INCHARGE']; ?></td>
                			<td><?php echo $row['PERSON_POSITION']; ?></td>

                		</tr>

                		<?php

                $i++;	}



                }


                 ?>


                 
                </tbody>
              </table>

 <?php
include('../themeAsset/footer.php');
include('../themeAsset/script.php');

function getStudentHistory($IDNO){
	global $mydb;
	$mydb->setQuery("select sh.HISTORY_ID,sh.ACTIVITY,sh.H_DATE,cl.CLASS_NAME,ac.SEMESTER,ac.SCHOOL_YEAR,sh.PERSON_INCHARGE,sh.PERSON_POSITION from students s,student_history sh,class cl,acad_year ac where s.IDNO = sh.IDNO and sh.CLASS_ID = cl.CLASS_ID and sh.ACAD_ID = ac.ACAD_ID and sh.IDNO = '".$IDNO."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

function getStudentName($IDNO){
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
		window.location.href="../report/view.php?IDNO=<?php echo $get_IDNO; ?>";
	});
</script>