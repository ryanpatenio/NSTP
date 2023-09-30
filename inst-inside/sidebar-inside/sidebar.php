
<?php

if(isset($_GET['id'])){ $id = $_GET['id'];  ?>



<ul class="sidebar navbar-nav sdd">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>Inst-main/">
          <i class="fas fa-fw fa-arrow-left"></i>
          <span>Back</span>
        </a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="<?php echo  WEB_ROOT."Inst-inside/index.php?id=".$id; ?>">
          <i class="fas fa-fw fa-user"></i>
          <span>Students</span></a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="<?php echo  WEB_ROOT."Inst-enrollees/index.php?id=".$id; ?>">
          <i class="fas fa-fw fa-users"></i>
          <span>Enrollees</span></a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="<?php echo  WEB_ROOT."Inst-SubModule/index.php?id=".$id; ?>">
          <i class="fas fa-fw fa-book"></i>
          <span>Submitted Module</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo  WEB_ROOT."inst-manageStud/index.php?id=".$id; ?>">
          <i class="fas fa-fw fa-user"></i>
          <span>Manage Students</span></a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" href="<?php echo  WEB_ROOT."inst-attendance/index.php?id=".$id; ?>">
          <i class="fas fa-fw fa-user"></i>
          <span>Attendance</span></a>
      </li>
     
     <!--  <li class="nav-item">
        <a class="nav-link" href="<?php //echo WEB_ROOT; ?>Inst-module/">
          <i class="fas fa-fw fa-book"></i>
          <span>Assigned Module</span></a>
      </li> -->
     
    </ul>



<?php
}


 ?>


