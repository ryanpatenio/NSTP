$(document).ready(function(){
//set all important Variable
let adDivLink = $('#linkAdDiv');
let buttonAdLg = $('#btnAdLg');

//error Variable
let divAlert = $('.error_alert2');
let err_message = $('#error_message2');

function enableButton(){
		buttonAdLg.attr('disabled',false);
		buttonAdLg.val('Login');
		
	}
	function displayLink(){
		adDivLink.show('slow').delay(5000);
	}


	$(document).on('submit','#AdProcess',function(e){
		e.preventDefault();
		$.ajax({
			url:"adminAction/server.php",
			method:"post",
			data:$(this).serialize(),
			dataType:"json",

			beforeSend:function(){
				buttonAdLg.val('Validating...');
				buttonAdLg.attr('disabled','disabled')
				adDivLink.hide();
			},

			success:function(data){
				console.log(data);
				if(data.success_login){
					//success
					setTimeout(function(){
						window.location.href="index.php";
					},1000);
				}
				if(data.regist){
					setTimeout(function(){
						window.location.href="regisView/";
					},2000);
				}

				if(data.err_type){
					//Acc not Found!
					setTimeout(function(){
						divAlert.show();
						err_message.text('Invalid Username OR Password').fadeTo(3000,500).slideUp(500);
						divAlert.fadeTo(3000,500).slideUp(500);
						displayLink();
						enableButton();

					},1000);

				}

				if(data.err_acc){
					//Account Not Found! Invalid
					setTimeout(function(){
						divAlert.show();
						err_message.text('Invalid Username OR Password').fadeTo(3000,500).slideUp(500);
						divAlert.fadeTo(3000,500).slideUp(500);
						displayLink();
						enableButton();

					},1000);
				}

				if(data.error){
					if(data.err_email != ''){
						$('#email_error').text(data.err_email).fadeTo(3000,500).slideUp(500);
						displayLink();
						enableButton();
					}
					if(data.err_pass != ''){
						$('#pass_error').text(data.err_pass).fadeTo(3000,500).slideUp(500);
						displayLink();
						enableButton();
					}
				}
			},

			error:function(){
				divAlert.show();
				err_message.text('Failed To Login! Or Check Your Internet Connection!').fadeTo(3000,500).slideUp(500);
				divAlert.fadeTo(3000,500).slideUp(500);
				displayLink();
			    enableButton();
			}

		});

	});

});