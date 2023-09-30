$(document).ready(function(){

$(document).on('click','.addInc',function(e){
e.preventDefault();


	let IDNO = $(this).attr('id');
	let acad = $(this).attr('data-value');
	
	$.ajax({
		url:'action-inc/getData_inc.php',
		method:'post',
		data:{IDNO:IDNO,acad:acad},
		dataType:'json',

		success:function(data){
			console.log(data);
			$('#student_idno').val(data.IDNO);
			$('#hidden_grd_id').val(data.grd_id);
			$('#hidden_enroll_id').val(data.enroll_id);
			$('#hdd_class_id').val(data.class_id);
			$('#incFullname').val(data.name);
			$('#addIncModal').modal('show');
		},

		error:function(xhr,status,error){
			alert(xhr.responseText);
		}


	});

});


$(document).on('submit','#incForm',function(e){
e.preventDefault();
	
	let reason = $('#reason').val();

	if(reason ==''){
		$('#error_reason1').text('Input Field is required!');
	}else{


		 swal({
	        title: "Are you sure you want to add this student Into INC?",
	        text: "",
	        icon: "warning",
	        buttons: true,
	        dangerMode: true,
	}).then((willconfirmed) => {

			if(willconfirmed){
					$.ajax({
		url:'action-inc/server_inc.php',
		method:'post',
		data:$(this).serialize(),
		dataType:'json',

		beforeSend:function(){
			$('#updateInc1Btn').val('validating...');
			$('#updateInc1Btn').attr('disabled','disabled');

		},

		success:function(data){
			//console.log(data);
			$('#incForm')[0].reset();
			if(data.success){
				swal("Student added to INC!", {
				icon: "success",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });
			}

			if(data.err_grades_remarks){
				swal("Updating grd Remarks Error!", {
				icon: "error",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });
			}

			if(data.err_up_r_status){
				swal("Updating Enroll R_status Error!", {
				icon: "error",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });
			}

			if(data.err_tblInc){
				swal("Inserting Tbl Inc Error!", {
				icon: "error",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });
			}

			if(data.err_acad){
				swal("Empty Acad ID!", {
				icon: "error",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });
			}
			if(data.err_class_id){
				swal("Empty Class ID!", {
				icon: "error",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });
			}
			if(data.err_en_id){
				swal("Empty Enroll ID!", {
				icon: "error",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });
			}

			if(data.err_grd_id){
				swal("Empty grade ID!", {
				icon: "error",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });
			}

			if(data.err_idno){
				swal("Empty IDNO!", {
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


			}

		});



	}



});


});