<h1><?php echo lang('index_heading');?></h1>
<p><?php echo lang('index_subheading');?></p>
<div class="row">
    <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> -->
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
    <!-- </div> -->
</div>
<?php if(!empty($message)): ?>
	<div id="infoMessage" class="alert alert-danger"><?php echo $message;?></div>
<?php endif; ?>

<table class="table table-hover table-condensed table-striped" id="example">
	<thead>
		<tr>
		<th>User ID</th>
			<th><?php echo lang('index_fname_th');?></th>
			<th style="width:100px;"><?php echo lang('index_email_th');?></th>
			<th>Phone</th>
			<!-- <th>Department</th> -->
			<!-- <th>Designation</th> -->
			<th><?php echo lang('index_groups_th');?></th>
			<th><?php echo lang('index_status_th');?></th>
			<th><?php echo lang('index_action_th');?></th>
		</tr>
	</thead>
	<tbody>
		<?php $i=0; foreach ($users as $user):?>
			<tr>
				<td><?php echo $user->id ?></td>
				<td><?php echo $user->first_name;?></td>
				<td><?php echo $user->email;?></td>
				<td><?php echo $user->phone ?></td>
				<!-- <td><?php //echo $user->department ?></td> -->
				<!-- <td><?php //echo $user->designation ?></td> -->
				<td>
					<?php foreach ($user->groups as $group):?>
						<?php echo anchor("auth/edit_group/".$group->id, $group->name) ;?><br />
					<?php endforeach?>
				</td>
				<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
				<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
			</tr>
		<?php $i++; endforeach;?>
	</tbody>
</table>
<hr>

<div class="hidden-print">
	<?php //echo anchor('auth/create_group', lang('index_create_group_link'))?>
	<?php //echo anchor('auth/create_user', lang('index_create_user_link'))?>
</div>