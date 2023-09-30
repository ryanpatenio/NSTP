
<!-- Modal ADD AY -->
<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">ADD NEW STUDENT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
 <form method="POST" id="addStudentForm">

  <div class="row">
    <div class="col">
      <label>IDNO : </label>
      <input type="text" class="form-control" name="IDNO" id="IDNO" required="" placeholder="IDNO">
    </div>
    <div class="col"></div>
  </div>

  <div class="row">
    <div class="col">
      <label>First Name : </label>
      <input type="text" class="form-control" name="fname" required="" placeholder="First Name">
    </div>
    <div class="col">
      <label>Last Name : </label>
      <input type="text" class="form-control" name="lname" required="" placeholder="Last Name">
    </div>
  </div>

  <div class="row">
    <div class="col">
      <label>Birth Day : </label>
      <input type="date" class="form-control" name="bday" required="">
    </div>
    <div class="col">
      <label>Gender : </label>
      <select class="form-control" name="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
    </div>
  </div>

<div class="row">
    <div class="col">
      <label>Address : </label>
      <input type="text" class="form-control" name="address" required="" placeholder="Address">
    </div>
    <div class="col">
      <label>Contact : </label>
      <input type="text" class="form-control" maxlength="11" name="contact" required="" placeholder="Contact">
    </div>
  </div>


                                           
      <div class="modal-footer">
         <button type="button" class="btn btn-default btn btn-secondary" data-dismiss="modal">
             Close
            <span class="glyphicon glyphicon-remove-sign"></span>
           </button>
         <input type="hidden" name="action" value="add">
         <input type="submit" name="addbFtn" id="addFbtn" value="Save" class="btn btn-success">
      </div>


      </div>
     </form>
    
    </div>
  </div>
</div>
