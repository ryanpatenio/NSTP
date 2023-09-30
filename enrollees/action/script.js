$(document).ready(function(){

//for searching
$('#search').on("keyup",function(){
var value = $(this).val().toLowerCase();
console.clear();

$('#dataTable1 tr').each(function(index){
if(index !== 0){
	$row = $(this);
	$row.find("td").each(function(i,td){
	var id = $(td).text().toLowerCase();
	//console.log(id+" | "+value+" | "+ id.indexOf(value))
	if(id.indexOf(value) !== -1){
		$row.show();
		return false;
	}else{
		$row.hide();

	}

	});
}

});

});


//for displaying credential Modal for enrolling second sem
// $(document).on('click','.re-enroll',function(e){
// e.preventDefault();

// 	let IDNO = $(this).attr('data-value');
	


// $('#reenrolledModal').modal('show');

// });


//for displaying on the top of the enrollModal:: add Enrolled
$(document).on('click','.newEnrollBtn',function(e){
e.preventDefault();

let new_id = $(this).attr('id');

	$.ajax({
		url:'action/getData.php',
		method:'post',
		data:{new_get_id:new_id},
		dataType:'json',

		success:function(data){
			
			$('#IDNO').val(data.ID);
			$('#stud_name').val(data.name);
			$('#addNew').modal('show');
		},
		error:function(xhr,status,error){
			alert(xhr.responseText);
		}

	});
});

//submitting the new enrolles modal form
$(document).on('submit','#letEnroll',function(e){
e.preventDefault();

	$.ajax({
		url:'action/server.php',
		method:'post',
		data:$(this).serialize(),
		dataType:'json',

		beforeSend:function(){
			$('#addFbtn').val('validating...');
			$('#addFbtn').attr('disabled','disabled');
		},

		success:function(data){
			$('#letEnroll')[0].reset();
			if(data.success){			
			swal("New student enroll successfully!", {
                icon: "success",
		          }).then((confirmed)=>{
		             window.location.reload();

		     });
			}

			if(data.err_query_enroll){
			swal("Error in enrolling Students Query Failed!", {
                icon: "error",
		          }).then((confirmed)=>{
		             window.location.reload();

		     });
			}

			if(data.err_update_stats){
			swal("Error in updating Students Status! Query Failed!", {
                icon: "error",
		          }).then((confirmed)=>{
		             window.location.reload();

		     });
			}

			if(data.err_empty_stats){
			swal("Error! Empty Status Detected!", {
                icon: "error",
		          }).then((confirmed)=>{
		             window.location.reload();

		     });
			}

			if(data.err_empty_acad){
			swal("No School Year Detected! Add or Set School year into default First!", {
                icon: "warning",
		          }).then((confirmed)=>{
		             window.location.reload();

		     });
			}

			if(data.err_empty_course){
			swal("Error! empty course detected!", {
                icon: "error",
		          }).then((confirmed)=>{
		             window.location.reload();

		     });
			}

			if(data.err_empty_sectID){
			swal("Error! empty section detected!", {
                icon: "error",
		          }).then((confirmed)=>{
		             window.location.reload();

		     });
			}

			if(data.err_empty_class){
			swal("Error! empty class detected!", {
                icon: "error",
		          }).then((confirmed)=>{
		             window.location.reload();

		     });
			}

			if(data.err_empty_idno){
			swal("Error! IDNO not found!", {
                icon: "error",
		          }).then((confirmed)=>{
		             window.location.reload();

		     });
			}

			if(data.err_insert_null_grades){
			swal("Error! Inserting null grades Query failed!", {
                icon: "error",
		          }).then((confirmed)=>{
		             window.location.reload();

		     });				
			}

			if(data.err_history_failed){
				swal("Error! Inserting Student history Query failed!", {
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