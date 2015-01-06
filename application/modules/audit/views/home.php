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

<?php if(isset($message))
{
	echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>'.$message.'</div>';
}
?>
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9 main">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?php echo modules::run('enotice', 'google-apps-username') ?>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?php echo modules::run('enotice', 'academic-home') ?>
		</div>
	</div>
		
	</div>
	<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 main" id="enotice">
		<?php echo modules::run('enotice', 'academic-section'); ?>
	</div>
</div>



