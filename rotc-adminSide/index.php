<?php session_start(); ?>

<?php require_once('../include/initialize.php'); ?>



<!DOCTYPE html>
<html lang="en">

<head>

 <?php
require_once("../theme/link-header.php");


  ?>

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <img src="../images/logo.jfif" style="width: 40px; margin-right: 10px;border-radius: 10px;">
    <a class="navbar-brand mr-1" href="<?php echo WEB_ROOT; ?>" style="color: orange;">NSTP ADMIN</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        
      </div>
    </form>

    <!-- Navbar -->
    <?php require_once('../theme/accountDropdown.php'); ?>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php require_once('../themeAsset/adminSidebar.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
         <h4 class="center">LIST OF ROTC STUDENTS</h4>
        </ol>


        <!-- DataTables Example -->
          <?php require_once('rotc-table.php'); ?>

      </div>
      <!-- /.container-fluid -->



     <!-- /.View Modal -->
<div class="modal" id="viewModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Student Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="student_details">

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!----View Modal       ---->
<?php require_once("editModal.php"); ?>

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  

<!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  
  <script src="../vendor/datatables/jquery.dataTables.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../js/demo/datatables-demo.js"></script>
  
  <script src="../vendor/jquery/sweetalert.min.js"></script>

</body>

</html>
<script type="text/javascript">
  
$(document).ready(function(){


 
$(document).on('click', '.view_student', function(){

   var student_id = $(this).attr('id');
   
    $.ajax({
      url:"view_action.php",
      method:"POST",
      data:{action:'single_fetch',student_id : student_id},
      success:function(data)
      {
        $('#viewModal').modal('show');
        $('#student_details').html(data);
      }
    });
  });

//this jquery codes is for poping out the edit form modal
$(document).on('click','.editModal',function(e){
  e.preventDefault();

  let STUD_ID = $(this).attr('id');
  $('#editStudent').modal('show'); 
  $.ajax({
    url:"action.php",
    method:"post",
    data:{STUD_ID:STUD_ID},
    dataType:"json",

    success:function(data){
      $('#IDNO').val(data.IDNO);

      $('#hiddenNSTP_ID').val(data.NSTP_ID);
      $('#hiddenSECT_ID').val(data.SECT_ID);
      $('#ID').val(data.STUD_ID);

      $('#fname').val(data.STUD_NAME);
     
      $('#bday').val(data.BDAY);
      $('#gender').val(data.GENDER);
      $('#addresss').val(data.ADDRESS);

      $('#nstp_id').text(data.NSTP_PROGRAM);
      $('#nstp_id').val(data.NSTP_ID);

      $('#cysID').text(data.cys)
       $('#cysID').val(data.SECT_ID)
      $('#contact').val(data.CONTACT);

      $('#editStudent').modal('show'); 
    }

  });
});

//end of displaying Data in the Modal

//this instruction is for updating students
$(document).on('click','#updateStudent',function(e){
  e.preventDefault();

  let IDNO = $('#IDNO').val();
  let STUD_ID = $('#ID').val();
  let hiddenSECT_ID = $('#hiddenSECT_ID').val();
  let hiddenNSTP_ID = $('#hiddenNSTP_ID').val();

  let NSTP_COURSE = $('#category').val();
  let cys = $('#sub-category').val();
  let fname = $('#fname').val();
  

  let bday = $('#bday').val();
  let gender = $('#gender').val();
  let address = $('#addresss').val();
  let contact = $('#contact').val();

 
swal({
        title: "Are you sure you want to Edit This Student?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
}).then((willUpdate) => {
  if(willUpdate){

  $.ajax({
    url:"edit_Action.php",
    method:"post",
    data:{IDNO:IDNO, STUD_ID:STUD_ID, hiddenNSTP_ID:hiddenNSTP_ID, hiddenSECT_ID:hiddenSECT_ID,NSTP_COURSE:NSTP_COURSE, cys:cys, fname:fname,bday:bday, gender:gender, address:address, contact:contact},
    dataType:"json",

    success:function(data){
      if(data.success){
        swal({
            title: "STUDENT DETAILS UPDATED SUCCESSFULLY!",
            text: "",
            icon: "success",
            button: "OK",
            }).then((confirmed) => {
            window.location.reload();
            });

      }

      //this error is for the system Data Detections
      if(data.error_HaveData){
        swal({
            title: "This Student Have Already Data Or Grades In The Database!",
            text: "You Cant Update His/Her Sections Or NSTP PROGRAM!",
            icon: "error",
            button: "OK",
            }).then((confirmed)=>{
              window.location.reload();
            });
      }

      //this error is for the system  Error
      if(data.error_query2){
        swal({
            title: "Unexpected Error! Please Contact Your Administrator!",
            text: "Query 2!",
            icon: "error",
            button: "OK",
            }).then((confirmed) => {
            window.location.reload();
            });
      }
      if(data.error_query1){
        swal({
            title: "Unexpected Error! Please Contact Your Administrator!",
            text: "Query 1!",
            icon: "error",
            button: "OK",
            }).then((confirmed) => {
            window.location.reload();
            });
      }
      if(data.error_query21){
        swal({
            title: "Unexpected Error! Please Contact Your Administrator!",
            text: "Query 21!",
            icon: "error",
            button: "OK",
            }).then((confirmed) => {
            window.location.reload();
            });
      }
      if(data.error_query12){
        
        swal({
            title: "Unexpected Error! Please Contact Your Administrator!",
            text: "Query 12!",
            icon: "error",
            button: "OK",
            }).then((confirmed) => {
            window.location.reload();
            });
      }


      //this error for empty fields
      if(data.error){
        if(data.error_fname!=''){
          $('#error_fname').text(data.error_fname);
        }else{
          $('#error_fname').text('');
        }
      

        if(data.error_bday!=''){
          $('#error_bday').text(data.error_bday);
        }else{
          $('#error_day').text('');
        }

        if(data.error_gender!=''){
          $('#error_bday').text(data.error_gender);
        }else{
          $('#error_bday').text('');
        }

        if(data.error_address!=''){
          $('#error_address').text(data.error_address);
        }else{
          $('#error_address').text('');
        }

        if(data.erro_contact!=''){
          $('#error_contact').text(data.error_contact);
        }else{
          $('#error_contact').text('');
        }


      }
    }


  });
  }else{
     swal("Canceled!", {
       icon: "success",
        });
  }


});

});

//end of Updating Codes



//this jqeury codes is for displaying dropdown NSTP PROGRAM and COURSE in the edit students
 $(document).on('change','#category',function(){
      var nstp_id = $('#category').val();

      $.ajax({
        url: 'action.php',
        method: 'post',
        data: {nstp_id: nstp_id},


      cache:false,
      success:function(result){
        $('#sub-category').html(result);
      }


      }

      );
    });



});
  



</script>