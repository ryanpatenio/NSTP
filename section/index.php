 <?php
include('../themeAsset/header.php');
include('../themeAsset/adminSidebar.php');

?>


 <div id="content-wrapper">

      <div class="container-fluid">

 <ol class="breadcrumb">
         <h4 class="center">SECTION</h4>
        </ol>
<!--------Table------>

<div class="card mb-3" id="table-container">
          <div class="card-header">
            <i class="fas fa-table"></i> 
</i> <button class="btn btn-sm btn-primary add" style="margin-left: 8px;"><i class="fa fa-plus" aria-hidden=true> New</i></button>
            
            </div>
          <div class="card-body">

         
            <div class="table-responsive">
                
              <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    
                    <th>SECTION CODE</th>
                    <th>YEAR/SECTION</th>
                   
                    <th>ACTION</th>
                  </tr>
                </thead>
               
                <tbody>
                	<?php
                	$data = getSection();
                	foreach ($data as $row) { ?>               	
				 <tr>
                 
                    <td><?php echo $row['SECT_CODE']; ?></td>
                    <td><?php echo $row['YR_SECTION']; ?></td>
                   
                    <td><button class="btn btn-sm btn-warning fa fa-edit" id="modif" data-value="<?php echo $row['SECT_ID']; ?>">Modify</button></td>
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



function getSection(){
	global $mydb;
	$mydb->setQuery("select * from sections");
	$cur = $mydb->executeQuery();

	if($cur){
		return $cur;
	}else{
		return 0;
	}
}

 ?>

 <script type="text/javascript" src="action/script.js"></script>