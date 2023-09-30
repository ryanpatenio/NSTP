
<!-- Modal ADD AY -->
<div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">ADD NEW SECTION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
 <form method="POST" id="editStudentForm">
  <input type="hidden" id="editID" name="editID">

  <div class="row">
    <div class="col">
      <label>IDNO : </label>
      <input type="text" class="form-control" name="editIDNO" id="editIDNO" required="" readonly="">
    </div>
    <div class="col"></div>
  </div>

  <div class="row">
    <div class="col">
      <label>First Name : </label>
      <input type="text" class="form-control" name="editfname" id="editfname" required="" placeholder="First Name">
    </div>
    <div class="col">
      <label>Last Name : </label>
      <input type="text" class="form-control" name="editlname" id="editlname" required="" placeholder="Last Name">
    </div>
  </div>

  <div class="row">
    <div class="col">
      <label>Birth Day : </label>
      <input type="date" class="form-control" name="editbday" id="editbday" required="">
    </div>
    <div class="col">
      <label>Gender : </label>
      <select class="form-control" name="editgender">
        <option value="" id="idgender"></option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
    </div>
  </div>

<div class="row">
    <div class="col">
      <label>Address : </label>
      <input type="text" class="form-control" name="editaddress" id="editaddress" required="" placeholder="Address">
    </div>
    <div class="col">
      <label>Contact : </label>
      <input type="text" class="form-control" maxlength="11" id="editcontact" name="editcontact" required="" placeholder="Contact">
    </div>
  </div>


                                           
      <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">
             Close
            <span class="glyphicon glyphicon-remove-sign"></span>
           </button>
         <input type="hidden" name="action" value="edit">
         <input type="submit" name="addbFtn" id="editFbtn" value="Save" class="btn btn-success">
      </div>


      </div>
     </form>
    
    </div>
  </div>
</div>
