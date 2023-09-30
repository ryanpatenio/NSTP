$(document).ready(function(){

//for displaying the add modal
$(document).on('click','#newBtn',function(e){
e.preventDefault();

$('#addClassModal').modal('show');
});

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
		console.log(data);
		$('#addForm')[0].reset();
		if(data.success){
			swal("New class added successfully!", {
                icon: "success",
             }).then((confirmed)=>{
              window.location.reload();

             });
		}

		if(data.cl_code_exist){
			swal("Class already exist!", {
                icon: "warning",
             }).then((confirmed)=>{
              window.location.reload();

             });
		}

		if(data.err_autocode){
			swal("AutoCode error!", {
                icon: "warning",
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



//for displaying edit modal with details
$(document).on('click','#editBtn',function(e){
e.preventDefault();

let ID = $(this).attr('data-value');
$.ajax({
	url:'action/getData.php',
	method:'POST',
	data:{ID:ID},
	dataType:'json',

	success:function(data){
		
		$('#hidden_id').val(data.ID);
		$('#cl_code').val(data.code);
		$('#cl_name').val(data.cl_name);
		$('#editClassModal').modal('show');
	},

	error:function(xhr,status,error){
		alert(xhr.responseText);
	}

});
});

//submitting the edit form
$(document).on('submit','#editForm',function(e){
	e.preventDefault();
	$.ajax({
		url:'action/server.php',
		method:'POST',
		data:$(this).serialize(),
		dataType:'json',

		beforeSend:function(){
			$('#editFbtn').val('validating...');
			$('#editFbtn').attr('disabled','disabled');
		},

		success:function(data){
			$('#editForm')[0].reset();
			if(data.success){
				swal("class updated successfully!", {
                icon: "success",
		             }).then((confirmed)=>{
		              window.location.reload();

		          });
			}

			if(data.err_exist_cl_name){
				swal("Class already exist!", {
                icon: "warning",
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

});