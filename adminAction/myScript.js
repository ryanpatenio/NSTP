$(document).ready(function(){

let divError = $('.error_alert');
let errMessage = $('#error_message');
let adminLink = $('.divLink');
let buttonLg = $('#btnLg');


	function enableButton(){
		buttonLg.attr('disabled',false);
		buttonLg.val('Login');
	}
	function displayLink(){
		adminLink.show('slow').delay(5000);
	}
	
	


$(document).on('submit','#processMe',function(e){
e.preventDefault();

$.ajax({
	url: "adminAction/server.php",
	method: "post",
	data : $(this).serialize(),
	dataType:"json",

	beforeSend:function(){
		
		buttonLg.val('Validating...');
		buttonLg.attr('disabled','disabled')
		adminLink.hide();
		
	},
	
	success:function(data){
		

		if(data.success_inst){
			
			setTimeout(function(){
				window.location.href="Inst-main/";
			},1000);
			
		}
		

		if(data.error_acc){
			//not Found!
			
			setTimeout(function(){
				divError.show();
				errMessage.text('Invalid Username OR Password').fadeTo(3000,500).slideUp(500);
				divError.fadeTo(3000,500).slideUp(500);
				displayLink();
				enableButton();

			},1000);

		}

		if(data.error_active){
			//Account Not Active
			setTimeout(function(){
				divError.show();
				errMessage.text('Account Not Active Contact Your Admin!').fadeTo(3000,500).slideUp(500);
				divError.fadeTo(3000,500).slideUp(500);
				displayLink();
				enableButton();

			},1000);
		}

		if(data.error_Type){
			//Error
			setTimeout(function(){
				divError.show();
				errMessage.text('Invalid Username OR Password').fadeTo(3000,500).slideUp(500);
				divError.fadeTo(3000,500).slideUp(500);
				displayLink();
				enableButton();

			},1000);

		}
		//for empty Fields Error
		if(data.error){
			if(data.error_email != ''){
				//Email Empty
				$('#errorEmail').text(data.error_email).fadeTo(3000,500).slideUp(500);
				displayLink();
				enableButton();

			}
			if(data.error_pass != ''){
				//password Empty
				$('#errorPass').text(data.error_pass).fadeTo(3000,500).slideUp(500);
				displayLink();
				enableButton();
			}
		}
	},
	error:function(){
		divError.show();
		errMessage.text('Failed To Login! Or Check Your Internet Connection!').fadeTo(3000,500).slideUp(500);
		divError.fadeTo(3000,500).slideUp(500);
		displayLink();
	    enableButton();
	}



});

});



});