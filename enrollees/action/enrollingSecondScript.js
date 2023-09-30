$(document).ready(function(){




	$(document).on('click','#re-enrolled2',function(e){

		let sy = $('#sy3').val();
		let sem2  = $('#sem2').val();

		if(sy == ''){
			//no school year available
			//you cannot proceed in enrollment because missing school year
			swal("Empty School Year! maybe the admin didn't set the default school year for this semester!", {
				icon: "warning",
				  }).then((confirmed)=>{
				   window.location.reload();
				  });
		}else{

			if(sem2 =='SECOND'){

				let IDNO = $('#hidden_idno').val();
				let class_id = $('#class_id').val();
				let sect_id = $('#section_id').val();
				let course_id = $('#course_id').val();

				 swal({
			        title: "Are you sure you want to enroll this student?",
			        text: "Second semester",
			        icon: "warning",
			        buttons: true,
			        dangerMode: true,
			}).then((willconfirmed) => {

					if(willconfirmed){

						$.ajax({
							url:'action/server2.php',
							method:'post',
							data:{IDNO2:IDNO, class_id2:class_id, sect_id2:sect_id, course_id2:course_id,sy:sy},
							dataType:'json',

							beforeSend:function(){
								$('#re-enrolled2').val('validating...');
								$('#re-enrolled2').attr('disabled','disabled');
							},

							success:function(data){
								console.log(data);
								if(data.success){
								swal("New student enroll successfully!", {
						                icon: "success",
								          }).then((confirmed)=>{
								             window.location.href="../enrollees/";

								     });
								}
								if(data.err_insertingnull_grades){
									swal("Error in server! Inserting null grades return error", {
						                icon: "error",
								          }).then((confirmed)=>{
								             window.location.reload();

								     });
								}
								if(data.error_tbl_enrollees){
									swal("Error in server! Inserting tbl enrollees return error", {
						                icon: "error",
								          }).then((confirmed)=>{
								             window.location.reload();

								     });
								}
								if(data.err_idno){
									swal("Error in server! IDNO found empty", {
						                icon: "error",
								          }).then((confirmed)=>{
								             window.location.reload();

								     });
								}
								if(data.erro_acad){
									swal("Error in server! Acad id not found empty", {
						                icon: "error",
								          }).then((confirmed)=>{
								             window.location.reload();

								     });
								}
								if(data.err_course_id){
									swal("Error in server! course id not found empty", {
						                icon: "error",
								          }).then((confirmed)=>{
								             window.location.reload();

								     });
								}
								if(data.err_sect_id){
									swal("Error in server! section id not found empty", {
						                icon: "error",
								          }).then((confirmed)=>{
								             window.location.reload();

								     });
								}
								if(data.err_class_id){
									swal("Error in server! class id not found empty", {
						                icon: "error",
								          }).then((confirmed)=>{
								             window.location.reload();

								     });
								}
								if(data.err_history){
									swal("Error in server! inserting student history return false!", {
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

			}else{
				//not valid for enrolling this second semester
				swal("This Semester is not valid for enrolling! Semester must be `SECOND`!", {
					icon: "warning",
					 }).then((confirmed)=>{
						 window.location.reload();
					});
			}

		}
	});


$(document).on('click','#searchBtn',function(e){
e.preventDefault();

let IDNO2 = $('#textsearch').val();


	if(IDNO != ''){
		$.ajax({
		url:'action/getData.php',
		method:'post',
		data:{IDNO2:IDNO2},
		

		beforeSend:function(){

		},

		success:function(data){
			$('#tbb').html(data);
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

let IDNO = $(this).attr('data-value');
window.location.href="re_enroll.php?IDNO="+IDNO+"";

});


});