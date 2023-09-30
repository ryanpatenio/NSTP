<?php


include('../themeAsset/header.php');
include('../themeAsset/adminSidebar.php');

if(!isset($_GET['IDNO'])){
	redirect(WEB_ROOT."login.php");
}

$get_IDNO = $_GET['IDNO'];

?>

<div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">STUDENT DETAILS</h4>
        </ol>

<div class="row">
	
	 <div class="col-lg-6" style="float: none;margin: auto;">
    <div class="card mb-3">
     <div class="card-header">
      <div class="card-header">
                <i class="fa fa-bar-chart"></i>Student Details</div>
           <div class="card-body">

           	 <div class="form-group">
               <div class="form-row">
                      <div class="col-md">

                      	<?php
                      	$stud_name = getStudentName($get_IDNO);

                      	if($stud_name != '0'){
                      		$data_name = $stud_name;
                      	}else{
                      		$data_name = 'Error! 5000 Query for name return 0';
                      	}

                      	 ?>

                  <label  for="">Student Name : </label>

                    <input class="form-control input-sm" id="stud_name" readonly name="studname" placeholder=
                        "Student Name" type="text" value="<?php echo $data_name; ?>">
                  </div>
                </div>
              </div>

           </div>

       </div>
   </div>
</div>


</div>




<div class="card mb-3" id="table-container">
          <div class="card-header">
            <i class="fas fa-table"></i> 
            <a href="printme.php?IDNO=<?php echo $get_IDNO; ?>" class="btn btn-sm btn-primary" style="position: relative;margin: 0px;margin-top: 20px;margin-bottom: 20px;width: 100px;"><i class="fa fa-print"> Print</i></a>
            </div>
          <div class="card-body">

         
            <div class="table-responsive">
                
              <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
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
            </div>
          </div>
          
        </div>

     


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