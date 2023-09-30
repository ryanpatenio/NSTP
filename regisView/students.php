<?php 

include('include/header.php');
include('include/sidebar.php');

?>
<div id="content-wrapper">

      <div class="container-fluid">
        <ol class="breadcrumb">
         <h4 class="center">LIST OF STUDENTS</h4>
        </ol>

<div class="row">
  <div class="col">

    <label><strong>FILTER</strong></label>
    <select class="form-control" id="year">
  
    <?php

    $sy_res = getSY();
    foreach ($sy_res as $sy) {
      # code...
      ?>

      <option value="<?php echo $sy['SCHOOL_YEAR']; ?>"><?php echo $sy['SCHOOL_YEAR']; ?></option>



      <?php

    }


     ?>   
    
    </select>

  </div>
  <div class="col">
    <label><strong>SEMESTER</strong></label>
    <select class="form-control" id="semester">
      <option value="FIRST">FIRST</option>
      <option value="SECOND">SECOND</option>
    </select>
  </div>
  <div class="col"></div>
  <div class="col"></div>



</div>

<hr>
<!--------Table-------->
<div class="card mb-3" id="table-container">
          <div class="card-header">
            <i class="fas fa-table"></i>
            
                  
            
            <button class="btn btn-sm btn-primary" id="btn_print"><i class="fa fa-print"> Print</i></button>
            <button class="btn btn-sm btn-success" id="x_btn"><i class="fa fa-file-export"> Export</i></button>
            </div>
          <div class="card-body">

            <div class="table-responsive"><input type="text" class="form-control col-sm-3" id="search" name="" style="float: right;margin:auto;position: relative;margin-bottom: 5px;border:solid grey;" placeholder="Search">
                
              <table class="table table-bordered " id="dt_table" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID NO.</th>
                    <th>NAME</th>
                    <th>SCHOOL YEAR</th>
                    <th>SEMESTER</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
               
                <tbody id="fetch_data">
                 

                </tbody>
              </table>
            </div>
          </div>
          
        </div>


<?php

include('include/footer.php');
include('include/script.php');
include('modal/select.php');

function getSY(){
  global $mydb;
  $mydb->setQuery("select distinct(SCHOOL_YEAR) from acad_year;");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}


 ?>

<script type="text/javascript" src="action/script.js"></script>

<script type="text/javascript">
  
  $(document).ready(function(){

    $(document).on('click','#btn_print',function(e){
      e.preventDefault();

      let sy = $('#year').val();
      let sem = $('#semester').val();

      if(sy !='' && sem !=''){

        window.location.href="printme.php?SY="+sy+"&SEM="+sem;

      }else{
        //error no sy and sem found
        alert('No School Year detected');
      }


    });


  });

 </script>