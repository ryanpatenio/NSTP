<?php


include('../student-asset/header.php');
include('../student-asset/sidebar.php');

$stud = new studentUser();
$res = $stud->getStudentData($_SESSION['student_id']);



 ?>

 <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">MANAGE MY ACCOUNT</h4>
        </ol>



        <div class="row">
          
                  <div class="col-md-3">

            <form method="post" id="upImg" enctype="multipart/form-data">
              <input type="hidden" value="<?php echo $IDNO; ?>" name="stud_id">

              <?php

              if($res->avatar=='null'){
                $result1 = '../images/default2.jpeg';
               
              }else{
                $result1 = "img/".$res->avatar;
                
              }

               ?>

              <!----IMG----->
              <img id="curImg" name="curImg" style="height: 250px;width: 300px;" src="<?php echo $result1; ?>" class="img-thumbnail" />
             <input type="hidden" value="<?php echo $result1; ?>" name="oldimg">
              <!----IMG----->

              <label style="margin-top: 10px;"><strong>Change Avatar?</strong></label>
              <input type="file" class="form-group" accept="image/*" name="avatar" id="avatar" style="margin-top: 0px;margin-bottom: 0px;">

              <div>
                 <progress id="prog" style="width: 200px;">
              </div>

              <input type="hidden" name="action" id="action" value="addimg">
              <input type="submit" id="upBtn" class="btn btn-primary" value="Upload..." name="" style="margin-top: 10px;width: 200px;">

              </form>
            </div>    










 <div class="col-md-9">


              <form method="post" id="editacc">
                 <input type="hidden" value="<?php echo $IDNO; ?>" name="student_id">
                


                  <div class="row">
                    <div class="col">
                      <label style="margin-top: 15px;"><strong>Username</strong></label>
                      <input type="email" class="form-control" name="username" style="width: 360px;position: relative;" required="" placeholder="email" value="<?php echo $res->USERNAME; ?>">
                      <span class="text-danger" id="error_email"></span>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col" >
                      <label style="margin-top: 15px;"><strong>Old Password</strong></label>
                      <input type="password" class="form-control" name="oldpass" id="olpass" style="width: 360px;position: relative;" required="" placeholder="Old Password">
                      <span class="text-danger" id="error_old"></span>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <label style="margin-top: 15px;"><strong>New Password</strong></label>
                      <input type="password" class="form-control" name="pass1" id="pass1" style="width: 360px;position: relative;" required="" placeholder="New Password">
                      <span class="text-danger" id="error_new"></span>

                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <label style="margin-top: 15px;"><strong>Confirm Password</strong></label>
                      <input type="password" class="form-control" name="repass" id="repass" style="width: 360px;position: relative;" required="" placeholder="Confirm Password">
                      <span class="text-danger" id="error_pass"></span>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <input type="hidden" name="action" value="editDetails">
                      <button class="btn btn-primary" style="position: relative;margin: 0px;margin-bottom:15px;margin-top: 20px;width: 360px; "><i class=" fa fa-save"> SAVE</i></button>
                    </div>
                  </div>
           

      
            </div>



  


        </div>

<?php

include('../student-asset/footer.php');
include('../student-asset/script.php');



 ?>

<script type="text/javascript">
  
  $(document).ready(function(){
    $('#prog').hide();
    $('#upBtn').hide();

    $('#avatar').change(function(e){
      e.preventDefault();
      let output_img = document.getElementById("curImg");
        output_img.src=URL.createObjectURL(event.target.files[0]);
          output_img.onload = function(){
            URL.revokeObjectURL(output_img.src);
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
                    title: "File Is Not Image!",
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

               if(data.error_student_id){
                swal({
                    title: "No Student ID Found! Contact Your Administrator!",
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

//updating Details
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
                if(data.error_student_id){
                  swal({
                    title: "STUDENT ID not Found!Contact Your Administrator!",
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


<?php check_message(); ?>

  });
</script>
