<!-- Modal ADD STUDENT FORM -->



<div class="modal fade bd-example-modal-lg" id="editStudent" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">EDIT STUDENT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <input type="hidden" name="ID" id="ID" value="">
      <input type="hidden" name="hiddenNSTP_ID" id="hiddenNSTP_ID" value="">
      <input type="hidden" name="hiddenSECT_ID" id="hiddenSECT_ID" value="">


     

<div class="row">

      <div class="col">
          <label for="ID NO" style=""><strong>IDNO </strong></label>
          <input type="text" id="IDNO" name="IDNO" class="form-control" readonly="">
          <span id="error_IDNO" class="text-danger"></span>
      </div>  
           

      <div class="col">
                    
      </div>
</div>

<div class="row">
    <div class="col">

        <label for="firstname" style="margin-top: 20px;"><strong>Full Name</strong></label>
        <input type="text" name="fname" id="fname" class="form-control" placeholder="full name"  required="">
        <span id="error_fname" class="text-danger"></span>

          

    </div>

  

    <div class="col">
         
        <label for="birthday"  style="margin-top: 20px;"><STRONG>Birthday</STRONG></label>
        <input type="date" name="bday" id="bday" class="form-control" placeholder="birthday"  required="">
        <span id="error_bday" class="text-danger"></span>
    </div>

</div>


<div class="row">

  

    <div class="col">

            <label for="Gender"  style="margin-top: 20px;"><strong >Gender</strong></label>

            <select class="form-control" name="gender" id="gender" required="">
            

               <option value="Male">Male</option>
               <option value="Female">Female</option>
               
            </select>
            <span id="error_gender" class="text-danger"></span>
 
    </div>

     <div class="col">
      <label for="address"  style="margin-top: 20px;"><strong>Complete Address</strong></label>
      <input type="text" name="addresss" id="addresss" class="form-control" placeholder="address"  required="">
      <span id="error_address" class="text-danger"></span>
    </div>
    


    


  
</div>


<div class="row">

<div class="col">
        <label for="nstp Course"  style="margin-top: 20px;"><strong>NSTP COURSE</strong></label>

         <?php

      $display = new students();
      $res2 = $display->DisplayNstpProg();

       ?>
          <select class="form-control" id="category" name="NSTP_COURSE">
            <option id="nstp_id" value="<?php //echo $res->NSTP_ID  ?>"><?php //echo $res->NSTP_PROGRAM ?></option>
            <?php

            while($rs = mysqli_fetch_array($res2)){?>

                <option value="<?php echo $rs[0]; ?>"><?php echo $rs[1]; ?></option>


        <?php

            }

             ?>
              
              
          </select>
         <p>LTS-Literacy Training Service (Education Students); CWTS- Civic Welfare Training Service (Non-Education)</p>
    </div>

<div class="col">
      <label for="course year section"   style="margin-top: 20px;"><strong>Course/Year/Section</strong></label>

 
          <select name="CYS" id="sub-category" class="form-control" required="">
           
         <option id="cysID" value=""></option>
        
          
        </select>
        <span id="error_cys" class="text-danger"></span>

    </div>

    <div class="col">
      <label for="contact number"  style="margin-top: 20px;"> <STRONG>Contact Number</STRONG></label>
      <input type="text" name="contact" id="contact" class="form-control" maxlength="11" placeholder="contact number"  required="">
       <span id="error_contact" class="text-danger"></span>
    </div>

</div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="updateStudent" class="btn btn-primary">SAVE</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal EDIT STUDENT FORM -->