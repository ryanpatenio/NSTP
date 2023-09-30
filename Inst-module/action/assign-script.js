$(document).ready(function(){

$(document).on('click','#assignBtn',function(e){
e.preventDefault();

 	let m_id = $(this).attr('data-value');
 	
 	$.ajax({
 		url:'action/getData.php',
 		method:'post',
 		data:{m_id:m_id},
 		dataType:'json',

 		success:function(data){
 			//console.log(data);
 			
 			$('#mod_title').val(data.title);
 			$('#hdd_id_mod').val(data.m_id);
 			$('#assignModal').modal('show');
 		},

 		error:function(xhr,status,error){
 			alert(xhr.responseText);
 		}

 	});	
});



//submitting the assign form
$(document).on('submit','#AssignModForm',function(e){
e.preventDefault();

	$.ajax({
		url:'action/assign_server.php',
		method:'post',
		data:$(this).serialize(),
		dataType:'json',

		beforeSend:function(){
			$('#ModAssignBtn').val('validating...');
			$('#ModAssignBtn').attr('disabled','disabled');
		},

		success:function(data){
			//console.log(data);
			$('#AssignModForm')[0].reset();
			if(data.success){
				swal("Module Assign Successfully!", {
					icon: "success",
					 }).then((confirmed)=>{
					   window.location.reload();
				});

			}

			if(data.error_class_id){
				swal("Please Select Class!", {
					icon: "warning",
					 }).then((confirmed)=>{
					   $('#ModAssignBtn').val('ADD');
					   $('#ModAssignBtn').attr('disabled',false);
				});
			}
			if(data.error_query2){
				swal("Error in server! updating module status query return false!", {
					icon: "error",
					 }).then((confirmed)=>{
					   window.location.reload();
				});
			}

			if(data.error_query1){
				swal("Error in server! inserting data into tbl assign module query return false!", {
					icon: "error",
					 }).then((confirmed)=>{
					   window.location.reload();
				});
			}
			if(data.error_class_NoData){
				swal("The selected class has no data!", {
					icon: "warning",
					 }).then((confirmed)=>{
					   $('#ModAssignBtn').val('ADD');
					   $('#ModAssignBtn').attr('disabled',false);
				});	
			}

			if(data.error_ACAD){
				swal("No school year detected! maybe the admin didn't set the default school year!", {
					icon: "error",
					 }).then((confirmed)=>{
					   window.location.reload();
				});
			}
			if(data.error_mod_ID){
				swal("Error in server! module id found empty!", {
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




//give warning if the user click the assign button ->already assign module
$(document).on('click','#already_assignBtn',function(e){
e.preventDefault();
	
	swal("This module is already assigned!", {
		icon: "warning",
		 }).then((confirmed)=>{
		   window.location.reload();
	});

});


});