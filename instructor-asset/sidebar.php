

<ul class="sidebar navbar-nav sd">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>Inst-main/">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="<?php //echo WEB_ROOT; ?>Inst-completeStud/">
          <i class="fas fa-fw fa-user"></i>
          <span>Complete Students</span></a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>Inst-Notif/">
          <i class="fas fa-fw fa-bell"></i> Notifications
          <!-- <span class="badge-danger" style="border-radius: 50px;padding: 3px;"> 1</span> --></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>Inst-Announcement/">
          <i class="fas fa-fw fa-bell"></i>
          <span>Announcement</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>Inst-addSched/">
          <i class="fas fa-fw fa-calendar"></i>
          <span>Schedule</span></a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-file"></i>
          <span>Report</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Create Report</h6>

          <a class="dropdown-item" style="color: red;" href="<?php echo WEB_ROOT; ?>Inst-inc/"> INCOMPLETE</a>


          <?php

          if(isset($_SESSION['inst_id'])){



$mydb->setQuery("select * from class where INST_ID = '".$_SESSION['inst_id']."'");

$cur2 = $mydb->executeQuery();




while($row2 = mysqli_fetch_array($cur2)){ ?>


           

          <a class="dropdown-item" href="../Inst-report/index.php?class_id=<?php echo $row2['CLASS_ID']; ?>"><?php echo $row2['CLASS_NAME']; ?></a>
          
         
          
       <?php   } } ?>


        </div>

      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>Inst-module/">
          <i class="fas fa-fw fa-book"></i>
          <span>Module</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>Inst-account/">
          <i class="fas fa-fw fa-cog"></i>
          <span>Settings</span></a>
      </li>
    </ul>