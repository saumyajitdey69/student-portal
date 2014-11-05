<?php echo validation_errors();
if(isset($message))
{
  echo '<div class="alert alert-danger"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>'.$message.'</div>';
}
?>

<div class="row">
<form class="form-horizontal" name="form_changepassword" method="post" role="form" action="<?php echo base_url('auth/changepasswdvalidate'); ?> ">
      <legend>Change Password</legend>
      <div class="form-group">
        <label for="inputcurrentpassword" class="col-sm-2 control-label">Current Password</label>
        <div class="col-sm-10 col-md-7 col-lg-5 col-xs-12">
          <input type="password" pattern=".{6,}" name="currentpassword" id="inputcurrentpassword" class="input-sm form-control" value="" required="required"  title="minimum 6 characters" placeholder="">
      </div>
  </div>
  <div class="form-group">
    <label for="inputnewpassword" class="col-sm-2 control-label">New Pasword</label>
    <div class="col-sm-10 col-md-7 col-lg-5 col-xs-12">
      <input type="password" pattern=".{6,}" name="newpassword" id="inputnewpassword" class="input-sm form-control" value="" required="required" title="minimum 6 characters">

  </div>
</div>
<div class="form-group">
    <label for="inputconfirmnewpassword" class="col-sm-2 control-label">Re-type new Password</label>
    <div class="col-sm-10 col-md-7 col-lg-5 col-xs-12">
        <input type="password" pattern=".{6,}" name="confirmnewpassword" id="inputconfirmnewpassword" class="input-sm form-control" value="" required="required" title="minimum 6 characters">
    </div>
</div>



<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 col-md-7 col-lg-5 col-xs-12">
      <button type="submit" id="submit_changepasswd" class="btn btn-block btn-lg btn-success"> Update my Password</button>
  </div>
</div>
</form>
</div>  <!-- /col-md-12-->
</div><!-- /row inside row -->
