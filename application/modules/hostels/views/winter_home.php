<h3 class="text-primary"> &nbsp; Online Mess And Hostel Allotment (OMAHA) <small>Winter Session</small></h3>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
		<div class="well">
		<p>State Bank Collect payment will start on 13th, Dec, 2014 (Tentative)</p>
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
				Your transaction is not listed here. Please go to Hostel Office, NITW and inform the same to the officials. Hostel Office must upload the information.
			</p>
		<?php endif; ?>
		<hr>
		<p>You should pay following amount to Chief Warden, via i-collect (state bank collect), DD or NEFT</p>
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
					<td>Will be uploading soon</td>
				</tr>
				<tr>
					<td>Mess Advance</td>
					<td>&#x20B9; 12000</td>
				</tr>
			</tbody>
		</table>
		<hr>		
		<p class="text-center">	
			<a type="button" href="<?php echo base_url('hostels/rules/winter') ?>" class="btn btn-lg btn-primary">Rules & Regulations for Winter Session</a>
		</p>
	</div>
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
	<!-- <strong>Payment Mode</strong> -->
		<a href="https://www.onlinesbh.com/prelogin/icollecthome.htm" class="btn btn-default btn-info btn-lg btn-block">State Bank Collect <br> (starts on 13th Dec, 2014)</a>
		<br>
		<!-- <a href="/student/hostels/wsdc_collect/" class="btn btn-default btn-info btn-lg btn-block">WSDC Collect <br> <small>for NEFT/DD/Intra Bank</small></a> -->
		<a href="#" class="btn btn-default btn-info btn-lg btn-block">WSDC Collect <br> <small>for NEFT/DD/Intra Bank</small> <br> (starts on 14th Dec, 2014)</a>
	</div>
</div>
