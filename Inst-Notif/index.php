<?php

include('../instructor-asset/header.php');
include('../instructor-asset/sidebar.php');



 ?>
 <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">NOTIFICATION</h4>
        </ol>

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i> 
           <!--  <button class="btn btn-sm btn-primary sm" id="btnMark" name="btnMark">Mark as Read?</button> -->
            <a href="printme.php?inst_id=<?php echo $_SESSION['inst_id']; ?>" class="btn btn-sm btn-success pr"><i class="fa fa-print"> Print</i></a>
            </div>

          <div class="card-body">

          

            <div class="table-responsive">
                
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>

                  <tr>
                    <!-- <th><input type="checkbox" class="btn btn-sm btn-danger" name="" id="checkAll"> Check All?</th> -->
                   <th>NO.</th>
                    <th>STUDENTS NAME</th>
                    <th>MESSAGE</th>
                    <th>DATE</th>
                                     
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $data = getT_notif($_SESSION['inst_id']);
                  if($data !='0'){
                    $i = 1;
                    foreach ($data as $row) {
                      # code...
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['MESSAGE']; ?></td>
                        <td><?php  echo date("d M Y",strtotime($row['UPLOADED_DATE'])); ?></td>
                      </tr>

                      <?php



                  $i++;  }


                  }

                   ?>


                </tbody>
              </table>
            </div>
          </div>
        </div>

 <?php

include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');

#set function
function getT_notif($inst_id){
  global $mydb;
  $mydb->setQuery("select tf.T_NOTIF_ID,concat(s.FNAME,'',s.LNAME) name,tf.MESSAGE,tf.READM,tf.UPLOADED_DATE from teacher_notif tf,students s,acad_year ac,class cl where tf.IDNO = s.IDNO and tf.ACAD_ID = ac.ACAD_ID and tf.CLASS_ID = cl.CLASS_ID and ac.`STATUS` = 'YES' and cl.INST_ID = '".$inst_id."' order by tf.T_NOTIF_ID desc;");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}

  ?>