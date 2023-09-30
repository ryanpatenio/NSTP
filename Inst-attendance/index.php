<?php
include('../instructor-asset/header.php');
include('../inst-inside/sidebar-inside/sidebar.php');

 ?>
<div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">Attendance</h4>
        </ol>

<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i> 
            </div>
          <div class="card-body">

            <div class="table-responsive">
                  <button class="btn btn-sm btn-primary "id="add_button" style="float:right;margin-left: 5px;position: relative;"><i class="fa fa-plus" aria-hidden=true> ADD ATTENDANCE</i></button>


              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
                  <tr>
                   <th>ID NO.</th>
                    <th>NAME</th>                 
                    <th>CLASS</th>
                    <th>SEMESTER</th>
                    <th>SCHOOL YEAR</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
                  $data = getEnrollees($id);
                  foreach ($data as $row) {
                    # code...
                    ?>
                  <tr>
                    <td><?php echo $row['IDNO']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['CLASS_NAME']; ?></td>
                    <td><?php echo $row['SEMESTER']; ?></td>
                    <td><?php echo $row['SCHOOL_YEAR']; ?></td>
                    <td>
                      <a href="view.php?id=<?php echo $id; ?>&IDNO=<?php echo $row['IDNO']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-search"> View</i></a>
                    </td>
                  </tr>

                    <?php

                  }


                   ?>
                 
                </tbody>
              </table>
            </div>
          </div>
         
</div>
<?php
include('modal/add.php');
include('../instructor-asset/footer.php');
include('../instructor-asset/script.php');

 ?>

 <script type="text/javascript" src="action/script.js"></script>

 <?php

function getEnrollees($id){
  global $mydb;
  $mydb->setQuery("select en.IDNO,concat(s.FNAME,' ',s.LNAME) as 'name',cl.CLASS_NAME,ac.SEMESTER,ac.SCHOOL_YEAR from enrollees en,students s,class cl,acad_year ac where en.IDNO = s.IDNO and en.CLASS_ID = cl.CLASS_ID and en.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and en.CLASS_ID='".$id."' and en.R_STATUS not in('DROP','INC');");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}



  ?>