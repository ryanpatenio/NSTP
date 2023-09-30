<?php
include('../student-asset/header.php');
include('../student-asset/sidebar.php');


?>
<style type="text/css">
/*  setting the second modal z-index above the first modal     */
  #uploadWork{
    z-index: 9999;
   
    border-radius: 10px;
    justify-content: center;
     position: fixed;
     top: 30%;


  }
 
  

</style>

 <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">CLASSWORK</h4>
        </ol>

      <!--------------Important Variable------------------->
      <input type="hidden" id="hidden_idno" name="" value="<?php echo $IDNO; ?>">

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i> <!-- <a class="btn btn-sm btn-primary sm" style="margin-left: 8px;" href="<?php //echo WEB_ROOT; ?>studentAddModule/"><i class="fa fa-plus" aria-hidden=true> Upload Work</i></a> -->

            
            </div>
          <div class="card-body">

            <div class="table-responsive">
                
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                   <th>NO.</th>
                    <th>TITLE</th>
                   
                    <th>DUE</th>
                    <th>CLASS</th>
                    <th>SEMESTER</th>
                    <th>SCHOOL YEAR</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                    
                  </tr>
                </thead>
               
                <tbody>
                  <?php

                  $data = getData($IDNO);
                  $i = 1;
                  if($data !='0'){

                    foreach ($data as $row) {
                      # code...
                      ?>

                  <tr>
                        <td><?php echo $i; ?> </td>
                        <td><?php echo $row['FILE_TITLE']; ?></td>
                        
                        <td><?php echo date("d M Y",strtotime($row['DUE'])); ?></td>
                        <td><?php echo $row['CLASS_NAME']; ?></td>
                        <td><?php echo $row['SEMESTER']; ?></td>
                        <td><?php echo $row['SCHOOL_YEAR']; ?></td>
                        <?php


                        if($row['FILE_TYPE'] == '1'){
                           #check module status
                            if($row['STATUS']=='0'){
                              //missing: not already submitted
                              $stats = 'Missing';
                              $color = 'red';
                            }else if($row['STATUS']=='1'){
                              //already submitted
                              $stats = 'Submitted';
                              $color = 'green';
                            }else{
                              $stats = '';
                              $color = '';
                            }

                        }else if($row['FILE_TYPE'] == '2'){
                            #check module status
                            if($row['STATUS']=='0'){
                              //missing: not already submitted
                              $stats = 'Missing';
                              $color = 'red';
                            }else if($row['STATUS']=='1'){
                              //already submitted
                              $stats = 'Submitted';
                              $color = 'green';
                            }else{
                              $stats = '';
                              $color = '';
                            }
                        }else if($row['FILE_TYPE'] == '0'){
                          //Handouts
                            $stats = 'Handouts';
                            $color = 'green';

                        }else{
                            //error not found
                            $stats = 'error 10092';
                            $color = 'red';
                        }


                       


                         ?>


                        <td style="color:<?php echo $color; ?>;"><?php echo $stats; ?>
                          
                      
          </div>

                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary viewMod" id="<?php echo $row['MOD_ID']; ?>" data-value="<?php echo $row['ASSIGN_ID']; ?>"><i class="fa fa-search"> View</i></button>
                        </td>
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

include('modal/view.php');
include('modal/upload.php');
include('../student-asset/footer.php');
include('../student-asset/script.php');


#set function
function getData($IDNO){
  global $mydb;
  $mydb->setQuery("select ass.ASSIGN_ID,mo.MOD_ID,mo.FILE_TITLE,mo.FILE_TYPE,mo.DUE,cl.CLASS_NAME,ac.SEMESTER,ac.SCHOOL_YEAR,ass.`STATUS` from assign_module ass,module mo,class cl,acad_year ac where ass.MOD_ID = mo.MOD_ID and ass.CLASS_ID = cl.CLASS_ID and ass.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and ass.IDNO = '".$IDNO."';");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}

 ?>

 <script type="text/javascript" src="action/script.js"></script>
