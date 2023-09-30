<?php

include('../themeAsset/header.php');
include('../themeAsset/adminSidebar.php');

if(!isset($_GET['IDNO'])){
  redirect(WEB_ROOT."login.php");
}

$get_IDNO = $_GET['IDNO'];

$data_inc = getData($get_IDNO);

if($data_inc !='0'){
  $data = $data_inc;
}else{
  $data = '';
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
       <i class="fa fa-bar-chart"></i>Student Details</div>
        <div class="card-body">
        	<div class="form-group">
             <div class="form-row">
                    <div class="col-md">


                      <form method="post" id="edit_inc_form">

                  <!------------ This section holds the important ID---------------->    
                  <input type="hidden" id="ENROLL_ID" name="ENROLL_ID" value="<?php echo $data->ENROLL_ID; ?>">
                  <input type="hidden" name="class_id" id="class_id" value="<?php echo $data->CLASS_ID; ?>">
                  <input type="hidden" name="IDNO" value="<?php echo $data->IDNO; ?>">

                <label  for="">Student Name: </label>

                  <input class="form-control input-sm" id="studName" readonly name="studName" placeholder=
                      "Student Name" type="text" value="<?php echo $data->name; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">Class: </label>

                  <input class="form-control input-sm" id="class" readonly name="class" placeholder=
                      "Class" type="text" value="<?php echo $data->CLASS_NAME; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">School Year: </label>

                  <input class="form-control input-sm" id="sy" readonly name="sy" placeholder=
                      "School Year" type="text" value="<?php echo $data->SCHOOL_YEAR; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">Semester: </label>

                  <input class="form-control input-sm" id="sem" readonly name="sem" placeholder=
                      "Semester" type="text" value="<?php echo $data->SEMESTER; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">MID-TERM: </label>

                  <input type="number" class="form-control" min="75" max="100" value="<?php echo $data->MID_TERM; ?>" id="mid" name="mid" placeholder="MIDTERM" required>
                </div>
              </div>
            </div>

            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">END-TERM: </label>

                  <input type="number" class="form-control" min="75" max="100" value="<?php echo $data->end_t; ?>" id="end" name="end" placeholder="END-TERM" required>
                </div>
              </div>
            </div>

            <div class="form-group">
             <div class="form-row">
                    <div class="col-md">
                <label  for="">FINAL: </label>

                  <input class="form-control input-sm" id="fin" readonly name="fin" placeholder=
                      "Final" type="text" value="">
                </div>
              </div>
            </div>
             

            <div class="progress" style="display: none;margin-bottom: 5px;">
               <div class="progress-bar progress-bar-success" role="progresbar" aria-value="" aria-valuemax="100" style="width: 0%;"></div> 

            </div>


         <input type="hidden" name="action" value="edit">
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
                
              <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    
                    <th>No.</th>
                    <th>Title</th>
                    
                    <th>Due</th>                   
                  </tr>
                </thead>
               
                <tbody>

                  <tr>
                   	<td>1</td>
                   	<td>Environmental</td>
                   	<td>Feb. 16 2022</td>
                  </tr>
                  

                 
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

include('../themeAsset/footer.php');
include('../themeAsset/script.php');

function getData($IDNO){
  global $mydb;
  $mydb->setQuery("select en.ENROLL_ID,en.IDNO,grd.GRD_ID,en.ACAD_ID,cl.CLASS_ID,concat(s.FNAME,' ',s.LNAME) name,cl.CLASS_NAME,ac.SCHOOL_YEAR,ac.SEMESTER,grd.MID_TERM,grd.END_TERM as 'end_t',grd.FINAL from enrollees en,grades grd,acad_year ac,class cl,students s where en.ENROLL_ID = grd.ENROLL_ID and en.ACAD_ID = ac.ACAD_ID and en.CLASS_ID = cl.CLASS_ID and en.IDNO = s.IDNO and en.IDNO = '".$IDNO."';");
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