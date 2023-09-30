<?php

$notif2 = new notificationz();

$Count = $notif2->displayNotifSidebar($inst_id,$sem1,$acad);


 ?>




<ul class="sidebar navbar-nav sdd">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>Ro-Inst-main/">
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
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>Ro-Inst-Notif/">
          <i class="fas fa-fw fa-bell"></i> Notifications
          <span class="badge-danger" style="border-radius: 50px;padding: 3px;"><?php echo $Count; ?></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>Ro-Inst-inc/">
          <i class="fas fa-fw fa-user"></i>
          <span>Incomplete</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>Ro-Inst-addSched/">
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

          <?php

          if(isset($_SESSION['inst_id'])){



$mydb->setQuery("select sec.SECT_ID,  inst.FNAME,inst.LNAME,inst.`STATUS`,nst.NSTP_PROGRAM,sec.SEC_NAME,sec.YR_SECTION from instructor inst,sections sec,nstp_prog nst where inst.INST_ID = sec.INST_ID and sec.NSTP_ID = nst.NSTP_ID and inst.INST_ID = '".$_SESSION['inst_id']."'");

$cur2 = $mydb->executeQuery();




while($row2 = mysqli_fetch_array($cur2)){ ?>


           

          <a class="dropdown-item" href="../Ro-Inst-report/index.php?sect_id=<?php echo $row2['SECT_ID']; ?>"><?php echo $row2['NSTP_PROGRAM'].' '.$row2['SEC_NAME'].' '.$row2['YR_SECTION']; ?></a>
          
         
          
       <?php   } } ?>


        </div>

      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>Ro-Inst-module/">
          <i class="fas fa-fw fa-book"></i>
          <span>Module</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>Ro-Inst-account/">
          <i class="fas fa-fw fa-cog"></i>
          <span>Settings</span></a>
      </li>
    </ul>