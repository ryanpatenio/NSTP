<?php session_start(); ?>

<?php require_once('../include/initialize.php'); ?>

<?php 

$data = new myTable();

if(isset($_GET['viewDetails'])){
  $id = $_GET['id'];


  $res = $data->viewSelectedStudent($_GET['id']);


}

?>

<!DOCTYPE html>
<html lang="en">

<head>

 <?php
require_once("link-header.php");
if(isset($_POST['back'])){
  redirect('../index.php');
}

  ?>



</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <img src="../images/logo.jfif" style="width: 40px; margin-right: 10px; border-radius: 10px;">
    <a class="navbar-brand mr-1" href="index.php" style="color: orange;">NSTP ADMIN</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        
      </div>
    </form>

    <!-- Navbar -->
    <?php require_once('accountDropdown.php'); ?>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php require_once('sidebar.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
       <ol class="breadcrumb">
         <h4 class="center">STUDENT INFORMATION</h4>
        </ol>


        <!-- Icon Cards-->
        
        <!-- Area Chart Example-->
        

        <!-- DataTables Example -->
    <form method="POST" action="">

<div class="row">

      <div class="col">
          <label for="ID NO" style="margin-top: 20px;"><strong>IDNO </strong></label>
          <input type="number" value="<?php echo $res->IDNO ?>" name="IDNOADMIN" class="form-control" placeholder="IDNO" required="" readonly="">
      </div>  
           

      <div class="col">
          <label for="firstname" style="margin-top: 20px;"><strong>Gender</strong></label>
          <input type="text" name="fname" value="<?php echo $res->GENDER ?>" class="form-control" readonly="">        
      </div>
       <div class="col">
                    
      </div>
</div>

<div class="row">
  <div class="col" style="margin-top: 20px;">
    <label for="label"><strong>First Name</strong></label>
    <input type="text" name="" class="form-control" readonly="" value="<?php echo $res->FNAME ?>">
  </div>
  <div class="col" style="margin-top: 20px;">
    <label for="label"><strong>Middle Name</strong></label>
    <input type="text" name="" class="form-control" readonly="" value="<?php echo $res->MID_NAME ?>">
  </div>
  <div class="col" style="margin-top: 20px;">
    <label for="label"><strong>Last Name</strong></label>
    <input type="text" name="" class="form-control" readonly="" value="<?php echo $res->LNAME ?>">
  </div>
</div>

<div class="row">

    <div class="col">
      <label for="firstname" style="margin-top: 20px;"><strong>MID TERM</strong></label>
      <input type="text" name="fname" value="<?php echo $res->MID_TERM1; ?>" class="form-control" readonly="" style="color: blue;">
    </div>
    <div class="col">
      <label for="lastname" style="margin-top: 20px;"><strong>FINAL</strong></label>
      <input type="text" name="lname" class="form-control" value="<?php echo $res->FINAL1; ?>" readonly=""style="color: blue;">
    </div>
     <div class="col">
      <label for="middlename" style="margin-top: 20px;"><strong>MID TERM 2nd Sem</strong></label>
      <input type="text" name="midname" class="form-control" value="<?php echo $res->MID_TERM2 ?>" readonly=""style="color: blue;">
    </div>
    <div class="col">
      <label for="middlename" style="margin-top: 20px;"><strong>FINAL 2nd Sem</strong></label>
      <input type="text" name="midname" class="form-control" value="<?php echo $res->FINAL2; ?>" readonly=""style="color: blue;">
    </div>
    <div class="col">
      <label for="middlename" style="margin-top: 20px;"><strong>AVG</strong></label>
      <input type="text" name="midname" class="form-control" value="<?php echo $res->AVG ?>" readonly=""style="color: blue;">
    </div>


</div>

<div class="row">

    <div class="col">
       <label for="address" style="margin-top: 20px;"><strong>Address</strong></label>
        <input type="text" name="address" class="form-control" value="<?php echo $res->ADDRESS ?>" readonly="">
    </div>

     <div class="col">
        <label for="contact" style="margin-top: 20px;"><strong>Contact Number</strong></label>
        <input type="text" name="contact" class="form-control" value="<?php echo $res->CONTACT ?>" readonly="">
    </div>

     <div class="col">
        <label for="nstp program" style="margin-top: 20px;"><strong>NSTP Program</strong></label>
        <input type="text" name="nstp_program" class="form-control" value="<?php echo $res->NSTP_PROGRAM ?>" readonly="">
    </div>

</div>










<label form="email"></label>
<div class="form-group">
  <button type="submit" name="back" class="btn btn-primary" style="margin-left: 45%;margin-top: 5%;">Back</button>
</div>


          </form>

      </div>
      <!-- /.container-fluid -->

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
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="../vendor/datatables/jquery.dataTables.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../js/demo/datatables-demo.js"></script>
  <script src="../js/demo/chart-area-demo.js"></script>

</body>

</html>
