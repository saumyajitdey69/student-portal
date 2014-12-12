<br>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<legend>Hostel & Mess fee details</legend>
</div>

<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">Hostels detail</h3>
		</div>
		<table class="table table-hover table-condensed table-hover table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Hostel Name</th>
					<th>Total Floors</th>
					<th>Hostel Fees</th>
					<th>Maintenance Charge</th>
					<!-- <th><span class="tips" title="No. of vaccant rooms">Vaccant rooms</span></th> -->
				</tr>
			</thead>
			<tbody>
				<?php if(isset($hostels)) ?>
				<?php foreach ($hostels as $key => $hostel): ?>
					<tr>
						<td><?php echo $key+1 ?></td>
						<td><?php echo $hostel['name'] ?></td>
						<td><?php echo $hostel['numfloors'] ?></td>
						<td><?php echo $hostel['hostelfee'] ?></td>
						<td><?php echo $hostel['maintenance'] ?></td>
						<td><?php //echo isset($hostel['vacancy']) ? $hostel['vacancy'] : 'N/A' ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">Messes details</h3>
		</div>
		<table class="table table-hover table-condensed table-hover table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Mess Name</th>
					<th>Mess Advance</th>
					<th>Mess Capacity</th>
					<th>Current Count</th>
				</tr>
			</thead>
			<tbody>
				<?php if(isset($messes)) ?>
				<?php foreach ($messes as $key => $mess): ?>
					<tr>
						<td><?php echo $key+1 ?></td>
						<td><?php echo $mess['name'] ?></td>
						<td><?php echo $mess['messadvance'] ?></td>
						<td><?php echo $mess['capacity'] ?></td>
						<td><?php echo $mess['currentcount'] ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<div class="well">
	<strong>NOTE: Eligibility list updated on 4/07/2014 at 2:40 pm IST</strong> <br>
		<strong>NOTE: Seat Rent and Electri. Water charges should be paid to chief wardent account <br></strong>
		<a href="<?php echo base_url('assets/downloads/pdfs/eligibility-list.pdf') ?>"><span class="glyphicon glyphicon-download"></span> Click here to download eligibility list.</a>
	</div>
</div>