<h1>Activation Link</h1>
<?php if(!empty($message)) { ?>
<div class="alert alert-danger">
	<?php echo $message;?>
</div>
<?php } ?>

<?php echo form_open("auth/activation_mail");?>

      <p>
      <label for="email">Please enter your Email Id so we can send you an activation mail.</label>
      	<input type="email" id="email" class="form-control input-sm" name="email"/>
      </p>

      <p><?php echo form_submit(array('class'=>'btn btn-success','name'=>'submit'), 'Get Activation Link');?></p>

<?php echo form_close();?>