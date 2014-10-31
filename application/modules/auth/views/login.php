<form class="form well" role="form" id="signin-form" accept-charset="utf-8" method="post">
  <legend>Student Portal Login</legend>
  <?php 
  if(isset($message))
  {
      echo '<div class="alert alert-danger"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>'.$message.'</div>';
  }
  ?>
  <div class="" id="status-signin"></div>
  <p class="text-info fade in">Please login with your username and password</p>
  <div class="form-group">
    <input required type="text" id="inputUserName-signin" name="username" class="form-control" placeholder="Username" autofocus>
</div>
<div class="form-group">
    <input required type="password" id="inputPassword-signin" name="password" class="form-control" placeholder="Password">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-md btn-primary btn-login" data-loading-text="Verifying">Login</button>
</div>
<div class="clearfix"></div>
<br>
<div class="form-group">
    <a href="#" onclick="$('#forgot-form').toggleClass('hidden');">Forgot my password/username </a>
</div>
<div class="form-group">
    <a href="#" onclick="$('#resend-form').toggleClass('hidden');">Resend my activation link</a>
</div>

<!-- <div class="form-group">
    <a href="<?php echo base_url('auth/register') ?>">Create an account</a>
</div> -->
</form>

<form class="form form-forgot hidden" id="forgot-form" method="post">
    <div class="forn-group">
        <input required type="email" id="inputEmail-forgot" name="email" class="form-control" placeholder="Enter registered email id" autofocus>
    </div>
    <div class="form-group">
        <button class="btn btn-md btn-block btn-warning " type="submit">Reset password</button>
    </div>
</form>

<form action="" class="form form-forgot hidden" id="resend-form" method="post">
    <br>
    <div class="form-group">
        <input required type="email" class="form-control" id="inputEmail-resend" placeholder="Enter registered email id" autofocus>
    </div>
    <div class="form-group">
        <button class="btn  btn-md btn-warning btn-block">Resend Activation Link</button>
    </div>
</form>
