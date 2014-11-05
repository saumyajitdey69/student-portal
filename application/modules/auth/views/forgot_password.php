<h1><?php echo lang('forgot_password_heading');?></h1>
<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

<?php if(!empty($message)) { ?>
<div class="alert alert-danger">
	<?php echo $message;?>
</div>
<?php } ?>

<?php echo form_open("auth/forgot_password");?>

      <p>
      	<label for="email"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label);?></label> <br />
      	<?php echo form_input($email);?>
      </p>

      <p><?php echo form_submit(array('class'=>'btn btn-success','name'=>'submit'), lang('forgot_password_submit_btn'));?></p>

<?php echo form_close();?>