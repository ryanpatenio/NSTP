<ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span>
        </a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>admin-stud/">
          <i class="fas fa-fw fa-users"></i>
          <span>STUDENTS</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>NSTP PROGRAM</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">DEPARTMENT</h6>
          <a class="dropdown-item" href="<?php echo WEB_ROOT; ?>cwts-adminSide">CWTS</a>
          
          <a class="dropdown-item" href="<?php echo WEB_ROOT; ?>lts-adminSide">LTS</a>

          <a class="dropdown-item" href="<?php echo WEB_ROOT; ?>rotc-adminSide">ROTC</a>
          
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>inc-students/">
          <i class="fas fa-fw fa-user"></i>
          <span>Incomplete Students</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>instructor/">
          <i class="fas fa-fw fa-user"></i>
          <span>Instructor</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>adminDropStudent/">
          <i class="fas fa-fw fa-users"></i>
          <span>Drop Students</span></a>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>admin-courses/">
          <i class="fas fa-fw fa-cog"></i>
          <span>Course/Section</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo WEB_ROOT; ?>admin-userLog/">
          <i class="fas fa-fw fa-history"></i>
          <span>User Log</span></a>
      </li>

    <!--   <li class="nav-item">
        <a class="nav-link" href="<?php //echo WEB_ROOT; ?>admin-activitylog/">
          <i class="fas fa-fw fa-history"></i>
          <span>Activity Log</span></a>
      </li> -->
 


       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-cog"></i>
          <span>Settings</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Settings</h6>
          <a class="dropdown-item" href="<?php echo WEB_ROOT; ?>accounts/">My Account</a>
          
          <a class="dropdown-item" href="<?php echo WEB_ROOT; ?>Settings/">Settings</a>
          
        </div>
      </li>



    </ul>
   