<?php
include('../instructor-asset/header.php');
include('../inst-inside/sidebar-inside/sidebar.php');

if(!isset($_GET['IDNO'])){
  redirect(WEB_ROOT.'login.php');
}else{
  $get_IDNO = $_GET['IDNO'];
  $class_id = $_GET['id'];
}

 ?>
 <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">Student Attendance</h4>
        </ol>

<?php
$data_stud = getStudName($get_IDNO);
if($data_stud !='0'){
  $name = $data_stud->FNAME.' '.$data_stud->LNAME;
 
}

?>
<div class="row">
    <div class="col">
        <label for="label"><strong>Student Name</strong></label>
        <input type="text" name="" value="<?php echo $name; ?>" class="form-control" readonly="">      
    </div>
<div class="col"></div>

</div>



<div class="float-none">
 
    <div class="row" style="margin-top: 30px;">
       <div class="col" style="width: 600px;">
        
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table">  Attendance Record</i> 

            <a href="printme.php?IDNO=<?php echo $get_IDNO; ?>&id=<?php echo $class_id; ?>" class="btn btn-sm btn-success"><i class="fa fa-print"> Print</i></a>
            </div>
          <div class="card-body">
            <div class="table-responsive">
                
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>NO.</th>
                    <th>TOPIC</th>
                    <th>DATE</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                   
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $data_acad = getSY();

                  if($data_acad !='0'){
                    $acad = $data_acad->ACAD_ID;

                    $att_details = getStud_attendance($get_IDNO,$acad);
                    $i = 1;
                    foreach ($att_details as $res) {
                      # code...
                      ?>

                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $res['TOPIC']; ?></td>
                        <td><?php echo date("d M Y",strtotime($res['SESS_DATE'])); ?></td>
                        <td><?php echo $res['STATUS']; ?></td>
                        <td>
                          <button class="btn btn-sm btn-danger" id="editStatBtn" data-value="<?php echo $res['ATT_ID']; ?>"><i class="fa fa-edit"> Edit</i></button>
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

       </div>
     </div>
</div>
<?php
include('modal/edit.php');
include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');

function getStudName($IDNO){
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

function getStud_attendance($IDNO,$acad){
  global $mydb;
  $mydb->setQuery("select att.ATT_ID,cl.TOPIC,cl.SESS_DATE,att.`STATUS` from class_sched cl,attendance att,students s where cl.CLASS_SCHED_ID = att.CLASS_SCHED_ID and att.IDNO = s.IDNO and att.ACAD_ID = '".$acad."' and att.IDNO ='".$IDNO."';");
  $cur = $mydb->executeQuery();
  
  if($cur){
    return $cur;
  }else{
    return 0;
  }
}

function getSY(){
  global $mydb;
  $mydb->setQuery("select * from acad_year where STATUS ='YES';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found;
  }else{
    return 0;
  }
}

 ?>
 <script type="text/javascript" src="action/script.js"></script>