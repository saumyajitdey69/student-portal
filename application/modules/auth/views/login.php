<form class="form form-signin" role="form" method="post" accept-charset="utf-8">
  <h1 class="text-primary">Student Portal</h1>
  <br>
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
    <!-- <p class="text-info fade in">Please login with your username/email and password</p> -->
  <?php endif; ?>
  <!-- <span class="text-danger">Do not use email id to login</span> -->
  <div class="form-group has-feedback">
    <span class="help-block">WSDC account</span>
    <input required="required" type="text" id="identity" name="identity" class="form-control" placeholder="username" autofocus>
    <span class="form-control-feedback" aria-hidden="true">@student.nitw.ac.in</span>
  </div>
  <div class="form-group">
    <input required="required" type="password" id="password" name="password" class="form-control" placeholder="password">
  </div>
  <div class="form-group clearfix">
    <button type="submit" name="submit" class="btn btn-primary ">Sign In</button>        
  </div>
  <div class="form-group">
    <small> 
      <a  class="text-info" href="<?php echo base_url('auth/forgot_password') ?>">Forgot password or username?</a>
      <br>
      <a  class="text-info" href="<?php echo base_url('auth/activation_mail') ?>">Resent Activation Link</a>
    </small> 
    <div class="clearfix">
      <br>
    </div>
    Don't have a WSDC account? <a href="<?php echo base_url('auth/create_general_user') ?>"> Sign up now</a>
  </div>
</form>
