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

<!-- <div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="page-header">
			<h1>Academic Section <br>	<small class="hidden-xs"> feedback | results | attendance | calendar</small></h1>
		</div>
	</div>
	<div class="col-md-7 col-sm-12 col-xs-12">
		<div class=" panel panel-default">
			<div class="panel-heading">
				Updates & Notifications
			</div>
			<div class="panel-body text-justify">
				</div>
			</div>
		</div>
		<div class="col-md-5 col-sm-12 col-xs-12">
			<div class=" panel panel-default">
				<div class="panel-heading">
				Routine Order (R.O.)
				</div>
				<iframe src="http://172.20.0.202/nitw_prm/archiveNews.aspx" height="300px" width="100%" frameborder="0"></iframe>
			</div>
		</div>
	</div> -->
	
	<!-- 	<h2><a href="http://goo.gl/CcOVYj">Click here to avail mobile banking services</a></h2> -->


		<!-- <div class="panel panel-default">

			<div class="panel-body">
				<ul>
					<li>1<sup>st</sup> year results have been put up.</li>
					<li><a href="<?php //echo base_url("audit/feedback"); ?>">Feedback</a> is now open.</li>
					<li>Results are out</li>
				</ul>
			</div>

		</div> -->
		
