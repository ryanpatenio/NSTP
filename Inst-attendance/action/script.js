$(document).ready(function(){

//for poping out the add attendance form
$(document).on('click','#add_button',function(e){
e.preventDefault();

$('#addModalForm').modal('show');

});

//for submitting the add attendance form
$(document).on('submit','#attendance_form',function(e){
e.preventDefault();

	$.ajax({
		url:'action/server.php',
		method:'post',
		data:$(this).serialize(),
		dataType:'json',

		beforeSend:function(){
			$('#button_action').val('validating...');
			$('#button_action').attr('disabled','disabled');
		},

		success:function(data){
			//console.log(data);
			if(data.success){
				swal("Student Attendance added successfully!", {
				icon: "success",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });
			}

			if(data.err_no_stud_data){
				swal("No Student Data!", {
				icon: "warning",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });
			}

			if(data.err_sy){
				swal("No School Year Detected! Maybe the Admin didn't set Default SY!", {
				icon: "warning",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });
			}

			if(data.err_up_class_sched_status){
				swal("Error in Server! Updating sched status return false!", {
				icon: "error",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });
			}

			if(data.error){
				if(data.error_attendance_date !=''){
					$('#error_attendance_date').text(data.error_attendance_date);
					$('#button_action').attr('disabled',false);
					$('#button_action').val('Save');
				}else{
					
					
				}
			}
		},

		error:function(xhr,status,error){
			alert(xhr.responseText);
		}

	});


});

//for pop out the edit selected attendance modal
$(document).on('click','#editStatBtn',function(e){
e.preventDefault();

let tr = $(this).closest('tr');
      let data = tr.children("td").map(function(){
        return $(this).text();

      }).get();
      
      $('#topic').val(data[1]);
      $('#attDate').val(data[2]);
      $('#storedV').val(data[3]);
      $('#storedV').text(data[3]);
      $('#ATT_ID').val($(this).attr('data-value'));
      $('#editModal').modal('show');
});

//for submitting the edit attendance form
$(document).on('submit','#editForm',function(e){
e.preventDefault();

	$.ajax({
		url:'action/server.php',
		method:'post',
		data:$(this).serialize(),
		dataType:'json',

		beforeSend:function(){
			$('#btn_edit').val('validating...');
			$('#btn_edit').attr('disabled','disabled');
		},
		success:function(data){
			//console.log(data);
			if(data.success){
				swal("Student Attendance updated successfully!", {
				icon: "success",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });
			}
			if(data.err_update){
				swal("Error in Server! updating Attendance return false", {
				icon: "error",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });
			}

			if(data.err_empty_att_id){
				swal("Error in Server! Attendance ID is null!", {
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