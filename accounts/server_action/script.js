$(document).ready(function(){

//declaring variable
let imageDisplay = document.getElementById('curImg');
let uploadingBtn = $('#saveBtn');

$("#avatar2").change(function(e){
	e.preventDefault();

	let filesImg = $('#avatar2')[0].files;

	if(filesImg.length > 0){
		imageDisplay.src=URL.createObjectURL(event.target.files[0]);
		imageDisplay.onload = function(){

			URL.revokeObjectURL(imageDisplay.src);
			
		};
		uploadingBtn.show();
		

	}else{
		var origImg = $('#curImg').attr('data-value');
      	imageDisplay.src = origImg;
      	uploadingBtn.hide();
	}

	

});

//Updating Image or Submitting
$('#imgupload').on('submit',function(e){
	e.preventDefault();
  let fd = new FormData($('#imgupload')[0]);
  let files2 = $('#avatar2')[0].files;

  if(files2.length > 0){
  	$.ajax({
  		url:'actionImg.php',
  		method:'post',
  		data:fd,
  		dataType:'json',
  		contentType:false,
        processData:false,
        cache:false,

        beforeSend:function(){
        	uploadingBtn.val('uploading...');
        	uploadingBtn.attr('disabled','disabled');
        },

        success:function(data){
        	 $('#imgupload')[0].reset();
        	if(data.success){
        		swal({
                    title: "Avatar Updated Successfully!",
                    text: "",
                    icon: "success",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
        	}

        	if(data.imgLarge){
        		swal({
                    title: "Image Size Was Too Large!",
                    text: "",
                    icon: "error",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
        	}
        	if(data.img_invalid){
        		swal({
                    title: "File is not an Image!",
                    text: "",
                    icon: "error",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
        	}
        	if(data.query_error){
        		swal({
                    title: "Error Query Contact Your Administrator!",
                    text: "System Error!",
                    icon: "error",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
        	}

        	if(data.error_oldImg){
        		swal({
                    title: "Old Image Not Found! Contact Your Administrator!",
                    text: "System Error!",
                    icon: "error",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
        	}	
        }


  	});
  }else{
  	swal("Please Select File!", {
              icon: "warning",
         });
  }


});


//key event listerer for confirm password
$('#cfPass').keyup(function(){

      if($(this).val() != $('#newPass').val()){
        $('#span_error').text('Password Not Match!');
        $('#span_error').attr('class','text-danger');

      }else{
        $('#span_error').text('Password Match!');
        $('#span_error').attr('class','text-success');
      }

    });


//userDetail

$('#editMyAccount').on('submit',function(e){
	e.preventDefault();

	$.ajax({
		url:'edit_action.php',
		method: 'post',
		data:$(this).serialize(),
		dataType: 'json',

		beforeSend:function(){
			$('#saveDetailsBtn').attr('disable','disabled');
		},

		success:function(data){
			
			if(data.success){
				swal({
                    title: "Account Updated Successfully!",
                    text: "",
                    icon: "success",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
			}
			if(data.empty_id){
				//ID Not Found
				swal({
                    title: "ID not Found! Contact Your Administrator!",
                    text: "System Error!",
                    icon: "error",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
			}

			if(data.numrow_error){
				swal({
                    title: "No Result Found(numrows)! Contact Your Administrator!",
                    text: "System Error!",
                    icon: "error",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
			}
			if(data.error_query){
				swal({
                    title: "Query Failed To execute! Contact Your Administrator!",
                    text: "System Error!",
                    icon: "error",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
			}

			if(data.error_pass){
				swal({
                    title: "OLD Password Is Incorrect!",
                    text: "",
                    icon: "error",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
			}

			//error for empty Fields
                if(data.error){
                  if(data.error_fname != ''){
                  	$('#error_fname').text(data.error_fname);
                  }else{
                  	$('#error_fname').text('');
                  }

                  if(data.error_lname != ''){
                  	$('#error_lname').text(data.error_lname);
                  }else{
                  	$('#error_lname').text('');
                  }

                  if(data.error_email != ''){
                  	$('#error_user').text(data.error_email);
                  }else{
                  	$('#error_user').text('');
                  }

                  if(data.error_oldPass != ''){
                  	$('#error_old').text(data.error_oldPass);
                  }else{
                  	$('#error_old').text('');
                  }
                  if(data.error_newpass != ''){
                  	$('#error_new').text(data.error_newpass);
                  }else{
                  	$('#error_new').text('');
                  }
                  if(data.error_repass != ''){
                  	$('#span_error').text(data.error_repass);
                  }else{
                  	$('#span_error').text('');
                  }
                }
		}



	});


});


});