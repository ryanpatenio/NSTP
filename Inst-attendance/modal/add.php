<div class="modal" id="addModalForm">
  <div class="modal-dialog">

    <form method="post" id="attendance_form">
      
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="modal_title">ADD ATTENDANCE</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          
          <div class="form-group">
            <div class="row">
              <!-- <label class="col-md-4 text-right">Grade <span class="text-danger">*</span></labe --><!-- l> -->
              <div class="col">
                <h4 style="margin: 0px;position: relative;margin-left: 125px;margin-bottom: 20px;"></h4>
              </div>
            </div>
          </div>
          <div class="form-group">

            <div class="row">
              <label class="col-md-4 text-right">Class Schedule<span class="text-danger">*</span></label>

              <div class="col-md-8">

                <?php
                   $data_acad = getSY();
                   if($data_acad != '0'){
                       $acad = $data_acad->ACAD_ID;
                   }else{
                    $acad = '';
                   }
                  

                  $mydb->setQuery("select * from class_sched where CLASS_ID = '".$id."' and STATUS = 'UNDONE' and ACAD_ID = '".$acad."';");
                  $res = $mydb->executeQuery();


                 ?>

                <select class="custom-select" name="attendance_date" id="attendance_date">
                  <?php


                    while($row = mysqli_fetch_array($res)){?>
                     
                      <option value="<?php echo $row["CLASS_SCHED_ID"]; ?>"><?php echo $row['TOPIC'].'   ('.date("d M Y",strtotime($row['SESS_DATE'])).')'; ?></option>

                  <?php }


                  ?>
                     
                </select>

                <!-- <input type="text" name="attendance_date" id="attendance_date" class="form-control" readonly /> -->

                <span id="error_attendance_date" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group" id="student_details">
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>NO.</th>
                    <th>Student Name</th>
                    <th style="background-color: green;color:white;">Present</th>
                    <th style="background-color: red;color: white;">Absent</th>
                  </tr>
                  
                  <?php

                  $stud_data = getStudent($id);
                  $i = 1;
                  foreach ($stud_data as $row2) {
                    # code...
                    ?>

                    <tr>
                          <td><?php echo $i; ?></td>
                          <td>
                            <?php echo $row2['name']; ?>
                            <input type="hidden" name="student_id[]" value="<?php echo $row2["IDNO"]; ?>" />
                          </td>



                          <td>
                            <input type="radio" name="attendance_status<?php echo $row2["IDNO"]; ?>" value="Present" />
                          </td>
                          <td>
                            <input type="radio" name="attendance_status<?php echo $row2["IDNO"]; ?>" checked value="Absent" />
                          </td>
                        </tr>

                    <?php
                $i++;  }

                   ?>
                        
                 
              </table>
            </div>
          </div>
        
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="hidden" name="action" id="action" value="Add" />
          <input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm add" value="ADD" />
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        </div>

      </div>
    </form>
  </div>
</div>

<?php

function getStudent($id){
  global $mydb;
  $mydb->setQuery("select en.IDNO,concat(s.FNAME,' ',s.LNAME) as 'name' from enrollees en,students s,class cl,acad_year ac where en.IDNO = s.IDNO and en.CLASS_ID = cl.CLASS_ID and en.ACAD_ID = ac.ACAD_ID and ac.`STATUS` = 'YES' and en.CLASS_ID='".$id."' and en.R_STATUS not in('DROP','INC');");
  $cur = $mydb->executeQuery();

  if($cur){
    return $cur;
  }else{
    return 0;
  }
}

function getSY(){
  global $mydb;
  $mydb->setQuery("select * from acad_year where STATUS ='YES';");
  $cur = $mydb->executeQuery();
  $numrows = $mydb->num_rows($cur);

  if($numrows > 0){
    $found = $mydb->loadSingleResult();
    return $found;
  }else{
    return 0;
  }
}

 ?>
