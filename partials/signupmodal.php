
<!-- Modal -->
<form action="/forum/partials/signuphandle.php" method="post">
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form>
  <div class="row mb-3">
    <label for="signupemail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="signupemail" name="email">
    </div>
  </div>
  <div class="row mb-3">
    <label for="username" class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="username" name="username">
    </div>
  </div>
  <div class="row mb-3">
    <label for="signuppassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="signuppassword"  name="password">
    </div>
  </div>
  <div class="row mb-3">
    <label for="cpassword" class="col-sm-2 col-form-label">Confirm Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="cpassword" name="cpassword">
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary">Sign in</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</form>