$(document).ready(function(){


$(document).on('click','.viewMod',function(e){
e.preventDefault();

	let IDNO = $('#hidden_idno').val();
	let MOD_ID = $(this).attr('id');
	let ass_id  = $(this).attr('data-value');

	$.ajax({
		url:'action/getData.php',
		method:'post',
		data:{IDNO:IDNO,MOD_ID:MOD_ID},
		dataType:'json',

		success:function(data){
			//console.log(data);

			

			$('#mod_id').val(data.MOD_ID);
			$('#title').text(data.title);
			$('#posted').text('Posted Date : '+data.posted);
			$('#dueDate').text('DUE DATE : '+data.due);
			$('#description').text('Description : '+data.desc);
			// $('#file_loc').attr('href','../myAddFile/'+data.file_loc);
			$('#class_id').val(data.class_id);
			$('#ass_id').val(ass_id);
			 ModuleLiveCheck();


			$('#myModule').modal('show');
		},

		error:function(xhr,status,error){
			alert(xhr.responseText);
		}

	});
	




});

//for poping out the second modal in
$(document).on('click','#btnaddwork',function(e){
e.preventDefault();
	
	let ass_id = $('#ass_id').val();
	
	if(ass_id !=''){
		$('#ass_id').val(ass_id);
		
		$('#uploadWork').modal('show');

		
	}else{
		alert('assign id not found! Error!');
	}	

});

//for submitting or upload work module
$(document).on('submit','#form_addMod',function(e){
	e.preventDefault();

	let files = $('#passFile')[0].files;
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




				  url:"action/submit_server.php",
			      method:"POST",
			      data:new FormData(this),
			      dataType:"json",
			      contentType:false,
			      processData:false,
			      cache:false,

			      beforeSend:function(){
			      	$('#submit_module').val('uploading...');
			      	$('#submit_module').attr('disabled','disabled');
			      	$('#df_close_btn').attr('disabled','disabled');
			      	$('.progress').show();
			      },	

			      success:function(data){
			      	console.log(data);
			      	$('#form_addMod')[0].reset();
			      	if(data.success){
			      		swal("File submitted successfully!", {
							icon: "success",
							   }).then((confirmed)=>{
							     window.location.reload();
							 });
			      	}

			      	if(data.error_acad){
			      		swal("No Academic Year Detected! Maybe the admin didn't set Default School year!", {
							icon: "warning",
							   }).then((confirmed)=>{
							     window.location.reload();
							 });
			      	}

			      	if(data.error_fileType){
			      		swal("Invalid file! File must be `docx`,`pdf`,`ppt`,`xls`!", {
							icon: "warning",
							   }).then((confirmed)=>{
							     window.location.reload();
							 });
			      	}

			      	if(data.error_file){
					swal("Error! file is Empty or broken!", {
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
		//no files
		swal("Please Select File!", {
	      	 icon: "warning",
	      });
	}


});




function ModuleLiveCheck(){
  var assID = $('#ass_id').val();
  var modID = $('#mod_id').val();

  
  $.ajax({
    url:"action/live_server.php",
    method:"post",
    data:{assID:assID,modID:modID},
    

    success:function(data){
      $('#viewBody').html(data);
    },

    error:function(xhr,status,error){
    	alert(xhr.responseText);
    }


  });

}


$(document).on('click','.btnunsubmit',function(e){
e.preventDefault();
	
	let IDNO = $('#IDNO').val();
	let class_id = $('#class_id').val();
	let ass_id = $(this).attr('id');
	let pass_id = $(this).attr('data-value');



   swal({
        title: "Are You Sure You Want To Unsubmit This File?",
        text: "After Unsubmitting File Please Upload File Immediately!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
}).then((willunsubmit) => {

	if(willunsubmit){

		$.ajax({
			url:'action/unsubmit_server.php',
			method:'post',
			data:{unsubmit:IDNO, class_id:class_id, ass_id:ass_id, pass_id:pass_id},
			dataType:'json',

			beforeSend:function(){
				$('.btnunsubmit').val('unsubmitting...');
				$('.btnunsubmit').attr('disabled','disabled');

			},

			success:function(data){
				console.log(data);

				if(data.success){
					swal("File UNSUBMITTED successfully!", {
						icon: "success",
						  }).then((confirmed)=>{
					         window.location.reload();
					 });	
				}

				if(data.err_no_acad){
					swal("No School Year Detected! Maybe the admin didn't set Default School year!", {
						icon: "warning",
						  }).then((confirmed)=>{
					         window.location.reload();
					 });
				}

				if(data.error_delQuery){
					swal("Error in Server! Delete query return false!", {
						icon: "error!",
						  }).then((confirmed)=>{
					         window.location.reload();
					 });	
				}
				if(data.error_reporting){
					swal("Error in Server! creating student notif query return false!", {
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




});