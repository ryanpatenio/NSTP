$(document).ready(function(){
//adding module pop up modal
$(document).on('click','#btn_addModule',function(e){
e.preventDefault();

$('#addModal').modal('show');

});

//for submitting the add module form
$(document).on('submit','#addMForm',function(e){
e.preventDefault();

	var files = $('#moduleFile')[0].files;

	 if(files.length > 0 ){

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




	 		  url:"action/add_action.php",
		      method:"post",
		      data:new FormData(this),
		      dataType:"json",
		      contentType:false,
		      processData:false,
		      cache:false,

		      beforeSend:function(){
		      	$('#btn_add').val('uploading...');
		      	$('#btn_add').attr('disabled','disabled');
		      	$('#d_close').attr('disabled','disabled');
		      	$('.progress').show();

		      },

		      success:function(data){
		      	console.log(data);
		      	$('#addMForm')[0].reset();
		      	if(data.success){
		      		swal("New Module File added successfully!", {
							icon: "success",
							   }).then((confirmed)=>{
							     window.location.reload();
						 });
		      	}
		      	if(data.error_insertData){
		      		swal("Error in Server! inserting Data return error", {
							icon: "error",
							   }).then((confirmed)=>{
							     window.location.reload();
						 });
		      	}
		      	if(data.error_acad){
		      		swal("No School Year detected! Maybe the admin didn't set default Shool Year!", {
							icon: "warning",
							   }).then((confirmed)=>{
							    window.location.reload();
						 });
		      	}

		      	if(data.error_file_invadid){
		      	swal("Invalid File! File must be `docx`,`pdf`,`ppt`", {
							icon: "warning",
							   }).then((confirmed)=>{
							    window.location.reload();
						 });	
		      	}

		      	if(data.error_tooLargeFile){
		      		swal("File was too Large! min less than 20MB!", {
							icon: "warning",
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
	 	//please select file
	 }


});


//for poping out the edit modal : not already assign
$(document).on('click','#editModuleBtn',function(e){
e.preventDefault();

	let md_id = $(this).attr('data-value');

	$.ajax({
		url:'action/getData.php',
		method:'post',
		data:{md_id:md_id},
		dataType:'json',

		success:function(data){
			console.log(data);

			$('#hiddenMOD_ID').val(data.mod_id);
			$('#EditTitle').val(data.title);
			$('#Editdescript').val(data.desc);
			$('#Editdue').val(data.due);
			$('#hiddenFile').val(data.file_loc);

			$('#editType').val(data.type);
			
			if(data.type == '0'){
				$('#editType').text('New Material');
			}else if(data.type == '1'){
				$('#editType').text('Assignment');
			}else if(data.type == '2'){
				$('#editType').text('Exam');
			}

			$('#editModal').modal('show');

		},

		error:function(xhr,status,error){
			alert(xhr.responseText);
		}

	});

});
//for edit modal not already assign
$('.changeFileBtn').click(function(e){
	e.preventDefault();

	$('.uploadNew').show();
	$('.dvBtn').hide();

});
//for edit done module modal : already assign
$('.changeFileBtn2').click(function(e){
	e.preventDefault();

	$('.uploadNew2').show();
	$('.dvBtn2').hide();

});



//submitting the edit module form
$(document).on('submit','#editModule1',function(e){
	e.preventDefault();

	swal({
	        title: "Are you sure you want to update this module?",
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




						url:"action/edit_server.php",
						method:"post",
						data:new FormData(this),
						dataType:"json",
						contentType:false,
						processData:false,
						cache:false,

						beforeSend:function(){
							$('#btn_update').val('validating...');
							$('#btn_update').attr('disabled','disabled');
							$('#df_close').attr('disabled','disabled');
							$('.progress').show();
						},

						success:function(data){
							//console.log(data);
							$('#editModule1')[0].reset();
							if(data.success){
							swal("Module updated successfully!", {
								icon: "success",
								   }).then((confirmed)=>{
								     window.location.reload();
								 });
							}
							if(data.error_query){
								swal("Error in server! Only details query return false 1", {
									icon: "error",
									   }).then((confirmed)=>{
									     window.location.reload();
									 });
							}
							if(data.error_query2){
								swal("Error in server! details with new files query return false 1", {
									icon: "error",
									   }).then((confirmed)=>{
									     window.location.reload();
									 });
							}

							if(data.error_hidden_file){
								swal("Error in server! hidden current file found empty!", {
									icon: "error",
									   }).then((confirmed)=>{
									     window.location.reload();
									 });
							}

							if(data.error_file){
								swal("Invalid File! file must be `docx`,`docs`,`ppt`,`pdf`,`xls`!", {
									icon: "warning",
									   }).then((confirmed)=>{
									     window.location.reload();
									 });
							}

							if(data.error_file_large){
								swal("File was too large!", {
									icon: "warning",
									   }).then((confirmed)=>{
									     window.location.reload();
									 });
							}
							if(data.error_MOD_ID){
								swal("Error in server! module id found empty!", {
									icon: "warning",
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


});

//for displaying done module modal
$(document).on('click','#editDoneBtn',function(e){
e.preventDefault();

	let mod_done_id = $(this).attr('data-value');

	$.ajax({
		url:'action/getData.php',
		method:'post',
		data:{mod_done_id:mod_done_id},
		dataType:'json',

		success:function(data){
			//console.log(data);

			$('#done_mod_id').val(data.mod_id2);
			$('#EditTitle2').val(data.title2);
			$('#Editdescript2').val(data.desc2);
			$('#Editdue2').val(data.due2);
		    $('#hiddenFile2').val(data.file_loc2);

			$('#editType2').val(data.type2);
			if(data.type2 =='0'){
				$('#editType22').text('New Material');
			}else if(data.type2 =='1'){
				$('#editType22').text('Assignment');
			}else if(data.type2 == '2'){
				$('#editType22').text('Exam');
			}

			 $('#editDoneModuleModal').modal('show');

		},

		error:function(xhr,status,error){
			alert(xhr.responseText);
		}

	});
});

//for submitting the edit done module form
$(document).on('submit','#editDoneModule',function(e){
e.preventDefault();

	swal({
	        title: "Are you sure you want to update this module?",
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





						url:"action/edit_server.php",
						method:"post",
						data:new FormData(this),
						dataType:"json",
						contentType:false,
						processData:false,
						cache:false,

						beforeSend:function(){
							$('#btn_update2').val('validating...');
							$('#btn_update2').attr('disabled','disabled');
							$('#dff_close').attr('disabled','disabled');
							$('.progress').show();
						},

						success:function(data){
							//console.log(data);
							$('#editDoneModule')[0].reset();

							if(data.success){
								swal("Module updated successfully!", {
								icon: "success",
								   }).then((confirmed)=>{
								     window.location.reload();
								 });

							}


							if(data.error_queryMD1){
								swal("Error in server! Query updating only module details return false!", {
									icon: "error",
									   }).then((confirmed)=>{
									     window.location.reload();
									 });
							}

							if(data.error_queryMD2){
							swal("Error in server! Query updating module details with files return false!", {
									icon: "error",
									   }).then((confirmed)=>{
									     window.location.reload();
									 });	
							}
							if(data.error_hiddenFile_MD){
								swal("Error in server! hidden Current file found empty!", {
									icon: "error",
									   }).then((confirmed)=>{
									     window.location.reload();
									 });	
							}

							if(data.error_file_invalid){
								swal("Invalid File! file must be `docx`,`ppt`,`xls`,`docs`,`pdf`!", {
									icon: "warning",
									   }).then((confirmed)=>{
									     window.location.reload();
									 });
							}

							if(data.error_file_large){
								swal("File was too large! file must not exceed 19MB!", {
									icon: "warning",
									   }).then((confirmed)=>{
									     window.location.reload();
									 });
							}

							if(data.error_MD_ID){
								swal("Error in Server! module id found empty!", {
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


});


$(document).on('click','#viewBtn',function(e){
e.preventDefault();

	let vh_mod_id = $(this).attr('data-value');
	$.ajax({
		url:'action/getData.php',
		method:'post',
		data:{vh_mod_id:vh_mod_id},	

		success:function(data){
			$('#fetchData').html(data);
		},

		error:function(xhr,status,error){
			alert(xhr.responseText);
		}

	});

$('#viewModal').modal('show');


});


// $(document).on('change','#target',function(e){
// e.preventDefault();

// 	$.ajax({
// 		url:'',
// 		method:'post',
// 		data:$(this).serialize(),
// 		data:'json',

// 		beforeSend:function(){

// 		},

// 		success:function(data){

// 		},

// 		error:function(xhr,status,error){
// 			alert(xhr.responseText);
// 		}

// 	});


// });

});