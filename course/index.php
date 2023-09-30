<?php

include('../themeAsset/header.php');
include('../themeAsset/adminSidebar.php');


 ?>

 <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">COURSE</h4>
        </ol>

<!--------Table------>

<div class="card mb-3" id="table-container">
          <div class="card-header">
            <i class="fas fa-table"></i> 
</i> <button class="btn btn-sm btn-primary sm" style="margin-left: 8px;" id="addBtn"><i class="fa fa-plus" aria-hidden=true> New</i></button>
            
            </div>
          <div class="card-body">

         
            <div class="table-responsive">
                
              <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    
                    <th>COURSE NAME</th>
                    <th>DESCRIPTION</th>
                   
                    <th>ACTION</th>
                  </tr>
                </thead>
               
                <tbody>
                	<?php
                	$data = getCourse();
                	foreach ($data as $row) { ?>               	
				 <tr>
                 
                    <td><?php echo $row['COURSE_NAME']; ?></td>
                    <td><?php echo $row['COURSE_DESC']; ?></td>
                   
                    <td><button class="btn btn-sm btn-warning fa fa-edit" id="editBtn" data-value="<?php echo $row['COURSE_ID']; ?>">Modify</button></td>
                  </tr>


                	<?php }

                	 ?>
                                 
                 
                </tbody>
              </table>
            </div>
          </div>
          
        </div>


<?php
include('modal/add.php');
include('modal/edit.php');
include('../themeAsset/footer.php');
include('../themeAsset/script.php');

function getCourse(){
	global $mydb;
	$mydb->setQuery("select * from course");
	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

 ?>
 <script type="text/javascript" src="action/script.js"></script>