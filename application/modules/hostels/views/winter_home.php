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
<h3 class="text-primary"> &nbsp; Online Mess And Hostel Allotment (OMAHA) <small>Winter Session</small></h3>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
		<div class="well">
			<a href="https://groups.google.com/forum/#!forum/omaha-winter">Click here for OMAHA Winter session Help Center</a>
		</div>
		<h4 id="transacitonsummary">
			Transaction Summary of OMAHA
		</h4>
		<?php if (!empty($studenttransactions) && $studenttransactions != FALSE): ?>
			<table class="table table-hover table-condensed table-striped">
				<thead>
					<tr>
						<th>Reg No</th>
						<th>Mess dues</th>
						<th>Mess Advance</th>
						<th>Maintenance</th>
						<th>EMC </th>
						<th>Seat Rent</th>
						<th>Total</th>
						<th>Last update</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($studenttransactions as $key => $item): ?>
						<tr>
							<td><?php echo $item['regno'] ?></td>
							<td><?php echo $item['mess_dues'] ?></td>
							<td><?php echo $item['mess_advance'] ?></td>
							<td><?php echo $item['maintenance_charges'] ?></td>
							<td><?php echo $item['emc'] ?></td>
							<td><?php echo $item['seatrent'] ?></td>
							<td><?php echo $item['total'] ?></td>
							<td><?php echo $item['timestamp'] ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		<?php else: ?>
			<p class="text-danger alert alert-danger">
			    <strong>Pay your Hostel Fees using State bank Collect, Intra/Inter Bank Transfer, NEFT only. DD payments are not permitted.</strong> <br>
				Transaction Details must be uploaded/approved by Hostel Office, NITW. If the transaction is not uploaded within 3 days (72 hours) of your payment go to hostel office when you come to college.
			</p>
		<?php endif; ?>
		<hr>
		<p>You should pay following amount to Chief Warden, via i-collect (state bank collect), or NEFT</p>
		<?php if(!empty($messdues)): ?>
		<table class="table table-hover table-condensed table-striped">
			<thead>
				<tr>
					<th>Payment type</th>
					<th>Amount to be paid</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Mess dues</td>
					<!-- <td>&#x20B9; <?php echo $messdues ?> </td> -->
					<td>&#x20B9; <?php echo $messdues['due']; ?></td>
				</tr>
				<tr>
					<td>Mess Advance</td>
					<td>&#x20B9; <?php echo $messdues['advance']; ?></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>	
					<th>Total amount payable to Chief Warden, NITW </th>
					<th>&#x20B9; <?php echo $messdues['total']; ?></th>
				</tr>
			</tfoot>
		</table>
	<?php else: ?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			Your messdues will be uploading soon.
		</div>
	<?php endif; ?>
		<hr>

		<p class="text-center">	
			<a type="button" href="<?php echo base_url('hostels/rules/winter') ?>" class="btn btn-lg btn-primary">Rules & Regulations for Winter Session</a>
		</p>
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingOne">
					<h4 class="panel-title">
					<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#messdues-xlsx" aria-expanded="true" aria-controls="messdues-xlsx">
							Messdues list of all the students
						</a>
					</h4>
				</div>
				<div id="messdues-xlsx" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
					<div class="panel-body">
						<ul>
							<li><a href="<?php echo base_url('assets/downloads/omaha/winter/messdues_2014/B.TECH - IV YEAR.xls') ?>">B. Tech Final Year</a></li>
							<li><a href="<?php echo base_url('assets/downloads/omaha/winter/messdues_2014/B.TECH-I YR.xls') ?>">B. Tech First Year</a></li>
							<li><a href="<?php echo base_url('assets/downloads/omaha/winter/messdues_2014/B.TECH-II YR.xls') ?>">B. Tech Second Year</a></li>
							<li><a href="<?php echo base_url('assets/downloads/omaha/winter/messdues_2014/B.TECH-III YR.xls') ?>">B. Tech Third year</a></li>
							<li><a href="<?php echo base_url('assets/downloads/omaha/winter/messdues_2014/PG COURSE-I.xls') ?>">PG Courses First year</a></li>
							<li><a href="<?php echo base_url('assets/downloads/omaha/winter/messdues_2014/PG COURSE-II & III.xls') ?>">PG Courses Second & Third Year</a></li>
							<li><a href="<?php echo base_url('assets/downloads/omaha/winter/messdues_2014/PH.D..xls') ?>">PHD</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		<!-- <strong>Payment Mode</strong> -->
		<a href="https://www.onlinesbh.com/prelogin/icollecthome.htm" class="btn btn-default btn-info btn-lg btn-block">State Bank Collect</a>
		<br>
		<!-- <a href="/student/hostels/wsdc_collect/" class="btn btn-default btn-info btn-lg btn-block">WSDC Collect <br> <small>for NEFT/DD/Intra Bank</small></a> -->
		<a href="#" class="btn btn-default btn-info btn-lg btn-block">WSDC Collect <br> <small>for NEFT/Intra Bank</small> <br> (starts on 14th Dec, 2014)</a>
		<hr>
		<p>
			<strong>Account Name:</strong> <br> CHIEF WARDEN, NITW <br>
			<strong>ACCOUNT NO:</strong> <br>52109375132 <br>
			<strong>IFSC code :</strong> <br>SBHY0020149 (within in INDIA) <br>
			<strong>SWIFT code:</strong> <br>SBHYINBB018 (transfer from abroad) <br>	
		</p>
	</div>
</div>
