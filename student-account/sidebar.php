<?php
// if(isset($_SESSION['student_id'])){
//   $IDNO = $_SESSION['student_id'];

//   $data = new MyFiles();
//   $datNotif = new notificationz();

//   $res2 = $data->displayNotifCount($IDNO,$acad,$sem1);
//   $results = $datNotif->StudentAnnouncement($IDNO,$acad,$sem1);
// }


 ?>


<ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>student/stud_dashboard.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span>
        </a>
      </li>
      
     <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>studentModule/"><i class="fas fa-fw fa-download"></i> Modules
          
          <span class="badge-danger" style="border-radius: 50px;padding: 3px;"><?php //echo $res2->counter; ?></span></a>

      </li>
       <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>student_notif/"><i class="fas fa-fw fa-bell"></i> Announcement
          
          <span class="badge-danger" style="border-radius: 50px;padding: 3px;"><?php //echo $results->countNotif; ?></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>student-attendance/">
          <i class="fas fa-fw fa-calendar"></i>
          <span>My Attendance</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>student-grades/">
          <i class="fas fa-fw fa-list"></i>
          <span>Grades</span></a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>student-notifications/"><i class="fas fa-fw fa-bell"></i>Notification
          
          <span class="badge-danger" style="border-radius: 50px;padding: 3px;">10</span></a>

      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>student-account/">
          <i class="fas fa-fw fa-user"></i>
          <span>Account</span></a>
      </li>
    </ul>