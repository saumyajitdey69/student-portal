<form class="form form-signin" role="form" method="post" accept-charset="utf-8">
<legend> Login</legend>

  <!-- <div class="alert alert-danger">The website is under maintenance. Inconvenience is deeply regretted. <br> -Abhishek Singh, WSDC Gen. Sec</div> -->
  <?php if(!empty($message)): ?>
    <div class="text-danger fade in"><?php echo $message;?></div>
  <?php else: ?>
    <p class="text-info fade in">Please login with your registered Email/User Id and password</p>
  <?php endif; ?>
  <div class="form-group">
    <input required="required" type="text" id="identity" name="identity" class="form-control" placeholder="Email" autofocus>
  </div>
  <div class="form-group">
    <input required="required" type="password" id="password" name="password" class="form-control" placeholder="Password">
  </div>
  <div class="form-group">
    <button type="submit" name="submit" class="btn btn-md btn-primary ">Login</button>
  </div>

  <div class="form-group">
    <a  class="text-danger" href="<?php echo base_url('auth/forgot_password') ?>"  >Forgot password of your account?</a>
  </div>
  <div class="form-group">
    <a  class="text-danger" href="<?php echo base_url('auth/activation_mail') ?>"  >Get Activation Link</a>
  </div>
</form>
<div class="row" style="padding:15px;">
	<legend>Create account</legend>
	<a href="<?php echo base_url('auth/create_general_user') ?>" role="" class="btn btn-warning">Register</a>
</div>