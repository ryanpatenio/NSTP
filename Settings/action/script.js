$(document).ready(function(){

//displaying Data to Edit
$(document).on('click','#modi',function(e){
e.preventDefault();

var yr_id = $(this).attr('data-value');

$.ajax({
      url:'action/getData.php',
      method: 'POST',
      data:{id:yr_id},
      dataType:'json',

	success:function(data){
		$('#editID').val(data.ID);

		$('#editSY').val(data.SY);
		$('#editSem').val(data.SEM);
		$('#editSYID').val(data.STATUS);
		$('#editSYID').text(data.STATUS);

		$('#Update').modal('show');
	},
	error:function(xhr,status,error){
		
		alert(xhr.responseText);

	}
});
//submit the modified SY
$(document).on('submit','#modiSY',function(e){
e.preventDefault();

$.ajax({
	url:'action/server.php',
	method:'POST',
	data:$(this).serialize(),
	dataType:'JSON',

	beforeSend:function(){
		$('#modiBtn').val('validating...');
		$('#modiBtn').attr('disabled','disabled');
	},
	success:function(data){
		console.log(data);
		$('#modiSY')[0].reset();
		if(data.success){
			swal("School year updated successfully!", {
                icon: "success",
             }).then((confirmed)=>{
              window.location.reload();

             });
		}

		if(data.error_NO_default){
			swal("School year updated successfully!", {
                icon: "success",
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

//adding school year
$(document).on('click','#addModal',function(e){
e.preventDefault();
$('#addAy').modal('show');

});

//submitting the new SY
$(document).on('submit','#addNewSY',function(e){
	e.preventDefault();

$.ajax({
	url:'action/server.php',
	method:'POST',
	data:$(this).serialize(),
	dataType:'json',

	beforeSend:function(){
		$('#addAYBtn').val('validating...');
		$('#addAYBtn').attr('disabled','disabled');
	},

	success:function(data){
		console.log(data);
		//after validating the form must be reset
		$('#addNewSY')[0].reset();
		if(data.success){
			swal("School year updated successfully!", {
                icon: "success",
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