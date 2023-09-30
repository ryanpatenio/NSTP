<?php
include('../themeAsset/header.php');
include('../themeAsset/adminSidebar.php');


 ?>
<div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">LIST OF INC INSTRUCTORS</h4>
        </ol>

<!-----------Table------------>

<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            <button class="btn btn-sm btn-primary sm" style="margin-left: 8px;" id="newBtn"><i class="fa fa-plus" aria-hidden=true> New</i></button>

            <a href="printme.php" class="btn btn-sm btn-success" style="position: relative;margin: 0px;margin-top: 20px;margin-bottom: 20px;width: 100px;"><i class="fa fa-print"> Print</i></a>
          </div>
          <div class="card-body">

          


            <div class="table-responsive">
                
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
                  <tr>
                    <th>NO.</th>
                    <th>Instructor Name</th>
                    <th>Email</th>
                    
                  
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>


                  <?php 

                    $data = getInstructor();
                   

                      $i= 1;
                      while($row = mysqli_fetch_array($data)){  ?>

                      <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['FNAME'].' '.$row['LNAME']; ?></td>
                            <td><?php echo $row['USERNAME']; ?></td>
                           
                            

                            <td>
                            <button class="btn btn-sm btn-danger" id="editBtn" data-value="<?php echo $row['INST_ID']; ?>"><i class="fa fa-edit"> Edit</i>
                             
                            </button>
                             <button class="btn btn-sm btn-success btn_assign" id="<?php echo $row['INST_ID']; ?>" name="view_student" ><i class="fa fa-pen">Assign</i>
                            </button>
                             <button class="btn btn-sm btn-primary view" id="<?php echo $row['INST_ID']; ?>" name="view_student" ><i class="fa fa-search">View</i>
                            </button>

                              
                             </td>

                  </tr>


                   <?php   $i++; }

                   ?>


                  
                 
                </tbody>
              </table>
            </div>
          </div>
         
        </div>

 <?php
include('modal/view.php');
include('modal/add.php');
include('modal/edit.php');
include('modal/assignModal.php');
include('../themeAsset/footer.php');
include('../themeAsset/script.php');
 ?>
 <script type="text/javascript" src="action/script.js"></script>

 <?php
function getInstructor(){
  global $mydb;
  $mydb->setQuery("select * from instructor");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}


  ?>