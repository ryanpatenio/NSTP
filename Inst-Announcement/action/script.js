$(document).ready(function(){

$(document).on('click','#btn_addAnnouncement',function(e){
e.preventDefault();

$('#addModalAnnouncement').modal('show');

});


$(document).on('submit','#addForm',function(e){
	e.preventDefault();

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
			console.log(data);
			if(data.success){
				swal("New announcement added successfully!", {
					icon: "success",
					 }).then((confirmed)=>{
					    window.location.reload();
				 });
			}
			if(data.err_query){
				swal("Error in server! inserting query into tbl student notif return false", {
					icon: "error",
					 }).then((confirmed)=>{
					    window.location.reload();
				 });
			}

			if(data.error_empty_student_data){
				swal("The selected class has no data! Please insert student first", {
					icon: "warning",
					 }).then((confirmed)=>{
					    window.location.reload();
				 });
			}

			if(data.err_inserting_ann_id){
				swal("Error in Server! inserting query into tbl announcement return false!", {
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

//for poping out the edit modal with details
$(document).on('click','#btn_edit',function(e){
	e.preventDefault();

	let ann_id = $(this).attr('data-value');

	if(ann_id != ''){
		$.ajax({
			url:'action/getData.php',
			method:'post',
			data:{ann_id:ann_id},
			dataType:'json',

			success:function(data){
				
				$('#hiddenAnnID').val(data.ann_id);
				$('#annDataEdit').val(data.content);
				$('#sel_class').val(data.class_name);
				$('#editAnnouncement').modal('show');
			},

			error:function(xhr,status,error){
				alert(xhr.responseText);
			}

		});
	}else{
		alert('Empty ann ID! Error!');
	}

});

//for submitting the edit modal form
$(document).on('submit','#editForm',function(e){
e.preventDefault();

	let content = $('#annDataEdit').val();

	if(content != ''){
		$.ajax({
			url:'action/server.php',
			method:'post',
			data:$(this).serialize(),
			dataType:'json',

			beforeSend:function(){
				$('#editBtn').val('validating...');
				$('#editBtn').attr('disabled','disabled');

			},

			success:function(data){
				//console.log(data);
				$('#editForm')[0].reset();
				if(data.success){
					swal("Announcement updated successfully!", {
						icon: "success",
						 }).then((confirmed)=>{
						    window.location.reload();
					 });
				}

				if(data.err_query){
					swal("Error in server! updating query return false!", {
						icon: "error",
						 }).then((confirmed)=>{
						    window.location.reload();
					 });
				}

				if(data.err_empty_id){
					swal("Error in server! Ann id found empty!", {
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
		alert('Empty Content!');
	}


});

//for poping out the view modal
$(document).on('click','#btn_view',function(e){
	e.preventDefault();

	 let id = $(this).attr('data-value');

	 if(id != ''){

	 	$.ajax({
	 		url:'action/getData.php',
	 		method:'post',
	 		data:{id:id},
	 		dataType:'json',

	 		success:function(data){
	 			//console.log(data);
	 			$('#title').text('To: '+data.to);
	 			$('#contentData').text(data.con);
	 			$('#dateData').text('DATE: '+data.f_date);
	 			$('#view_modal').modal('show');
	 		},

	 		error:function(xhr,status,error){
	 			alert(xhr.responseText);
	 		}

	 	});

	 	

	 }else{
	 	alert('ANN ID is empty!');
	 }
	

});

});