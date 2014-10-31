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
<div class="well">
	<h1>Academic Audit</h1>
	<p>Academic Feedback | Academic Results | Academic Calender</p>
	<h2><a href="http://goo.gl/CcOVYj">Click here to avail mobile banking services</a></h2>
</div>


		<!-- <div class="panel panel-default">

			<div class="panel-body">
				<ul>
					<li>1<sup>st</sup> year results have been put up.</li>
					<li><a href="<?php //echo base_url("audit/feedback"); ?>">Feedback</a> is now open.</li>
					<li>Results are out</li>
				</ul>
			</div>

		</div> -->
		<div class="col-md-7 col-sm-12 col-xs-12">
			<div class=" panel panel-default">
				<div class="panel-heading">
					UPDATES
				</div>
				<div class="panel-body">
					<ul>
						<li> <a target="_blank" href="http://nitw.ac.in/nitw/downloads/MTECH_Makeup.pdf"><span class="glyphicon glyphicon-download"></span> click here for MTech make up examination time-table</a></li>
						<li>Registration slip for make up examinations are available</li>
						<li> Online Registration for make-up examination will start on 4<sup>th</sup> June, 2014. <br><a target="_blank" href="http://www.nitw.ac.in/nitw/downloads/Make-up-2014Time_Tablefinal.pdf"><span class="glyphicon glyphicon-download"></span> Click here for revised examination schedule </a></li>
						<li><a target="_blank" href="http://www.nitw.ac.in/nitw/downloads/backlog_results_even_2014.PDF"><span class="glyphicon glyphicon-download"></span> Click here for backlog results </a></li>
						<li>Students who did not fill either course feedback or exit feedback (for final years only) should pay Rs. 500/- as fine and submit a copy of the receipt to either Dean-Academic or Associate Dean Academic Audit. Only then they will be permitted to enter the feedback and view results. <br>
							By order: Academic Dean <br>
							Reference: email sent to wsdc.nitw@gmail.com at 9:26 AM 7-05-14 by Associate Dean Academic Audit</li>
							<li>Your registration number should be correct in order to avoid any problem during Online Hostel Allotment ( registration number should be same as on Institute ID card)</li>
							<li>Online Hostel Allotment will probably start on 1st week of july. All the details will be shared with students beforehand.</li>
							<li>For any query, please drop an email on wsdc.nitw@gmail.com</li>
							<li>Feedback is closed.</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-5 col-sm-12 col-xs-12">
				<div class=" panel panel-default">
					<div class="panel-heading">
						RO
					</div>
						<iframe src="http://172.20.0.202/nitw_prm/archiveNews.aspx" height="300px" width="100%" frameborder="0"></iframe>
				</div>
			</div>
