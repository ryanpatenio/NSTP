<?php

include('../student-asset/header.php');
include('../student-asset/sidebar.php');


?>
 <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">NOTIFICATIONS</h4>
        </ol>



<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i> 
           <!--  <button class="btn btn-sm btn-primary sm" id="btnMark" name="btnMark">Mark as Read?</button> -->
            </div>

          <div class="card-body">

            


            <div class="table-responsive">
                
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>

                  <tr>
                    <!-- <th><input type="checkbox" class="btn btn-sm btn-danger" name="" id="checkAll"> Check All?</th> -->
                   <th>NO.</th>
                   
                    <th>MESSAGE</th>
                     <th>DATE</th>
                                       
                  </tr>
                </thead>

                <tbody>
                  <?php

                  $data = getData($IDNO);
                  if($data !='0'){
                    //have data
                    $i =1;
                    foreach ($data as $row) {
                      # code...
                      ?>  
                      <tr>
                        
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['CONTENT']; ?></td>
                        <td><?php echo date("d M Y",strtotime($row['ANN_DATE'])); ?></td>


                      </tr>

                      <?php

                   $i++; }

                  }



                   ?>


                 
                </tbody>
              </table>
            </div>
          </div>
         
        </div>

      


<?php


include('../student-asset/footer.php');
include('../student-asset/script.php');

#set function

function getData($IDNO){
  global $mydb;
  $mydb->setQuery("select st.STD_NOTIF_ID,ann.CONTENT,ann.ANN_DATE from student_notif st,announcement ann,acad_year ac where st.ANN_ID = ann.ANN_ID and st.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and st.IDNO = '".$IDNO."';");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }

}


 ?>