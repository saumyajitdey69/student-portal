<div class="col-md-8 col-md-offset-2">


      <h1><?php echo lang('create_user_heading');?></h1>
      <p><?php echo lang('create_user_subheading');?></p>

      <?php if(!empty($message)) { ?>
      <div class="alert alert-danger">
            <?php echo $message;?>
      </div>
      <?php } ?>

      <?php echo form_open("auth/create_user");?>

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
</div>