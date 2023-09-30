
<?php

global $mydb;

$mydb->setQuery("select count(s.STUD_ID) as 'count' from students s,sections sec ,nstp_prog nst where s.SECT_ID = sec.SECT_ID and sec.NSTP_ID = nst.NSTP_ID and nst.NSTP_ID not in(1,2); ");
$res = $mydb->executeQuery();

if($row = mysqli_fetch_assoc($res)){
  $result = $row;
}

$mydb->setQuery("select count(*) as 'count'  from instructor where TYPE not in('INSTRUCTOR'); ");

$cur = $mydb->executeQuery();

if($data = mysqli_fetch_assoc($cur)){
  $count1 = $data;
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
                <div style="font-size: 16px;font-family: verdana,sans-serif" class="mr-5">TOTAL STUDENTS</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?php echo WEB_ROOT; ?>admin-studRo/">
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
                <div class="mr-5" style="font-size: 16px;font-family: verdana,sans-serif">TOTAL INSTRUCTOR</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?php echo WEB_ROOT; ?>instructor-Ro/">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          
          
        </div>
