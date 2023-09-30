$(document).ready(function(){

$(document).on('click','#btn_addsched',function(e){
e.preventDefault();

$('#addSchedModal').modal('show');

});

//for submitting the add sched modal form
$(document).on('submit','#addSchedForm',function(e){
e.preventDefault();

	if($('#addTopic').val() ==''){
		$('#error_topic').text('Input field is required!');

	}else{
		$.ajax({
				url:'action/server.php',
				method:'post',
				data:$(this).serialize(),
				dataType:'json',

				beforeSend:function(){
					$('#addBtn').val('validating...');
					$('#addBtn').attr('disabled','disabled');

				},

				success:function(data){
					//console.log(data);
					$('#addSchedForm')[0].reset();
					if(data.success){
						swal("New Schedule added successfully!", {
							icon: "success",
							   }).then((confirmed)=>{
							     window.location.reload();
						 });
					}
					if(data.err_emp_acad){
						swal("Error in Server! Empty Acad id", {
							icon: "error",
							   }).then((confirmed)=>{
							     window.location.reload();
						 });
					}

					if(data.err_empt_class_id){
						swal("Error in Server! Empty class id", {
							icon: "error",
							   }).then((confirmed)=>{
							     window.location.reload();
						 });
					}
					if(data.err_empt_date){
						swal("Error in Server! Empty date", {
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


	}

	


});


$(document).on('click','#btn_edit',function(e){
e.preventDefault();

let class_sched_id = $(this).attr('data-value');
	$.ajax({
		url:'action/getData.php',
		method:'post',
		data:{class_sched_id:class_sched_id},
		dataType:'json',

		success:function(data){
			//console.log(data);

			$('#hdd_edit_sched_id').val(data.sched_id);

			$('#editTopic').val(data.topic);
			$('#editClass').val(data.class);
			$('#editSchedDate').val(data.s_date);

			$('#editSchedModal').modal('show');
		},

		error:function(xhr,status,error){
			alert(xhr.responseText);
		}

	});


});


//for submitting the edit sched form
$(document).on('submit','#edit_schedForm',function(e){
e.preventDefault();
	
	$.ajax({
		url:'action/server.php',
		method:'post',
		data:$(this).serialize(),
		dataType:'json',

		beforeSend:function(){
			$('#saveSchedule').val('validating...');
			$('#saveSchedule').attr('disabled','disabled');
		},

		success:function(data){
			//console.log(data);
			$('#edit_schedForm')[0].reset();
			if(data.success){
				swal("Schedule updated Successfully!", {
					icon: "success",
					   }).then((confirmed)=>{
						window.location.reload();
					});
			}
			if(data.err_up){
				swal("Error in Server! Updating Error", {
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