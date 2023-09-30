<?php
include('../instructor-asset/header.php');
include('../inst-inside/sidebar-inside/sidebar.php');

if(!isset($_GET['id'])){
	redirect(WEB_ROOT.'login.php');
}

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
      	<?php
      	$dataClass  = getClassName($class_id);
      	if($dataClass !='0'){
      		?>

      		<center><h4 class="center">LIST OF ENROLLEES  (`<?php echo $dataClass; ?>`)</h4></center>


      		<?php
      	}


      	 ?>

      	 
       	<br>
       	<br>

       	<table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>IDNO</th>                   
                    <th>NAME</th>
                    <th>CLASS</th>
                    <th>SEMESTER</th>
                    <th>SCHOOL YEAR</th>
                    
                  </tr>
                </thead>
               
                <tbody>
                <?php
                $data_enrollees = getEnrollees($class_id);
                foreach ($data_enrollees as $row) {
                  # code...
                  echo '<tr>';

                    echo '<td>'.$row['IDNO'].'</td>';
                    echo '<td>'.$row['name'].'</td>';
                    echo '<td>'.$row['CLASS_NAME'].'</td>';
                    echo '<td>'.$row['SEMESTER'].'</td>';
                    echo '<td>'.$row['SCHOOL_YEAR'].'</td>';
                   

                  echo '</tr>';
                }

                 ?>
                </tbody>
              </table>


 <?php

include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');

function getClassName($class){
	global $mydb;
	$mydb->setQuery("select * from class where CLASS_ID = '".$class."';");
	$cur = $mydb->executeQuery();
	$numrows = $mydb->num_rows($cur);

	if($numrows > 0){
		$found = $mydb->loadSingleResult();
		return $found->CLASS_NAME;
	}else{
		return 0;
	}
} 
function getEnrollees($id){
  global $mydb;
  $mydb->setQuery("select en.ENROLL_ID, en.IDNO,concat(s.FNAME,' ',s.LNAME) as 'name',cl.CLASS_NAME,ac.SEMESTER,ac.SCHOOL_YEAR from enrollees en,students s,class cl,acad_year ac where en.IDNO = s.IDNO and en.CLASS_ID = cl.CLASS_ID and en.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and en.CLASS_ID='".$id."';");
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
		window.location.href="../Inst-enrollees/index.php?id=<?php echo $class_id; ?>";
	});
</script>