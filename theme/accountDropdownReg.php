<ul class="navbar-nav ml-auto ml-md-0" style="background-color: black;border-radius: 5px;">
      
      <li class="nav-item dropdown no-arrow mx-1">
         <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="#" aria-haspopup="false" aria-expanded="false">
             <span class="mr-2 d-none d-lg-inline text-gray-600 small" style="color: white; font-size: 15px;"><?php echo $_SESSION['account_name']; ?></span>
          
         
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
         
        </div>
      </li>
      

      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw" style="color: white;"></i>

        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="<?php echo WEB_ROOT; ?>regisView/account.php">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
          Settings</a>
         
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout</a>
        </div>
      </li>
    </ul>


<!---- log out page modal---->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo WEB_ROOT; ?>/logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>