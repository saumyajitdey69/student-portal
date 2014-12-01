<form class="form form-signin" role="form" method="post" accept-charset="utf-8">
  <legend> Login </legend>
  <!-- <div class="alert alert-danger">The website is under maintenance. Inconvenience is deeply regretted. <br> -Abhishek Singh, WSDC Gen. Sec</div> -->
  <?php if(!empty($message)): ?>
    <div class="text-danger fade in"><?php echo $message;?></div>
  <?php else: ?>
    <?php 
    if($this->session->flashdata('success') == TRUE) 
      echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>'.$this->session->flashdata('success').'</div>';

    if($this->session->flashdata('warning') == TRUE) 
      echo '<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>'.$this->session->flashdata('warning').'</div>';

    if($this->session->flashdata('info') == TRUE)
      echo '<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>'.$this->session->flashdata('info').'</div>';

    if($this->session->flashdata('danger') == TRUE)
      echo '<div class="alert alert-danger"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>'.$this->session->flashdata('danger').'</div>';
    ?>
    <p class="text-info fade in">Please login with your username and password</p>
  <?php endif; ?>
  <span class="text-danger">Do not use email id to login</span>
  <div class="form-group">
    <input required="required" type="text" id="identity" name="identity" class="form-control" placeholder="username" autofocus>
  </div>
  <div class="form-group">
    <input required="required" type="password" id="password" name="password" class="form-control" placeholder="Password">
  </div>
  <div class="form-group clearfix">
    <div class="col-md-6">
    <button type="submit" name="submit" class="btn btn-md btn-primary ">Login</button>
      
    </div>
    <div class="col-md-6">
      <a href="<?php echo base_url('auth/create_general_user') ?>" role="button" class="btn btn-sm btn-warning">Create Account</a>
    </div>
  </div>
</form>
<div class="row" style="padding:15px;">
  <div class="form-group">
    <a  class="text-danger" href="<?php echo base_url('auth/forgot_password') ?>"  >Forgot password/username</a>
    <hr>
    <a  class="text-danger" href="<?php echo base_url('auth/activation_mail') ?>">Get Activation Link</a>
  </div>
<!--   <div class="form-group">

</div> -->
</div>
<!-- <div class="row" style="padding:15px;">
  <legend>Create account</legend>
  <a href="<?php echo base_url('auth/create_general_user') ?>" role="" class="btn btn-warning">Register</a>
</div> -->