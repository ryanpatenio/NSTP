<?php

global $mydb;


?>

<div class="row">
<?php
if(isset($_SESSION['inst_id'])){

$mydb->setQuery("select sec.SECT_ID,  inst.FNAME,inst.LNAME,inst.`STATUS`,nst.NSTP_PROGRAM,sec.SEC_NAME,sec.YR_SECTION from instructor inst,sections sec,nstp_prog nst where inst.INST_ID = sec.INST_ID and sec.NSTP_ID = nst.NSTP_ID and inst.INST_ID = '".$_SESSION['inst_id']."'");

$cur = $mydb->executeQuery();

while($row = mysqli_fetch_array($cur)){?>


          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-secondary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-users"></i>
                </div>
                <div class="mr-5"><?php echo $row['NSTP_PROGRAM'].' '.$row['SEC_NAME'].' '.$row['YR_SECTION']; ?></div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?php echo  WEB_ROOT."inst-inside/index.php?id=".$row['SECT_ID']; ?>">
                <span class="float-left" style="color: orange;">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
<?php }



}


 ?>

  </div>
