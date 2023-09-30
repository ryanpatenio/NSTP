<?php

include('include/header.php');
include('include/sidebar.php');

if(!isset($_GET['SY']) && !isset($_GET['SEM'])){
	redirect(WEB_ROOT.'login.php');
}

$get_SY = $_GET['SY'];
$get_sem = $_GET['SEM'];




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

      	 <table class="table table-bordered " id="dt_table" width="100%" cellspacing="0">
                <thead>
                  <tr>
                  	<th>NO.</th>
                    <th>ID NO.</th>
                    <th>NAME</th>
                    <th>SCHOOL YEAR</th>
                    <th>SEMESTER</th>
                   
                  </tr>
                </thead>
               
                <tbody>
                	<?php

                	$data_filter = getStudent($get_SY,$get_sem);
                	if($data_filter !='0'){
                		$i = 1;
                		foreach ($data_filter as $row) {
                			# code...
                			?>
                			<tr>
                				<td><?php echo $i; ?></td>
			               		<td><?php echo $row['IDNO']; ?></td>
			               		<td><?php echo $row['name']; ?></td>
			               		<td><?php echo $row['SCHOOL_YEAR']; ?></td>
			               		<td><?php echo $row['SEMESTER']; ?></td>
			               	</tr>


                			<?php
                		$i++; }

                	}

                	 ?>

               	

                </tbody>
         </table>



<?php

include('include/footer.php');
include('include/script.php');

function getStudent($year,$sem){
	global $mydb;
	$mydb->setQuery("select en.IDNO,concat(s.FNAME,' ',s.LNAME) as 'name',ac.SCHOOL_YEAR,ac.SEMESTER from enrollees en,acad_year ac,students s where en.ACAD_ID = ac.ACAD_ID and en.IDNO = s.IDNO and ac.SCHOOL_YEAR = '".$year."' and ac.SEMESTER = '".$sem."';");
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
		window.location.href="../regisView/students.php";
	});
</script>