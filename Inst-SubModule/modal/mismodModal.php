<!-- Modal ADD SCHEDULE -->
<div class="modal" id="missModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">MISSING MODULE(s)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
   <table id="ready" class="table table-striped tabled-bordered" width="100%;">
          <thead>

           
            <tr>
                <th>No.</th>
                <th>TITLE</th>
                <th>DUE</th>
                <th>STATUS</th>
                
            </tr>
          </thead> 
           <tbody>
            <?php

            $dataMiss = missingModule($get_IDNO);
            $i = 1;
            foreach ($dataMiss as $msData) { 

                if($msData['DUE'] !='0000-00-00'){
                  $dueStats = date("d M Y",strtotime($msData['DUE']));
                }else{
                  $dueStats = 'No Due Date';
                }

              ?>

              <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $msData['FILE_TITLE']; ?></td>
                    <td><?php echo $dueStats; ?></td>
                   
                    <td style="color: red;">Missing</td>

                </tr>


          <?php $i++;  }

             ?>
                
             
            </tbody>



        </table>


      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    
    </div>
  </div>
</div>

<?php

function missingModule($IDNO){
  global $mydb;

  $mydb->setQuery("select mo.FILE_TITLE,mo.DUE from assign_module ass,module mo,acad_year ac where ass.MOD_ID = mo.MOD_ID and ac.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and mo.FILE_TYPE not in(0) and ass.IDNO = '".$IDNO."' and ass.`STATUS` = 0;");
  $Q = $mydb->executeQuery();


    if($Q){
      return $Q;
    }else{
      return 0;
    }

}



 ?>


