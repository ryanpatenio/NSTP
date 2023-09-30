$(document).ready(function(){

//displaying add new instructor modal
$(document).on('click','#newBtn',function(e){
e.preventDefault();

$('#addInstModal').modal('show');

});

//submitting the form:: ADD NEW INSTRUCTOR
$(document).on('submit','#addForm',function(e){
e.preventDefault();

$.ajax({
	url:'action/server.php',
	method:'POST',
	data:$(this).serialize(),
	dataType:'json',

	beforeSend:function(){
		$('#addFbtn').val('validating...');
		$('#addFbtn').attr('disabled','disabled');

	},

	success:function(data){
		
		$('#addForm')[0].reset();
		if(data.success){
			swal("New instructor added successfully!", {
                icon: "success",
		      }).then((confirmed)=>{
		        window.location.reload();

		    });		
		}

		if(data.err_insert){
			swal("Error in Server! Inserting Query error!", {
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

//checking if the pass and repass is the same
$('#repass').keyup(function(e){
e.preventDefault();

if($(this).val() != $('#pass').val()){
	$('#err_pass').text('Password not match!');
	$('#err_pass').attr('class','text-danger');
}else{
	$('#err_pass').attr('class','text-success');
	$('#err_pass').text('Password match!');
}

if($(this).val() == ''){
	$('#err_pass').text('');

}

});

//enable repass input field
$('#pass').keyup(function(e){
e.preventDefault();

if($(this).val() !=''){
	$('#repass').attr('readonly',false);
}else{
	$('#repass').attr('readonly',true);
	$('#repass').val('');
	$('#err_pass').text('');
}

});




//displaying edit form modal with details
$(document).on('click','#editBtn',function(e){
e.preventDefault();

let editID = $(this).attr('data-value');

$.ajax({
	url:'action/getData.php',
	method:'POST',
	data:{edit_id:editID},
	dataType:'json',

	success:function(data){
		
		$('#h_editID').val(data.inst_id);
		$('#editFname').val(data.fname);
		$('#editlname').val(data.lname);
		$('#edituname').val(data.uname);
		$('#editInstModal').modal('show');
	},

	error:function(xhr,status,error){
		alert(xhr.responseText);
	}

});
});

//submitting the edit modal form
$(document).on('submit','#editForm',function(e){
e.preventDefault();

	$.ajax({
		url:'action/server.php',
		method:'POST',
		data:$(this).serialize(),
		dataType:'json',

		beforeSend:function(){
			$('#editIbtn').val('validating...');
			$('#editIbtn').attr('disabled','disabled');
		},	

		success:function(data){
			
			$('#editForm')[0].reset();
			if(data.success){
			swal("Instructor updated successfully!", {
                icon: "success",
		          }).then((confirmed)=>{
		          window.location.reload();

		     });		
			}

			if(data.err_update){
			swal("Error in Server! updating Query error!", {
                icon: "error",
		          }).then((confirmed)=>{
		          window.location.reload();

		     });
			}

			if(data.err_empty_id){
			swal("Error in Server! inst ID not found!", {
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


//displaying assign modal with instructor name
$(document).on('click','.btn_assign',function(e){
e.preventDefault();

let ID = $(this).attr('id');
	
	$.ajax({
		url:'action/getData.php',
		method:'POST',
		data:{ID:ID},
		dataType:'json',

		success:function(data){
			
			$('#hidden_inst_id').val(data.ID);
			$('#inst_name').val(data.name);
			$('#assign_modal').modal('show');
		},

		error:function(xhr,status,error){
			alert(xhr.responseText);
		}

	});

});


//submitting the assign modal
$(document).on('submit','#assignForm',function(e){
e.preventDefault();

$.ajax({
	url:'action/server.php',
	method:'POST',
	data:$(this).serialize(),
	dataType:'json',

	beforeSend:function(){
		$('#assignFbtn').val('validating...');
		$('#assignFbtn').attr('disabled','disabled');
	},

	success:function(data){
		
		if(data.success){
			swal("Assign successfully!", {
                icon: "success",
		             }).then((confirmed)=>{
		              window.location.reload();

		          });
		}

		if(data.didnt_choose_any){
			swal("Please Choose Class!", {
                icon: "warning",
		      }).then((confirmed)=>{
		      	$('#assignFbtn').val('ADD');
		      	$('#assignFbtn').attr('disabled',false);

		      });
		}

		if(data.err_query){
				swal("Server Erro!", {
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

//displaying the instructor designated class in a modal form
$(document).on('click','.view',function(e){
	e.preventDefault();

	var view_id = $(this).attr('id');

	$.ajax({
		url:'action/getData.php',
		method:'POST',
		data:{view_id:view_id},

		success:function(data){
			$('#fetchData').html(data);
			$('#viewModal').modal('show');
		},

		error:function(xhr,status,error){
			alert(xhr.responseText);
		}

	});
	

});

});