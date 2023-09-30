<?php

include('../themeAsset/header.php');
include('../themeAsset/adminSidebar.php');


?>
 <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">ADD NEW USER</h4>
        </ol>

        <div class="row">
            
           <div class="col-md-3">

         
            </div>

            <div class="col-md-9">


              <form method="post" id="" action="controller.php?action=add">
                 
                <div class="row">

  

                    <div class="col">

                          <label for="ID NO"><strong>First Name</strong></label>
                          <input type="text" style="width: 360px;position: relative;" value="" name="fname" class="form-control" required=""  placeholder="Firstname">
                          <span class="text-danger" id="error_fname"></span>

                    </div> 

                  </div> 

                  <div class="row">
                    <div class="col">
                      <label style="margin-top: 15px;"><strong>Last Name</strong></label>
                      <input type="text" class="form-control" name="lname" style="width: 360px;position: relative;" required=""placeholder="Lastname" value="">
                      <span class="text-danger" id="error_lname"></span>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <label style="margin-top: 15px;"><strong>Username</strong></label>
                      <input type="email" class="form-control" name="username" style="width: 360px;position: relative;" required="" placeholder="email" value="">
                      <span class="text-danger" id="error_email"></span>
                    </div>
                  </div>

                  
                  <div class="row">
                    <div class="col">
                      <label style="margin-top: 15px;"><strong>Password</strong></label>
                      <input type="password" class="form-control" name="pass" id="pass1" style="width: 360px;position: relative;" required="" placeholder="Password">
                      <span class="text-danger" id="error_new"></span>

                    </div>
                  </div>


                  <div class="row" style="margin-top: 10px;position: relative;">
                    <div class="col">
                    <label><strong>TYPE</strong></label>

                    <select class="form-control" name="type" style="width: 360px;">
                          
                      <option value="ADMIN">ADMIN</option>
                       <option value="REGISTRAR">REGISTRAR</option>
                    </select>
                  </div>
                  <div class="col"></div>

                </div>

                 
                  <div class="row">
                    <div class="col">
                      
                      <button class="btn btn-primary" style="position: relative;margin: 0px;margin-bottom:15px;margin-top: 20px;width: 360px; " name="addBtn"><i class=" fa fa-save"> SAVE</i></button>
                    </div>
                  </div>
                   

      
            </div>


              </form>
            </div>

<?php

include('../themeAsset/footer.php');
include('../themeAsset/script.php');


 ?>