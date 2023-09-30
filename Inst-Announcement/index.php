<?php
include('../instructor-asset/header.php');
include('../instructor-asset/sidebar.php');



 ?>
 <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">ANNOUNCEMENT</h4>
        </ol>

<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i> <!-- <a class="btn btn-sm btn-primary sm" style="margin-left: 8px;" href="<?php //echo WEB_ROOT; ?>Inst-addSched/addSched.php"><i class="fa fa-plus" aria-hidden=true> New</i></a> -->


              <button class="btn btn-sm btn-primary sm" style="margin-left: 8px;" id="btn_addAnnouncement"><i class="fa fa-plus" aria-hidden=true> New</i></button>
              <a href="printme.php?inst_id=<?php echo $_SESSION['inst_id']; ?>" class="btn btn-sm btn-success pr"><i class="fa fa-print"> Print</i></a>

            </div>
          <div class="card-body">

          


            <div class="table-responsive">
                
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
                  <tr>
                    <th>NO.</th>
                    <th>ANNOUNCEMENT</th>
                    <th>DATE</th>                   
                    <th>ACTION</th>
                  </tr>
                </thead>
               
                <tbody>

                  <?php
                  $data = getAnnouncement($_SESSION['inst_id']);
                  $i=1;
                  foreach ($data as $row) {
                    # code...
                    ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row['CONTENT']; ?></td>
                      <td><?php echo date("d M Y",strtotime($row['ANN_DATE'])); ?></td>
                      <td>
                        
                        <button class="btn btn-sm btn-warning" id="btn_edit" data-value="<?php echo $row['ANN_ID']; ?>"><i class="fa fa-edit"> Edit</i></button>
                        <button class="btn btn-sm btn-primary" id="btn_view" data-value="<?php echo $row['ANN_ID']; ?>"><i class="fa fa-search"> View</i></button>


                      </td>
                    </tr>

                    <?php
                $i++;  }


                   ?>
               
                </tbody>
              </table>
            </div>
          </div>
        </div>

      



 <?php
include('modal/add.php');
include('modal/edit.php');
include('modal/view.php');
include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');


  ?>
<script type="text/javascript" src="action/script.js"></script>

<?php 

function getAnnouncement($inst_id){
  global $mydb;
  $mydb->setQuery("select ann.ANN_ID,ann.CONTENT,ann.ANN_DATE from announcement ann,acad_year ac,class cl where ann.ACAD_ID = ac.ACAD_ID and ann.CLASS_ID = cl.CLASS_ID and ac.STATUS ='YES' and cl.INST_ID = '".$inst_id."';");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}

 ?>