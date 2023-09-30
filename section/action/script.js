$(document).ready(function(){
//adding new Section
$(document).on('click','.add',function(e){
e.preventDefault();

$('#addSect').modal('show');

});

//submitting: add New Section
$(document).on('submit','#addSectForm',function(e){
e.preventDefault();

$.ajax({
	url:'action/server.php',
	method:'POST',
	data:$(this).serialize(),
	dataType:'json',

	beforeSend:function(){
		$('#addbtn').val('validating...');
		$('#addbtn').attr('disabled','disabled');
	},
	success:function(data){
		console.log(data);
		$('#addSectForm')[0].reset();
		if(data.success){
			swal("New section added successfully!", {
                icon: "success",
             }).then((confirmed)=>{
              window.location.reload();

             });
		}

		if(data.yr_exist){
			swal("Year and Section already exist!", {
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

//editing new Section: or displaying the sectio details
$(document).on('click','#modif',function(e){
e.preventDefault();

let ID = $(this).attr('data-value');

$.ajax({
	url:'action/getData.php',
	method:'POST',
	data:{ID:ID},
	dataType:'json',

	success:function(data){
		
		$('#hiddenID').val(data.sect_id);
		$('#editsec').val(data.code);
		$('#editYr').val(data.yr_sec);
		$('#upModal').modal('show');

	},

	error:function(xhr,status,error){
		alert(xhr.responseText);
	}

});


});


//submitting the form:: or update the section 
$(document).on('submit','#editForm',function(e){
e.preventDefault();

	$.ajax({
		url:'action/server.php',
		method:'POST',
		data:$(this).serialize(),
		dataType:'json',

		beforeSend:function(){
			$('#editbtn').val('validating...');
			$('#editbtn').attr('disabled','disabled');
		},

		success:function(data){
			console.log(data);
			if(data.success){
				swal("Section updated successfully!", {
                icon: "success",
             }).then((confirmed)=>{
              window.location.reload();

             });
			}

			if(data.error_yr_sec_exist){
				swal("Year and Section already exist!", {
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