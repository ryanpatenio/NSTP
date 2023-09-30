$(document).ready(function(){


$(document).on('submit','#edit_incForm',function(e){
e.preventDefault();

	
		 swal({
	        title: "Are you sure you want to update this `INC` student?",
	        text: "",
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
							$('#btn_save').val('validating...');
							$('#btn_save').attr('disabled','disabled');
						},

						success:function(data){
							//console.log(data);
							if(data.success){
								swal("Student `INC` updated successfully!", {
									icon: "success",
									   }).then((confirmed)=>{
									     window.location.href="../Inst-inc/";
									 });
							}
							if(data.err_updating_grades){
								swal("Error in server! updating grades query return false!", {
									icon: "error!",
									   }).then((confirmed)=>{
									     window.location.reload();
									 });
							}
							if(data.err_updating_enroll){
								swal("Error in server! updating tbl enroll query return false!", {
									icon: "error!",
									   }).then((confirmed)=>{
									     window.location.reload();
									 });
							}

							if(data.err_empt_final){
								swal("Empty Final input field!", {
									icon: "error!",
									   }).then((confirmed)=>{
									     $('#fin').focus();
									 });
							}

							if(data.err_empt_end){
								swal("Empty end term input field!", {
									icon: "warning!",
									   }).then((confirmed)=>{
									     $('#end').focus();
									 });
							}

							if(data.err_empt_mid){
								swal("Empty mid term input field!", {
									icon: "warning!",
									   }).then((confirmed)=>{
									     $('#mid').focus();
									 });
							}

							if(data.err_empt_grd_id){
								swal("Error in server! Empty grd id!", {
									icon: "error!",
									   }).then((confirmed)=>{
									     window.location.reload();
									 });
							}

							if(data.err_empt_enroll_id){
								swal("Error in server! Empty enroll id!", {
									icon: "error!",
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