<?php
include('../instructor-asset/header.php');
include('../instructor-asset/sidebar.php');

if(!isset($_GET['IDNO'])){

  redirect(WEB_ROOT.'login.php');
}

  $get_IDNO = $_GET['IDNO'];

  $data = getData($get_IDNO);

  if($data !='0'){
    $res = $data;
  }

?>
<div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">UPDATE INC STUDENTS</h4>
        </ol>

<div class="row">

<div class="col-lg-6">
 <div class="card mb-3">
  <div class="card-header">

 <div class="card-header">

<form method="POST" id="edit_incForm">

  <!---------------Important ID----------------->

  <input type="hidden" id="acad_id" name="acad_id" value="<?php echo $res->ACAD_ID; ?>">
  <input type="hidden" id="enroll_id" name="enroll_id" value="<?php echo $res->ENROLL_ID; ?>">
  <input type="hidden" id="grd_id"  name="grd_id" value="<?php echo $res->GRD_ID; ?>">




       <i class="fa fa-bar-chart"></i>Student Details</div>
        <div class="card-body">
          <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">Student Name: </label>

                  <input class="form-control input-sm" id="studName" readonly name="studName" placeholder=
                      "Student Name" type="text" value="<?php echo $res->name; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">Class: </label>

                  <input class="form-control input-sm" id="class" readonly name="class" placeholder=
                      "Class" type="text" value="<?php echo $res->CLASS_NAME; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">School Year: </label>

                  <input class="form-control input-sm" id="sy" readonly name="sy" placeholder=
                      "School Year" type="text" value="<?php echo $res->SCHOOL_YEAR; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">Semester: </label>

                  <input class="form-control input-sm" id="sem" readonly name="sem" placeholder=
                      "Semester" type="text" value="<?php echo $res->SEMESTER ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">MID-TERM: </label>

                  <input type="number" min="75" max="100" class="form-control input-sm" id="mid" required="" name="mid" placeholder=
                      "Mid Term" type="text" value="<?php echo $res->MID_TERM; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">END-TERM: </label>

                  <input type="number" min="75" max="100" class="form-control input-sm" id="end" required="" name="end" placeholder=
                      "End Term" type="text" value="<?php echo $res->end_t; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">FINAL: </label>

                  <input class="form-control input-sm" min="75" max="100" id="fin" readonly name="fin" placeholder=
                      "Final" type="text" value="<?php echo $res->FINAL ?>">
                </div>
              </div>
            </div>
            <input type="hidden" name="action" value="edit">
            <!-- <button class="btn btn-warning" style="margin-left: 180px;"><i class="fa fa-save"> Save</i></button> -->
            <input type="submit" class="btn btn-warning" name="btn_save" value=" Save" id="btn_save" style="margin-left: 180px;">
    </div>
    </form>
  </div>
 </div>
</div>

<!-----------Missing Module Table--------------->

<div class="col-lg-6">
  <div class="card mb-3">
   <div class="card-header">
   <div class="card-header bg-danger">
       <i class="fa fa-bar-chart " style="color: white;">Missing Module</i></div>
        <div class="card-body">
          <div class="card mb-3" id="table-container">
          <div class="card-header">
            <i class="fas fa-table"></i></i>
            
            </div>
          <div class="card-body">

         
            <div class="table-responsive">
                
              <table class="table " id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    
                    <th>No.</th>
                    <th>TITLE</th>
                    <th>DUE</th>
                    <th>STATUS</th>
                                   
                  </tr>
                </thead>
               
                <tbody>

                  <?php

                  $data_miss = missingModule($get_IDNO);
                  $i = 1;
                  foreach ($data_miss as $row) {
                    # code...

                    if($row['DUE'] !='0000-00-00'){
                      $dueStats = date("d M Y",strtotime($msData['DUE']));
                    }else{
                      $dueStats = 'No Due Date';
                    }

                    ?>

                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['FILE_TITLE']; ?></td>
                    <td><?php echo $dueStats; ?></td>
                   
                    <td style="color: red;">Missing</td>
                  </tr>


                    <?php

                  }


                   ?>

                  
                  

                 
                </tbody>
              </table>
            </div>
          </div>
          
        </div>

       </div>
     </div>
   </div>
</div>

</div>

<?php

include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');

#set function
function getData($IDNO){
  global $mydb;
  $mydb->setQuery("select en.ENROLL_ID,grd.GRD_ID,en.ACAD_ID,concat(s.FNAME,' ',s.LNAME) name,cl.CLASS_NAME,ac.SCHOOL_YEAR,ac.SEMESTER,grd.MID_TERM,grd.END_TERM as 'end_t',grd.FINAL from enrollees en,grades grd,acad_year ac,class cl,students s where en.ENROLL_ID = grd.ENROLL_ID and en.ACAD_ID = ac.ACAD_ID and en.CLASS_ID = cl.CLASS_ID and en.IDNO = s.IDNO and en.IDNO = '".$IDNO."';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found;
  }else{
    return 0;
  }
}


function missingModule($IDNO){
  global $mydb;

  $mydb->setQuery("select mo.FILE_TITLE,mo.DUE from assign_module ass,module mo,acad_year ac where ass.MOD_ID = mo.MOD_ID and ac.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and mo.FILE_TYPE not in(0) and ass.IDNO = '".$IDNO."' and ass.`STATUS` = 0;");
  $Q = $mydb->executeQuery();


    if($Q){
      return $Q;
    }else{
      return 0;
    }

}

 ?>

 <script type="text/javascript" src="action/script.js"></script>