
<?php 

$mydb->setQuery("select count(*) as 'count' from students");

$resulta = $mydb->executeQuery();
if($row = mysqli_fetch_assoc($resulta)){
  $res = $row;
}

?>


 <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-users"></i>
                </div>
                 <p  style="font-size: 20px;font-family: verdana,sans-serif"><?php echo $res['count']; ?></p>
                <div class="mr-5" style="font-size: 15px;font-family: verdana,sans-serif">TOTAL STUDENTS</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="students.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>