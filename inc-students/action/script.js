$(document).ready(function(){



$(document).on('submit','#edit_inc_form',function(e){
e.preventDefault();

 

	if($('#ENROLL_ID').val() !=''){


		swal({
	        title: "Are you sure you want Update this `INC` student?",
	        text: "",
	        icon: "warning",
	        buttons: true,
	        dangerMode: true,
	}).then((willconfirmed) => {

			if(willconfirmed){



					$.ajax({

					
						xhr: function(){
							var xhr = new window.XMLHttpRequest();

							xhr.upload.addEventListener("progress",function(evt){

								if(evt.lengthComputable){
									var percentComplete = evt.loaded / evt.total;
									percentComplete = parseInt(percentComplete*100);

									$('.progress-bar').width(percentComplete+'%');
									$('.progress-bar').html(percentComplete+'%');
								}

							},false);
							return xhr;


						},

						url:'action/server.php',
						method:'post',
						data:$(this).serialize(),
						dataType:'json',
						beforeSend:function(){
							$('#btn_save').attr('disabled','disabled');
							$('#btn_save').val('vaidating..');
							$('.progress').show();
						},

						success:function(data){
							console.log(data);
							$('#edit_inc_form')[0].reset();

							if(data.success){
								swal("Student `INC` updated successfully!", {
									icon: "success",
									  }).then((confirmed)=>{
									     window.location.href="../inc-students/";
									});
							}
							if(data.error_update_grades){
								swal("Error in server! updating grades query return false!", {
									icon: "error",
									  }).then((confirmed)=>{
									     window.location.reload();
									});
							}

							if(data.err_update_r_status){
								swal("Error in server! updating enrollees r status query return false!", {
									icon: "error",
									  }).then((confirmed)=>{
									     window.location.reload();
									});
							}
							if(data.error_final_grades){
								swal("Error in server! final grades value return empty!", {
									icon: "error",
									  }).then((confirmed)=>{
									     window.location.reload();
									});
							}
							if(data.error_end_term){
								swal("Error in server! end_term grades value return empty!", {
									icon: "error",
									  }).then((confirmed)=>{
									     window.location.reload();
									});
							}

							if(data.error_mid_grades){
								swal("Error in server! mid term grades value return empty!", {
									icon: "error",
									  }).then((confirmed)=>{
									     window.location.reload();
									});
							}
							if(data.error_enroll_id){
								swal("Error in server! enroll id value return empty!", {
									icon: "error",
									  }).then((confirmed)=>{
									     window.location.reload();
									});
							}
							if(data.err_acad){
								swal("No Academic year detected! Please set default School year First!", {
									icon: "warning",
									  }).then((confirmed)=>{
									     window.location.reload();
									});
							}
							if(data.err_class_id){
								swal("Error in server! class id found empty!", {
									icon: "error",
									  }).then((confirmed)=>{
									     window.location.reload();
									});
							}
							if(data.err_history){
								swal("Error in server! Inserting history query return false!", {
									icon: "error",
									  }).then((confirmed)=>{
									     window.location.reload();
									});
							}

							if(data.err_IDNO){
								swal("Error in server! IDNO found empty!", {
									icon: "error",
									  }).then((confirmed)=>{
									     window.location.reload();
									});
							}


						},

						error:function(xhr,status,error){
							alert(error);
						}

					});



			}else{

			}


		});



	}




});


//auto compute average
	$('#end').keyup(function(e){
		e.preventDefault();

			let mid_gr = $('#mid').val();
			let end_gr = $(this).val();

			if(mid_gr !=''){
				if(end_gr !=''){
					let sum = 0;
					 sum = parseInt(mid_gr)+parseInt(end_gr);
					let  avg = parseFloat(sum)/2;
					$('#fin').val(avg);
				}else{
					$('#fin').val('');
				}
			}
		});



	$('#mid').keyup(function(e){
		e.preventDefault();

			let end_gr = $('#end').val();
			let mid_gr = $(this).val();

			if(end_gr !=''){
				if(mid_gr !=''){
					let sum = 0;
					 sum = parseInt(mid_gr)+parseInt(end_gr);
					let  avg = parseFloat(sum)/2;
					$('#fin').val(avg);
				}else{
					$('#fin').val('');
				}
			}
		});




});