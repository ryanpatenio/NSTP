<?php
include('../instructor-asset/header.php');
include('../inst-inside/sidebar-inside/sidebar.php');

if(!isset($_GET['IDNO'])){
  redirect(WEB_ROOT.'login.php');
}
$get_IDNO = $_GET['IDNO'];

$data_name = getName($get_IDNO);
?>

 <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">List of Student Submitted module</h4>
        </ol>

<div class="row">
        <div class="col">
          <label><strong>STUDENT NAME : </strong></label>
          <input type="text" class="form-control" name="" value="<?php echo $data_name->FNAME.' '.$data_name->LNAME; ?>" readonly="">
          
        </div>
        <div class="col">


          <?php

          #data from count missing module
          $data_count = getCount($get_IDNO);
          if($data_count !='0'){
            $my_data = $data_count;
          }else{
            $my_data = 0;
          }

           ?>

         
          <label style="font-size: 20px;"><strong>MISSING MODULE COUNT(s): </strong></label>
          <p style="margin:0px;position:relative;margin-left:100px;color:red;font-size: 25px;font-family: verdana,sans-serif">
            
            <?php echo $my_data; ?>

          </p>

          <button class="btn btn-sm btn-danger" style="margin-left: 30px;position: relative;margin-top: 20px;width: 200px;margin-bottom: 20px;" id="msBtn"><i class="fa fa-search"> View</i></button>
        </div>
      </div>



      
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
                    <th>DATE SUBMITTED</th>
                    <th>SUBMITTED STATUS</th>
                    <th>Action</th>                   
                  </tr>
                </thead>              
                <tbody>
                  <?php

                  $data = getData($get_IDNO);
                  $i = 1;
                  foreach ($data as $row) {
                    # code...
                    ?>

                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row['FILE_TITLE']; ?></td>
                      <td><?php echo date("d M Y",strtotime($row['DUE'])); ?></td>
                      <td><?php echo date("d M Y",strtotime($row['pass_date'])); ?></td>
                      <?php

                    if($row['DUE'] !='0000-00-00'){
                      
                         if($row['DUE'] < $row['pass_date']){
                          $upStatus = 'Submitted Late';
                          $colorStatus = 'red';
                       }                    
                        else{
                          $upStatus = 'On Time';
                          $colorStatus = 'green';
                        }

                    }else{
                      $upStatus = 'No Due Date';
                      $colorStatus = 'green';
                    }

                       ?>

                      <td style="color:<?php echo $colorStatus; ?>;"><?php echo $upStatus; ?></td>
                      <td>
                        
                        <a href="../studentPassMod/<?php echo $row['FILE_LOC']; ?>" class="btn btn-sm btn-success"><i class="fa fa-download"> Download</i></a>

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

include('modal/mismodModal.php');
include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');

#set function

function getData($IDNO){
  global $mydb;
  $mydb->setQuery("select pass.PASS_ID,mo.FILE_TITLE,mo.DUE,pass.UPLOAD_DATE as 'pass_date',pass.FILE_LOC from pass_module pass,module mo,assign_module ass,acad_year ac where pass.ASSIGN_ID = ass.ASSIGN_ID and ass.MOD_ID = mo.MOD_ID and pass.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and mo.FILE_TYPE not in(0) and ass.`STATUS` = 1 and pass.IDNO  = '".$IDNO."';");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }

}

function getName($IDNO){
global $mydb;
$mydb->setQuery("select * from students where IDNO = '".$IDNO."';");
$cur = $mydb->executeQuery();
$numrows = $mydb->num_rows($cur);

if($numrows > 0){
  $found = $mydb->loadSingleResult();
  return $found;
}else{
  return 0;
}


}

function getCount($IDNO){
global $mydb;
$mydb->setQuery("select count(ass.ASSIGN_ID) as 'count' from assign_module ass,module mo,acad_year ac where ass.MOD_ID = mo.MOD_ID and ac.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and mo.FILE_TYPE not in(0) and ass.IDNO = '".$IDNO."' and ass.STATUS = 0;");
$cur = $mydb->executeQuery();
$numrows = $mydb->num_rows($cur);

if($numrows > 0){
  $found = $mydb->loadSingleResult();
  return $found->count;
}else{
  return 0;
}

}


?>

<script type="text/javascript" src="action/script.js"></script>