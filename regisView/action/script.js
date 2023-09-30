$(document).ready(function(){


	$(document).on('click','#x_btn',function(e){
		e.preventDefault();

		$('#reportModal').modal('show');


	});


//for school year event listener
$(document).on('change','#year',function(e){
e.preventDefault();

let yr3 = $('#year').val();
let sm3 = $('#semester').val();

	$.ajax({
		url:'action/getData.php',
		method:'post',
		data:{fetching2:yr3,sm3:sm3},

		success:function(data){
			$('#fetch_data').html(data);

		},
		error:function(xhr,status,error){
			alert(xhr.responseText);
		}


	});


});

//event listener for semester
$(document).on('change','#semester',function(e){
e.preventDefault();

let yr2 = $('#year').val();
let sm2 = $('#semester').val();

	$.ajax({
		url:'action/getData.php',
		method:'post',
		data:{fetching:yr2,sm2:sm2},

		success:function(data){
			$('#fetch_data').html(data);

		},
		error:function(xhr,status,error){
			alert(xhr.responseText);
		}


	});


});



function live_data(){

let yr = $('#year').val();
let sm = $('#semester').val();
	$.ajax({
		url:'action/getData.php',
		method:'post',
		data:{live_table:yr,sm:sm},

		success:function(data){
			$('#fetch_data').html(data);

		},
		error:function(xhr,status,error){
			alert(xhr.responseText);
		}

	});

}

live_data();


//for searching
$('#search').on("keyup",function(){
var value = $(this).val().toLowerCase();
console.clear();

$('#dt_table tr').each(function(index){
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



});