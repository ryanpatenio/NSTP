<?php
include('../instructor-asset/header.php');
include('../instructor-asset/sidebar.php');

 ?>

  <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">MODULE</h4>
        </ol>
<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>


             <button class="btn btn-sm btn-primary sm" id="btn_addModule" style="margin-left: 8px;"><i class="fa fa-plus" aria-hidden=true> New</i></button>
             <a href="printme.php?inst_id=<?php echo $_SESSION['inst_id']; ?>" class="btn btn-sm btn-success pr" ><i class="fa fa-print"> Print</i></a>
            </div>
          <div class="card-body">

            <div class="table-responsive">
                
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                   <th>NO.</th>
                    <th>TITLE</th>
                    <th>DATE UPLOADED</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                  </tr>
                </thead>

                <tbody>

                  <?php
                  $data_mod = getModule($_SESSION['inst_id']);
                  $i = 1;
                  foreach ($data_mod as $row) {
                    # code...
                    ?>

                  <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row['FILE_TITLE']; ?></td>
                      <td><?php echo date("d M Y",strtotime($row['FILE_IN'])); ?></td>
                      <?php

                      if($row['STATUS']=='1'){
                        $m_status = 'Already Assigned';
                        $m_color = 'green';
                      }else if($row['STATUS']=='0'){
                        $m_status = 'Not already Assigned';
                        $m_color = 'red';
                      }


                       ?>

                      <td style="color:<?php echo $m_color; ?>;"><?php echo $m_status; ?></td>
                      <td>
                        
                       <!---------------this if statement detect if the module is already assign---------------->
                       <?php
                       if($row['STATUS'] == '1'){
                        //already assign

                        echo '
                        <button class="btn btn-sm btn-warning" id="editDoneBtn" data-value="'.$row['MOD_ID'].'"><i class="fa fa-edit"> Edit</i></button>
                        ';

                        echo '

                        <button class="btn btn-sm btn-success" id="already_assignBtn"><i class="fa fa-plus">Assign</i></button>

                        ';

                       }else{
                        //not already assign
                         echo '

                         <button class="btn btn-sm btn-warning" id="editModuleBtn" data-value="'.$row['MOD_ID'].'"><i class="fa fa-edit"> Edit</i></button>
                         ';

                          echo '
                        <button class="btn btn-sm btn-success" id="assignBtn" data-value="'.$row['MOD_ID'].'"><i class="fa fa-plus">Assign</i></button>

                        ';
                       }

                        ?>
                        
                         <!---------------this if statement detect if the module is already assign---------------->


                        <button class="btn btn-sm btn-primary" id="viewBtn" data-value="<?php echo $row['MOD_ID']; ?>"><i class="fa fa-search">View</i></button>
                      </td>
                  </tr>

                    <?php


                 $i++; }

                   ?>


              
                 
                </tbody>
              </table>
            </div>
          </div>
        </div>

        
<?php
include('modal/add.php');
include('modal/assign.php');
include('modal/edit.php');
include('modal/edit_done.php');
include('modal/view.php');
include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');

 ?>

 <script type="text/javascript" src="action/script.js"></script>
 <script type="text/javascript" src="action/assign-script.js"></script>

 <?php
function getModule($inst_id){
  global $mydb;
  $mydb->setQuery("select mo.MOD_ID,mo.FILE_TITLE,mo.FILE_IN,mo.`STATUS` from module mo,acad_year ac,instructor inst where mo.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and mo.INST_ID = inst.INST_ID and inst.INST_ID = '".$inst_id."';");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}

  ?>