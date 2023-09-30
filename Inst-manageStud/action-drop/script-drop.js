$(document).ready(function(){

$(document).on('click','.addDrop',function(e){
e.preventDefault();

	let dr_idno = $(this).attr('id');
	let dr_acad = $(this).attr('data-value');
	

	$.ajax({
		url:'action-drop/getData_drop.php',
		method:'post',
		data:{dr_idno:dr_idno,dr_acad:dr_acad},
		dataType:'json',

		success:function(data){
			//console.log(data);
			$('#hdd_dr_idno').val(data.IDNO);
			$('#hdd_dr_grd_id').val(data.grd_id);
			$('#hdd_dr_enroll_id').val(data.enroll_id);
			$('#hdd_dr_class_id').val(data.class_id);
			$('#fullNameFuckingDrop').val(data.name);

			$('#addDropModal').modal('show');
		},

		error:function(xhr,status,error){
			alert(xhr.responseText);
		}

	});
});

$(document).on('submit','#dropForm',function(e){
	e.preventDefault();

	if($('#drop1Reason').val()==''){
		//reason text area is null
	}else{

		 swal({
	        title: "Are you sure you want to Drop this student?",
	        text: "",
	        icon: "warning",
	        buttons: true,
	        dangerMode: true,
	}).then((willconfirmed) => {

			if(willconfirmed){
					$.ajax({
					url:'action-drop/server_drop.php',
					method:'post',
					data:$(this).serialize(),
					dataType:'json',

					beforeSend:function(){
						$('#updateDrop1Btn').val('validating...');
						$('#updateDrop1Btn').attr('disabled','disabled');
					},

					success:function(data){
						//console.log(data);
						$('#dropForm')[0].reset();
						if(data.success){
							swal("Student added to DROP!", {
							icon: "success",
							   }).then((confirmed)=>{
							     window.location.reload();
							 });
						}
						if(data.err_up_grd){
							swal("Error Updating Grade Remarks! Query Error!", {
							icon: "error",
							   }).then((confirmed)=>{
							     window.location.reload();
							 });
						}

						if(data.err_up_en_r_status){
							swal("Error Updating tbl enroll r status! Query Error!", {
							icon: "error",
							   }).then((confirmed)=>{
							     window.location.reload();
							 });
						}

						if(data.err_tbl_drop){
							swal("Error inserting tbl drop r! Query Error!", {
							icon: "error",
							   }).then((confirmed)=>{
							     window.location.reload();
							 });
						}

						if(data.err_acd_id){
							swal("Acad id empty! No School year detected!", {
							icon: "error",
							   }).then((confirmed)=>{
							     window.location.reload();
							 });
						}

						if(data.err_empt_idno){
							swal("Error in Server! Empty IDNO", {
							icon: "error",
							   }).then((confirmed)=>{
							     window.location.reload();
							 });
						}
						if(data.err_empt_grd_id){
							swal("Error in Server! Empty grd id", {
							icon: "error",
							   }).then((confirmed)=>{
							     window.location.reload();
							 });
						}

						if(data.err_empt_enroll_id){
							swal("Error in Server! Empty enroll id", {
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
						if(data.err_history){
							swal("Error in Server! Error inserting history!", {
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