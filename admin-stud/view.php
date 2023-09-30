<?php
include('../themeAsset/header.php');
include('../themeAsset/adminSidebar.php');


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
                  <label  for="">Password: </label>

                  <button class="btn btn-sm btn-warning" id="btn_view_pass" data-value="<?php echo $res->IDNO; ?>">View Password</button>

                    
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

include('../themeAsset/footer.php');
include('../themeAsset/script.php');
include('modal/viewGrades.php');
include('modal/viewPassword.php');

  ?>

 <?php

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
  	$(document).ready(function(){

  		//for poping the view pass with details
  		$(document).on('click','#btn_view_pass',function(e){
  			e.preventDefault();


  			let IDNO = $(this).attr('data-value');

  			$.ajax({
  				url:'action/getData.php',
  				method:'post',
  				data:{viewP:IDNO},

  				success:function(data){
  					$('#fetch').html(data);
  					$('#viewPass').modal('show');
  				},

  				error:function(xhr,status,error){
  					alert(xhr.responseText);
  				}


  			});

  			

  		});

  		//for pop out the modal view grades with details
  		$(document).on('click','#btn_showGrades',function(e){
  			e.preventDefault();

  			let enroll_id = $(this).attr('data-value');
  			
  			$.ajax({
  				url:'action/getData.php',
  				method:'post',
  				data:{viewG:enroll_id},

  				success:function(data){
  					$('#fetchGrades').html(data);
  					$('#viewGrades').modal('show');
  				},

  				error:function(xhr,status,error){
  					alert(xhr.responseText);


  				}

  			});


  		});


  		//for enable edit grades of the students
  		$(document).on('click','#btn_enable',function(e){
  			e.preventDefault();
  			$('#btn_save').show();
  			$('#btn_disabled').show();
  			$(this).hide();

  			//for input fiels: enable
  			$('#md').attr('readonly',false);
  			$('#end').attr('readonly',false);

  			//this hidden creatures will hold all the orig value of the input fields
  			let mdd = $('#md').val();
  			let endd = $('#end').val();
  			let fndd = $('#fn').val();

  			//then we store it in the hidden creatures
  			$('#hd_mid').val(mdd);
  			$('#hd_end').val(endd);
  			$('#hd_fn').val(fndd);
  			

  		});

  		//for cancel editing
  		$(document).on('click','#btn_disabled',function(e){
  			e.preventDefault();
  				$('#btn_save').hide();
  				$(this).hide();
  				$('#btn_enable').show();

  				//for input fiels: disable
  			$('#md').attr('readonly',true);
  			$('#end').attr('readonly',true);



  			//lets get the original value of each grades
  			let get_mid = $('#hd_mid').val();
  			let get_end = $('#hd_end').val();
  			let get_fn = $('#hd_fn').val();

  			//then lets display it into text field
  			$('#md').val(get_mid);
  			$('#end').val(get_end);
  			$('#fn').val(get_fn);

  		});


  		//auto compute average
  		$(document).on('keyup','#end',function(e){
  			e.preventDefault();

			let mid_gr = $('#md').val();
			let end_gr = $(this).val();

			if(mid_gr !=''){
				if(end_gr !=''){
					let sum = 0;
					 sum = parseInt(mid_gr)+parseInt(end_gr);
					let  avg = parseFloat(sum)/2;
					$('#fn').val(avg);
				}else{
					$('#fn').val('');
				}
			}


  		});
	
  		$(document).on('keyup','#md',function(e){

  		e.preventDefault();

			let end_gr = $('#end').val();
			let mid_gr = $(this).val();

			if(end_gr !=''){
				if(mid_gr !=''){
					let sum = 0;
					 sum = parseInt(mid_gr)+parseInt(end_gr);
					let  avg = parseFloat(sum)/2;
					$('#fn').val(avg);
				}else{
					$('#fn').val('');
				}
			}


  		});



  		//this ajax request is for editing grades of the selected students
  		//this features available only in the admin side
  		$(document).on('submit','#submit_edit_form',function(e){
  			e.preventDefault();

  			let check_enroll_id = $('#hdd_enroll_id').val();

  			if(check_enroll_id !=''){

  				$.ajax({
  					url:'action/server_grades.php',
  					method:'post',
  					data:$(this).serialize(),
  					dataType:'json',

  					beforeSend:function(){
  						$('#btn_save').val('validating...');
  						$('#btn_save').attr('disabled','disabled');
  						$('#df_close').attr('disabled','disabled');
  					},

  					success:function(data){
  						
  						$('#submit_edit_form')[0].reset();
  						if(data.success){
  							swal("Student Grades updated successfully!", {
				                icon: "success",
						          }).then((confirmed)=>{	          	
						             window.location.reload();
						     });
  						}
  						if(data.err_up_r_status){
  							swal("Error in Server! Updating R status query return false!", {
				                icon: "error",
						          }).then((confirmed)=>{	          	
						             window.location.reload();
						     });
  						}

  						if(data.err_up_grades){
  							swal("Error in Server! Updating student grades query return false!", {
				                icon: "error",
						          }).then((confirmed)=>{	          	
						             window.location.reload();
						     });
  						}
  						if(data.err_enroll_id){
  							swal("Enroll ID found Empty!", {
				                icon: "error",
						          }).then((confirmed)=>{	          	
						             window.location.reload();
						     });
  						}
  					},

  					error:function(xhr,status,error){
  						alert(xhr.responseText);
  					}


  				});


  			}else{
  				// no enroll id detected
  				alert('No enroll_id found!');
  			}


  		});



  	});


  </script>