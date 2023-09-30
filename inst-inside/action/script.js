$(document).ready(function(){

//for displaying the add new student modal
$(document).on('click','#btn_addStudent',function(e){
e.preventDefault();
$('#addModal').modal('show');

});

//for submitting add modal form
$(document).on('submit','#addStudentForm',function(e){
 e.preventDefault();

	$.ajax({
		url:'action/server.php',
		method:'post',
		data:$(this).serialize(),
		dataType:'json',

		beforeSend:function(){
			$('#addFbtn').val('validating...');
			$('#addFbtn').attr('disabled','disabled');

		},

		success:function(data){
			console.log(data);
			if(data.success){
				swal("New Student added successfully!", {
                icon: "success",
		        }).then((confirmed)=>{
		        	$('#addStudentForm')[0].reset();
		            window.location.reload();

		     });
			}
			if(data.ID_exist){
				swal("ID NUMBER is already exist!", {
                icon: "warning",
		          }).then((confirmed)=>{
		             $('#IDNO').val('');
		             $('#IDNO').focus();
		             $('#addFbtn').attr('disabled',false);
		             $('#addFbtn').val('Save');

		     });	
			}

			if(data.err_tblStudent){
				swal("Error in Inserting Data! tbl Student", {
                icon: "error",
		          }).then((confirmed)=>{
		          	$('#addStudentForm')[0].reset();
		             window.location.reload();

		     });
			}

			if(data.err_stud_details){
				swal("Error in Inserting Data! tbl Student Details", {
                icon: "error",
		          }).then((confirmed)=>{
		          	$('#addStudentForm')[0].reset();
		             window.location.reload();

		     });
			}

			if(data.err_enrollees){
				swal("Error in Inserting Data! tbl enrollees", {
                icon: "error",
		          }).then((confirmed)=>{
		          	$('#addStudentForm')[0].reset();
		             window.location.reload();

		     });
			}

			if(data.err_grades){
				swal("Error in Inserting Data! tbl grades", {
                icon: "error",
		          }).then((confirmed)=>{
		          	$('#addStudentForm')[0].reset();
		             window.location.reload();

		     });
			}

			if(data.error){
				if(data.error_acad !=''){
					swal("No School Year detected! Maybe the admin didn't set default School Year!", {
		                icon: "warning",
				          }).then((confirmed)=>{
				          	$('#addStudentForm')[0].reset();
				             window.location.reload();

		   				  });
				}
			}

			if(data.err_history){
				swal("Error in Inserting Data! tbl student history!", {
	                icon: "error",
			          }).then((confirmed)=>{
			          	$('#addStudentForm')[0].reset();
			             window.location.reload();

			     });
			}

		},

		error:function(xhr,status,error){
			alert(xhr.responseText);
		}


	});


});



});