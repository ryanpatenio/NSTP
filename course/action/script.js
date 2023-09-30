$(document).ready(function(){

//displaying add Modal
$(document).on('click','#addBtn',function(e){
e.preventDefault();
$('#addModal').modal('show');

});

//submitting new Course
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
				swal("New Course added successfully!", {
                		icon: "success",
		             }).then((confirmed)=>{
		              window.location.reload();

		          });
			}

			if(data.cname_exist){
				swal("Course already exist!", {
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



//dsplaying data in edit modal
$(document).on('click','#editBtn',function(e){
e.preventDefault();

let editID = $(this).attr('data-value');
$.ajax({
	url:'action/getData.php',
	method:'POST',
	data:{ID:editID},
	dataType:'json',

	success:function(data){
		
		$('#hidden_ID').val(data.C_ID);
		$('#editcourse').val(data.CNAME);
		$('#editdescript').val(data.descript_name);
		$('#editModal').modal('show');
	},

	error:function(xhr,status,error){
		alert(xhr.responseText);
	}

});


});


//submit the edit form
$(document).on('submit','#editForm',function(e){
e.preventDefault();

$.ajax({
	url:'action/server.php',
	method:'POST',
	data:$(this).serialize(),
	dataType:'json',

	beforeSend:function(){
		$('#editFBtn').val('validating...');
		$('#editFBtn').attr('disabled','disabled');
	},

	success:function(data){
		
		$('#editForm')[0].reset();
		if(data.success){
			swal("Course updated successfully!", {
                icon: "success",
		        }).then((confirmed)=>{
		        window.location.reload();

		    });
		}

		if(data.err_exist_course){
			swal("Course already exist!", {
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