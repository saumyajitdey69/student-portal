<h4><?php echo lang('forgot_password_heading');?></h4>
<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

<?php if(!empty($message)) { ?>
<div class="alert alert-danger">
	<?php echo $message;?>
</div>
<?php } ?>
<div class="well google-well">
	<?php echo form_open("auth/forgot_password");?>

	<p>
	<div class="help-block" for="email"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label);?></div> 
		<?php echo form_input($email);?>
	</p>

	<p><?php echo form_submit(array('class'=>'btn btn-success','name'=>'submit'), lang('forgot_password_submit_btn'));?></p>

	<?php echo form_close();?>
</div>