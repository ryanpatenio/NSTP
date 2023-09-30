<?php
include('../instructor-asset/header.php');
include('sidebar-inside/sidebar.php');

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

      		<center><h4 class="center">LIST OF <?php echo $dataClass; ?></h4></center>


      		<?php
      	}


      	 ?>

      	 
       	<br>
       	<br>


       	<table class="table table-bordered" width="100%" cellspacing="0">

     
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
                  $data = getStudents($class_id);
                  foreach ($data as $row) {
                    # code...
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
include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');


function getStudents($id){
  global $mydb;
  $mydb->setQuery("select en.IDNO,concat(s.FNAME,' ',s.LNAME) as 'name',st.GENDER,st.ADDRESS,st.CONTACT from enrollees en,students s,stud_details st,acad_year ac where en.IDNO = s.IDNO and en.IDNO = st.IDNO and en.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and en.CLASS_ID='".$id."';");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}

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


 ?>

 <script type="text/javascript">
	$(document).ready(function(){
		window.onload = window.print();
		window.location.href="../Inst-inside/index.php?id=<?php echo $class_id; ?>";
	});
</script>