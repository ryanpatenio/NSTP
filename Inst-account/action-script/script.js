$(document).ready(function(){
    
    $('#avatar').change(function(e){
      e.preventDefault();
      let output_img = document.getElementById("curImg");
        output_img.src=URL.createObjectURL(event.target.files[0]);
          output_img.onload = function(){
            URL.revokeObjectURL(output_img.src);//free memory
          };
          $('#upBtn').show();

    });


   

      // var loadFile = function(event){
      //     var output = document.getElementById("curImg");
      //     output.src=URL.createObjectURL(event.target.files[0]);
      //     output.onload = function(){
      //       URL.revokeObjectURL(output.src)
      //     }
      // };


  


    $('#upImg').on('submit',function(e){
      e.preventDefault();

      let fd = new FormData($('#upImg')[0]);
      let files = $('#avatar')[0].files;
      //fd.append('file',files[0]);

       if(files.length > 0 ){
         $.ajax({

            url:"action.php",
            method:"POST",
            data:fd,
            dataType:"json",
            contentType:false,
            processData:false,
            cache:false,

            beforeSend:function(){
              $('#prog').show();

              $('#upBtn').val('Uploading...');
              $('#upBtn').attr('disabled','disabled');
            },

            complete:function(){
              $('#prog').hide();
            },

            success:function(data){
            $('#upImg')[0].reset();

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


               if(data.error_query){
                swal({
                    title: "Failed To execute Query!",
                    text: "System Error!",
                    icon: "error",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
               }

               if(data.error_img){
                  swal({
                    title: "File Was Not Image!",
                    text: "System Error!",
                    icon: "error",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
               }

               if(data.error_file_size){
                swal({
                    title: "File Size Was Too Large!",
                    text: "System Error!",
                    icon: "error",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
               }

               if(data.error_inst_id){
                swal({
                    title: "No Instructor ID Found! Contact Your Administrator!",
                    text: "System Error!",
                    icon: "error",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
               }

            },
              error:function(){
              swal({
                    title: "Failed To Update Data!",
                    text: "Check your Internet Connection",
                    icon: "error",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
            }

          

          });



       }else{
        swal("Please Select File!", {
              icon: "warning",
           }).then((confirmed)=>{
            window.location.reload();
           });
       }

     

    });


     $('#repass').keyup(function(){

      if($(this).val() != $('#pass1').val()){
        $('#error_pass').text('Password Not Match!');
        $('#error_pass').attr('class','text-danger');

      }else{
        $('#error_pass').text('Password Match!');
        $('#error_pass').attr('class','text-success');
      }

    });

     $('#editacc').on('submit',function(e){
      e.preventDefault();

        var pass1 = $('#pass1').val();
        var repass = $('#repass').val();

        if(pass1 != repass){

        }else{

            $.ajax({
              url:"action.php",
              method:"post",
              data:$(this).serialize(),
              dataType:"json",

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
                if(data.error_inst_id){
                  swal({
                    title: "Instructor ID not Found!Contact Your Administrator!",
                    text: "System Error!",
                    icon: "error",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
                }
                if(data.error_numrows){
                  swal({
                    title: "Zero Num rows Result! Select Query Zero Results!",
                    text: "System Error!",
                    icon: "error",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
                }

                if(data.error_query){
                  swal({
                    title: "Failed To execute Query!",
                    text: "System Error!",
                    icon: "error",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
                }

                if(data.error_oldpass){
                  swal({
                    title: "Old Password is Incorrect!",
                    text: "",
                    icon: "info",
                    button: "OK",
                    }).then((confirmed) => {
                    window.location.reload();
                    });
                }

                //error for empty Fields
                if(data.error){
                  if(data.error_fname !=''){
                    $('#error_fname').text(data.error_fname);
                  }else{
                    $('#error_fname').text('');
                  }

                  if(data.error_lname !=''){
                    $('#error_lname').text(data.error_lname);
                  }else{
                    $('#error_lname').text('');
                  }

                  if(data.error_email !=''){
                    $('#error_email').text(data.error_email);
                  }else{
                    $('#error_email').text('');
                  }
                  if(data.error_old !=''){
                    $('#error_old').text(data.error_old);
                  }else{
                    $('#error_old').text('');
                  }
                  if(data.error_new !=''){
                    $('#error_new').text(data.error_new);
                  }else{
                    $('#error_new').text('');
                  }
                }
              }

      });



        }

     });

  });