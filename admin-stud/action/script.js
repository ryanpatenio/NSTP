$(document).ready(function(){

//displaying the add modal form
$(document).on('click','#displayADDBtn',function(e){
e.preventDefault();

$('#addModal').modal('show');
});


//submitting the add modal form
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

		if(data.err_new_stud){
			swal("Error in Inserting Data!", {
                icon: "error",
		          }).then((confirmed)=>{
		          	$('#addStudentForm')[0].reset();
		             window.location.reload();

		     });
		}

		if(data.err_details){
			swal("Error in Inserting Data `Details`!", {
                icon: "error",
		          }).then((confirmed)=>{
		          	$('#addStudentForm')[0].reset();
		             window.location.reload();

		     });
		}

		if(data.IDNO_exist){
			swal("ID NUMBER is already exist!", {
                icon: "warning",
		          }).then((confirmed)=>{
		             $('#IDNO').val('');
		             $('#IDNO').focus();
		             $('#addFbtn').attr('disabled',false);
		             $('#addFbtn').val('Save');

		     });			
		}
	},

	error:function(xhr,status,error){
		alert(xhr.responseText);

	}


});
});



//displaying edit modal form with details
$(document).on('click','.editBtnData',function(e){
	e.preventDefault();
	let ID = $(this).attr('id');

	$.ajax({
		url:'action/getData.php',
		method:'POST',
		data:{edit:ID},
		dataType:'json',

		success:function(data){
			
			$('#editID').val(data.ID);
			$('#editIDNO').val(data.ID);
			$('#editfname').val(data.fname);
			$('#editlname').val(data.lname);
			$('#editbday').val(data.bday);
			$('#idgender').val(data.gender);
			$('#idgender').text(data.gender);
			$('#editcontact').val(data.contact);
			$('#editaddress').val(data.address);
			$('#editModal').modal('show');
		},

		error:function(xhr,status,error){
			alert(xhr.responseText);
		}

	});
});

//submitting the edit modal form
$(document).on('submit','#editStudentForm',function(e){
e.preventDefault();

	$.ajax({
		url:'action/server.php',
		method:'post',
		data:$(this).serialize(),
		dataType:'json',

		beforeSend:function(){
			$('#editFbtn').val('validating...');
			$('#editFbtn').attr('disabled','disabled');
		},

		success:function(data){
			console.log(data);
			$('#editStudentForm')[0].reset();
			if(data.success){

			swal("Student updated successfully!", {
                icon: "success",
		          }).then((confirmed)=>{	          	
		             window.location.reload();
		     });
			}
			if(data.err_up_details){
			swal("Error in updating student details!", {
                icon: "error",
		          }).then((confirmed)=>{
		             window.location.reload();

		     });
			}

			if(data.err_up_stud){
			swal("Error in updating student!", {
                icon: "error",
		          }).then((confirmed)=>{
		             window.location.reload();

		     });
			}

			if(data.err_missing_idno){
			swal("Error! IDNO is Missing!", {
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


});

//displaying the export modal
$(document).on('click','#disModalBtn',function(e){
e.preventDefault();

$('#createReportModal').modal('show');


});




});