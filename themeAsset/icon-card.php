
<?php

global $mydb;

$mydb->setQuery("select count(*) as 'count' from students;");
$res = $mydb->executeQuery();

if($row = mysqli_fetch_assoc($res)){
  $result = $row;
}

$mydb->setQuery("select count(*) as 'count'  from instructor WHERE STATUS='active';");

$cur = $mydb->executeQuery();

if($data = mysqli_fetch_assoc($cur)){
  $count1 = $data;
}


$mydb->setQuery("select count(*) as 'INC' from enrollees en,students s,class cl,acad_year ac where en.IDNO = s.IDNO and en.CLASS_ID = cl.CLASS_ID and en.ACAD_ID = ac.ACAD_ID and en.R_STATUS = 'INC';");
$incRes = $mydb->executeQuery();

if($IncRes = mysqli_fetch_assoc($incRes)){
  $countInc = $IncRes;
}

$mydb->setQuery("select count(*) as 'DROP' from enrollees en,students s,class cl,acad_year ac where en.IDNO = s.IDNO and en.CLASS_ID = cl.CLASS_ID and en.ACAD_ID = ac.ACAD_ID and en.R_STATUS = 'DROP';");
$dropRes = $mydb->executeQuery();

if($DropRes = mysqli_fetch_assoc($dropRes)){
  $countDrop = $DropRes;
}

 ?>


<div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-users"></i>
                </div>
                 <p style="font-size: 20px;font-family: verdana,sans-serif"><?php echo $result['count']; ?> </p>
                <div style="font-size: 15px;font-family: verdana,sans-serif" class="mr-5">TOTAL STUDENTS</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?php echo WEB_ROOT; ?>admin-stud/">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-secondary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-users"></i>
                </div>
                 <p  style="font-size: 20px;font-family: verdana,sans-serif"><?php echo $count1['count']; ?> </p>
                <div class="mr-5" style="font-size: 15px;font-family: verdana,sans-serif">TOTAL INSTRUCTOR</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?php echo WEB_ROOT; ?>instructor/">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>

           <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-users"></i>
                </div>
                 <p  style="font-size: 20px;font-family: verdana,sans-serif"><?php echo $countInc['INC']; ?> </p>
                <div class="mr-5" style="font-size: 15px;font-family: verdana,sans-serif">TOTAL INCOMPLETE STUDENTS</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?php echo WEB_ROOT; ?>inc-students/">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-users"></i>
                </div>
                 <p  style="font-size: 20px;font-family: verdana,sans-serif"><?php echo $countDrop['DROP']; ?> </p>
                <div class="mr-5" style="font-size: 15px;font-family: verdana,sans-serif">TOTAL DROP STUDENTS</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?php echo WEB_ROOT; ?>adminDropStudent/">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>      
        </div>

