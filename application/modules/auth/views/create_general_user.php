<h1><?php echo lang('create_user_heading');?></h1>
<p><?php echo lang('create_user_subheading');?></p>

<?php if(!empty($message)) { ?>
	<div class="alert alert-danger">
		<?php echo $message;?>
	</div>
	<?php } ?>
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
<?php echo form_open("auth/create_general_user");?>

      <p>
            <?php echo lang('create_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($first_name);?>
      </p>

      <p>
            <?php echo lang('create_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($last_name);?>
      </p>

      <p>
            <?php echo lang('create_user_email_label', 'email');?> <br />
            <?php echo form_input($email);?>
      </p>
      <p>
            <?php echo lang('create_user_userid_label', 'user_id');?> <br />
            <?php echo form_input($user_id);?>
      </p>
      <p>
        <label for="inputRegNumber-signup" class="control-label">Registration Number</label>
        <?php echo form_input($regno);?>
        <span class="help-block">For first years this is your roll number.</span>

    </p>
    <div class="form-group">
        <label for="inputRollNumber-signup" class="control-label">Roll Number</label>
        <?php echo form_input($rollno);?>
        <span class="help-block">Append zero if roll number is less than zero</span>

    </div>
      <p>
            <?php echo lang('create_user_phone_label', 'phone');?> <br />
            <?php echo form_input($phone);?>
      </p>

      <p>
            <?php echo lang('create_user_password_label', 'password');?> <br />
            <?php echo form_input($password);?>
      </p>

      <p>
            <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
            <?php echo form_input($password_confirm);?>
      </p>


      <p><?php echo form_submit(array('class'=>'btn btn-success','name'=>'submit'), lang('create_user_submit_btn'));?></p>

<?php echo form_close();?>