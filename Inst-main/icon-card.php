<?php

global $mydb;


?>

<div class="row">
<?php
if(isset($_SESSION['inst_id'])){

$mydb->setQuery("select * from class where INST_ID = '".$_SESSION['inst_id']."'");

$cur = $mydb->executeQuery();

while($row = mysqli_fetch_array($cur)){?>


          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-secondary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-users"></i>
                </div>
                <div class="mr-5"><?php echo $row['CLASS_NAME']; ?></div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?php echo  WEB_ROOT."inst-inside/index.php?id=".$row['CLASS_ID']; ?>">
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


