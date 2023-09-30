<?php
include('include/header.php');
include('include/sidebar.php');

if(!isset($_GET['IDNO'])){
	redirect(WEB_ROOT.'login.php');
}
$get_IDNO = $_GET['IDNO'];

$res = getStudentData($get_IDNO);



 ?>


 <div id="content-wrapper">

      <div class="container-fluid">

<div class="row">

	<div class="col-md-3">
 		 <img id="curImg" name="curImg" style="height: 300px;" src="../images/default1.jpeg" class="img-thumbnail" />
	</div>



	
  <div class="col-lg-6" style="float: none;margin: auto;">
    <div class="card mb-3">
     <div class="card-header">
      <div class="card-header">
                <i class="fa fa-bar-chart"></i>Student Details</div>
         <div class="card-body">
              <div class="form-group">
               <div class="form-row">
                      <div class="col-md">
                  <label  for="">Student Name : </label>

                
                    <input class="form-control input-sm" id="mid" readonly name="studname" placeholder=
                        "Student Name" type="text" value="<?php echo $res->name ?>">
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="form-row">
                      <div class="col-md">
                  <label  for="">Gender : </label>

                    <input class="form-control input-sm" id="gender" readonly name="gender" placeholder=
                        "Gender" type="text" value="<?php echo $res->GENDER ?>">
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="form-row">
                      <div class="col-md">
                  <label  for="">Address : </label>

                    <input class="form-control input-sm" id="address" readonly name="address" placeholder=
                        "Address" type="text" value="<?php echo $res->ADDRESS ?>">
                  </div>
                </div>
              </div>

        </div>

     </div>
    </div>
  </div>


<br>
<hr><hr>

	<table class="table table-bordered " width="100%" cellspacing="0">
        <thead>
          <tr>
             <th>ENROLL ID</th>
             <th>CLASS</th>
             <th>SEMESTER</th>
             <th>SCHOOL YEAR</th>
             <th>ACTION</th>                   
           </tr>
        </thead>               
            <tbody>
            	<?php

            	$en_data = getEnrollData($get_IDNO);
            	if($en_data !='0'){
            		foreach ($en_data as $row) {
            			# code...
            			?>
            	<tr>
            		<td><?php echo $row['ENROLL_ID']; ?></td>
            		<td><?php echo $row['CLASS_NAME']; ?></td>
            		<td><?php echo $row['SEMESTER']; ?></td>
            		<td><?php echo $row['SCHOOL_YEAR']; ?></td>
            		<td>
            			<button class="btn btn-sm btn-warning" id="btn_showGrades" data-value="<?php echo $row['ENROLL_ID']; ?>"><i class="fa fa-search"> View</i></button>	

            		</td>
            	</tr>


            			<?php
            		}

            	}

            	 ?>

           	
            </tbody>
    </table>



</div>


 <?php

include('include/footer.php');
include('include/script.php');
include('modal/viewGrades.php');


function getEnrollData($IDNO){
	global $mydb;
	$mydb->setQuery("select en.ENROLL_ID,cl.CLASS_NAME,ac.SEMESTER,ac.SCHOOL_YEAR from enrollees en,class cl,acad_year ac where en.CLASS_ID = cl.CLASS_ID and en.ACAD_ID = ac.ACAD_ID and en.IDNO = '".$IDNO."';");
	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}

}

function getStudentData($IDNO){
global $mydb;
$mydb->setQuery("select s.IDNO,concat(s.FNAME,' ',s.LNAME) name,s.PASSWORD as'pass',st.GENDER,st.ADDRESS,s.REGISTERED from students s,stud_details st where s.IDNO = st.IDNO and s.IDNO = '".$IDNO."';");
$cur = $mydb->executeQuery();
$numrows = $mydb->num_rows($cur);

if($numrows > 0){
	$found = $mydb->loadSingleResult();
	return $found;
}else{
	return 0;
}


}


  ?>

  <script type="text/javascript">
  	
  		//for pop out the modal view grades with details
  		$(document).on('click','#btn_showGrades',function(e){
  			e.preventDefault();

  			let enroll_id = $(this).attr('data-value');
  			
  			$.ajax({
  				url:'action/getData.php',
  				method:'post',
  				data:{viewG:enroll_id},

  				success:function(data){
  					$('#fetchGradesReg').html(data);
  					$('#viewGrades').modal('show');
  				},

  				error:function(xhr,status,error){
  					alert(xhr.responseText);


  				}

  			});


  		});


  </script>