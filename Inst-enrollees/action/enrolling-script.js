$(document).ready(function(){

let page_class_id = $('#hidden_set_class_id').val();


//for enrolling in second semester
$(document).on('click','#re-enrolled',function(e){
e.preventDefault();

let sy = $('#sy2').val();
let sem2  = $('#sem2').val();

if(sy == ''){
	//true null
	//you cannot proceed in enrollment because missing school year
	swal("Empty School Year! maybe the admin didn't set default school year for this semester!", {
		icon: "warning",
		  }).then((confirmed)=>{
		   window.location.reload();
		  });

}else{
	if(sem2 == 'SECOND'){
		//valid for enrolling this second semester
		//then lets call all the important variable
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

					//then lets proceed to the code
					$.ajax({
						url:'action/server.php',
						method:'post',
						data:{enrolling:IDNO,class_id:class_id,sect_id:sect_id,course_id:course_id,sy:sy},
						dataType:'json',

						beforeSend:function(){
							$(this).val('validating...');
							$(this).attr('Enroll');
						},

						success:function(data){
							console.log(data);

							if(data.success){
							swal("Student Succesfully enrolled for Second Semester!", {
					                icon: "success",
							        }).then((confirmed)=>{
							            window.location.href="../Inst-enrollees/index.php?id="+page_class_id;

							     });
							}

							if(data.err_IDNO_acad_exist){
							swal("ID NUMBER and ACAD ID is already exist!", {
					                icon: "warning",
							          }).then((confirmed)=>{
							            window.location.reload();
							     });	
							}

							if(data.error_enrolling){
								swal("Error in inserting Data!Enrolling query error!", {
					                icon: "warning",
							          }).then((confirmed)=>{
							            window.location.reload();
							     });
							}

							if(data.err_grades){
								swal("Error in inserting Data! null grades query error!", {
					                icon: "warning",
							          }).then((confirmed)=>{
							            window.location.reload();
							     });
							}
							if(data.err_history){
								swal("Error in inserting Data! insert student history query return error!", {
					                icon: "warning",
							          }).then((confirmed)=>{
							            window.location.reload();
							     });
							}
							if(data.empty_idno){
								swal("Error in server! IDNO found empty!", {
					                icon: "error",
							          }).then((confirmed)=>{
							            window.location.reload();
							     });
							}
							if(data.empty_class_id){
								swal("Error in server! class id found empty!", {
					                icon: "error",
							          }).then((confirmed)=>{
							            window.location.reload();
							     });
							}
							if(data.empty_sect_id){
								swal("Error in server! section id found empty!", {
					                icon: "error",
							          }).then((confirmed)=>{
							            window.location.reload();
							     });
							}
							if(data.empty_acad){
								swal("Error in server! No School Year Detected: maybe the admin didn't set default School Year!", {
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

});