<!-- <legend><?php echo lang('index_heading');?></legend>
	<small><?php echo lang('index_subheading');?></small> -->
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
		<div id="infoMessage" class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $message;?>
		</div>
	<?php endif; ?>

	<table class="table dataTable table-hover table-condensed" data-ajax="true" data-ajax-url="<?php echo base_url('auth/dataTables') ?>" id="example">
		<thead>
			<tr>
				<th>User Id</th>
				<th><?php echo lang('index_dname_th');?></th>
				<th><?php echo lang('index_email_th');?></th>
				<th>Roll No</th>
				<th>Reg No</th>
				<th>Phone</th>
				<th><?php echo lang('index_groups_th');?></th>
				<th><?php echo lang('index_status_th');?></th>
				<th><?php echo lang('index_action_th');?></th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach ($users_info as $user):?>
			<tr>
				<td><?php echo $user->id ?></td>
				<td><?php echo $user->first_name;?> <?php echo $user->last_name;?></td>
				<td><a href="mailto:<?php echo $user->email;?>" target="_blank"><?php echo $user->email;?></a></td>
				<td><?php echo $users_info[$i]->roll_number; ?></td>
				<td><?php echo $users_info[$i]->registration_number; ?></td>
				<td><?php echo $user->phone ?></td>
				<td>
					<?php foreach ($user->groups as $group):?>
						<?php echo anchor("auth/edit_group/".$group->id, $group->name) ;?><br />
					<?php endforeach?>
				</td>
				<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
				<td>
					<div class="btn-group">
						<!-- Edit the user details -->
						<?php echo anchor("auth/edit_user/".$user->id, '<i class="glyphicon glyphicon-pencil"></i>') ;?> 
						<!-- Delete user details -->
						<?php echo anchor("auth/delete_user/".$user->id, '<i class="glyphicon glyphicon-remove"></i>') ;?>
					</div>
				</td>
			</tr>
			<?php $i++; endforeach;?>
		</tbody>
	</table>
</div>
