$(document).ready(function(){

 let class_id = $('#hidden_id').val();

$(document).on('click','#searchBtn',function(e){
e.preventDefault();

let IDNO = $('#textsearch').val();
	if(IDNO != ''){
		$.ajax({
		url:'action/getData.php',
		method:'post',
		data:{IDNO:IDNO},
		

		beforeSend:function(){

		},

		success:function(data){
			$('#tb').html(data);
		},

		error:function(xhr,status,error){
			alert(xhr.responseText);
		}

	});
	}else{

	}

});

//for clicking the enroll button in the search modal
$(document).on('click','#enrollme',function(e){
e.preventDefault();

let ID = $(this).attr('data-value');
window.location.href="enrolling.php?id="+class_id+"&IDNO="+ID+"";

});


//for displaying the edit modal with details
$(document).on('click','#btn_edit',function(e){
e.preventDefault();

	let IDNO = $(this).attr('data-value');

	$.ajax({
		url:'action/getData.php',
		method:'post',
		data:{edit:IDNO},
		dataType:'json',

		success:function(data){
			//console.log(data);
			
			$('#IDNO').val(data.IDNO);
			$('#fname').val(data.fname);
			$('#lname').val(data.lname);
			$('#sy').val(data.sy);
			$('#sem').val(data.sem);
			$('#editModal').modal('show');
		},

		error:function(xhr,status,error){
			alert(xhr.responseText);
		}


	});
});

//for submitting the edit modal form
$(document).on('submit','#editForm',function(e){
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
			if(data.success){
			swal("Student Updated successfully!", {
				icon: "success",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });			
			}

			if(data.err_update){
			swal("Error in updating!", {
				icon: "error",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });	
			}

			if(data.err_empty_IDNO){
			swal("Empty IDNO! not found!", {
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

});