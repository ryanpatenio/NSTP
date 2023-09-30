$(document).ready(function(){

let class_id = $('#hidden_class_id').val();

$(document).on('click','.addGrades',function(e){
e.preventDefault();

	let acad_id = $(this).attr('data-value');
	let IDNO = $(this).attr('id');
	let enroll_id = $(this).attr('value');

		$.ajax({
			url:'action-grades/getDataGrades.php',
			method:'post',
			data:{addGrades1:acad_id,IDNO:IDNO,enroll_id:enroll_id},
			dataType:'json',

			success:function(data){
				console.log(data);
				$('#fullname').val(data.name);
				$('#grade_id').val(data.grd_id);
				$('#mid_term').val(data.mid);
				$('#end_term').val(data.end);
				$('#final').val(data.final);
				$('#hdd_enroll_id').val(data.enroll_id);

				$('#addGradesModal').modal('show');


			},

			error:function(xhr,status,error){
				alert(xhr.responseText);
			}


		});
});

//auto compute average
	$('#end_term').keyup(function(e){
		e.preventDefault();

			let mid_gr = $('#mid_term').val();
			let end_gr = $(this).val();

			if(mid_gr !=''){
				if(end_gr !=''){
					let sum = 0;
					 sum = parseInt(mid_gr)+parseInt(end_gr);
					let  avg = parseFloat(sum)/2;
					$('#final').val(avg);
				}else{
					$('#final').val('');
				}
			}
		});

	$('#mid_term').keyup(function(e){
		e.preventDefault();

			let end_gr = $('#end_term').val();
			let mid_gr = $(this).val();

			if(end_gr !=''){
				if(mid_gr !=''){
					let sum = 0;
					 sum = parseInt(mid_gr)+parseInt(end_gr);
					let  avg = parseFloat(sum)/2;
					$('#final').val(avg);
				}else{
					$('#final').val('');
				}
			}
		});




$(document).on('submit','#addForm',function(e){
e.preventDefault();
	
	$.ajax({
		url:'action-grades/server_grades.php',
		method:'post',
		data:$(this).serialize(),
		dataType:'json',

		beforeSend:function(){
			$('#updateGradeBtn').val('validating...');
			$('#updateGradeBtn').attr('disabled','disabled');

		},

		success:function(data){
			//console.log(data);
			if(data.success){
				swal("Student Grade Updated successfully!", {
				icon: "success",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });
			}

			if(data.err_update){
			swal("Error in Server! Update Query Failed", {
				icon: "error",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });
			}
			if(data.err_empty_grd_id){
				swal("Error in server! Empty Grade ID", {
				icon: "error",
				   }).then((confirmed)=>{
				     window.location.reload();
				 });
			}

			if(data.err_update_R){
				swal("Error in server! Updating R_STATUS error!", {
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