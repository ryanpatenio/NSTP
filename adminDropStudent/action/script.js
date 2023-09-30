$(document).ready(function(){


let server = 'action/server.php';
let method = 'post';



$(document).on('click','#btn-first',function(e){
e.preventDefault();
$('#dropEnroll1').modal('show');

});

$(document).on('click','#btn-second',function(e){
e.preventDefault();

$('#dropEnroll2').modal('show');
});



$(document).on('submit','#re_enroll1',function(e){
e.preventDefault();

	if($('#hidden_enroll_id1').val() !=''){



		swal({
	        title: "Are you sure you want to RE-ENROLL this Student?",
	        text: "Please be careful to fill out all information! Maybe check it carefully before submitting it!",
	        icon: "warning",
	        buttons: true,
	        dangerMode: true,
	}).then((willconfirmed) => {

			if(willconfirmed){

						$.ajax({
							url:server,
							method:method,
							data:$(this).serialize(),
							dataType:'json',

							beforeSend:function(){
								$('#btn-enroll1').val('validating...');
								$('#btn-enroll1').attr('disabled','disabled');
							},

							success:function(data){
								console.log(data);
								if(data.success){
									swal("Student Re-enroll successfully!", {
						                icon: "success",
								          }).then((confirmed)=>{
								             window.location.href="../adminDropStudent/";

								     });
								}
								if(data.err_not_SY_compatible){
									swal("School year not compatible for this enrollment! The student Drop in First Semester So the student must be re enroll for `first Semester`!", {
						                icon: "warning",
								          }).then((confirmed)=>{
								             window.location.reload();

								     });
								}
								if(data.err_no_class_selected){
									swal("No Class Selected! or Empty class!", {
						                icon: "error",
								          }).then((confirmed)=>{
								             window.location.reload();

								     });
								}
								if(data.err_enroll_id){
									swal("Error in Server! Enroll id found Empty!", {
						                icon: "error",
								          }).then((confirmed)=>{
								             window.location.reload();

								     });
								}
								if(data.err_insert_history){
									swal("Error in Server! inserting history query return false!", {
						                icon: "error",
								          }).then((confirmed)=>{
								             window.location.reload();

								     });
								}
								if(data.err_updating_grades){
									swal("Error in Server! updating grades query return false!", {
						                icon: "error",
								          }).then((confirmed)=>{
								             window.location.reload();

								     });
								}
								if(data.err_re_enroll){
									swal("Error in Server! re enroll query return false!", {
						                icon: "error",
								          }).then((confirmed)=>{
								             window.location.reload();

								     });
								}
								if(data.err_empty_idno){
									swal("Error in Server! IDNO found empty!", {
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

$(document).on('submit','#re_enroll2',function(e){
e.preventDefault();



	swal({
	        title: "Are you sure you want to RE-ENROLL this Student?",
	        text: "Please be careful to fill out all information! Maybe check it carefully before submitting it!",
	        icon: "warning",
	        buttons: true,
	        dangerMode: true,
	}).then((willconfirmed) => {

			if(willconfirmed){

					$.ajax({

						url:'action/server.php',
						method:'post',
						data:$(this).serialize(),
						dataType:'json',

						beforeSend:function(){
							$('#btn-enroll2').val('validating...');
							$('#btn-enroll2').attr('disabled','disabled');
						},

						success:function(data){
							console.log(data);
							if(data.success){
								swal("Student Re-enroll successfully!", {
						                icon: "success",
								          }).then((confirmed)=>{
								             window.location.href="../adminDropStudent/";

								     });
							}
							if(data.err_sy_not_compatible){
								swal("School year not compatible for this enrollment! The student Drop in First Semester So the student must be re enroll for `first Semester`!", {
						                icon: "warning",
								          }).then((confirmed)=>{
								             window.location.reload();

								     });
							}

							if(data.err_in_history){
								swal("Error in Server! query tbl student history return false!", {
						            icon: "error",
								     }).then((confirmed)=>{
								       window.location.reload();
								     });
							}
							if(data.err_up_grades){
								swal("Error in Server! query updating grades return false!", {
						            icon: "error",
								     }).then((confirmed)=>{
								       window.location.reload();
								     });
							}
							if(data.err_enroll_query){
								swal("Error in Server! query re enroll return false!", {
						            icon: "error",
								     }).then((confirmed)=>{
								       window.location.reload();
								     });
							}
							if(data.err_no_class){
								swal("No class Selected! or the class id found empty!", {
						            icon: "error",
								     }).then((confirmed)=>{
								       window.location.reload();
								     });
							}
							if(data.err_empty_idno){
								swal("Error in Server! IDNO found empty!", {
						            icon: "error",
								     }).then((confirmed)=>{
								       window.location.reload();
								     });
							}
							if(data.err_enroll_id2){
								swal("Error in Server! ENROLL ID found empty!", {
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

});

});