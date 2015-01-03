<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<?php if(isset($errors) && count($errors) > 0): ?>
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<ul>
					<?php foreach ($errors as $error): ?>
						<li><?= $error ?></li>
					<?php endforeach ?>
				</ul>
			</div>
		<?php endif; ?>
		<br>
		<strong>Transaction Summary</strong>
		<?php if (!empty($messtransactions) && $messtransactions != FALSE): ?>
			<table class="table table-hover table-condensed">
				<thead>
					<tr>
						<th>Ref. No./ UTR </th>
						<th>Transaction Date</th>
						<th>Type</th>
						<th>Mess dues</th>
						<th>Mess Advance</th>
						<th>Maintenance</th>
						<th>EWC </th>
						<th>Seat Rent</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($messtransactions as $key => $item): ?>
						<tr>	
							<td><a href="#" title="Transaction details"><?php echo $item['bank_reference_no'] ?></a> </td>
							<td><?php echo $item['transaction_date'] ?></td>
							<td><?php echo $item['transaction_type'] ?></td>
							<td><?php echo $item['mess_dues'] ?></td>
							<td><?php echo $item['mess_advance'] ?></td>
							<td><?php echo $item['maintenance_charges'] ?></td>
							<td><?php echo $item['emc'] ?></td>
							<td><?php echo $item['seatrent'] ?></td>
							<td><?php echo $item['total'] ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="3" class="text-right">Total Amount paid :</th>
						<th><?= $consolidated_payment['mess_dues'] ?></th>
						<th><?= $consolidated_payment['mess_advance'] ?></th>
						<th><?= $consolidated_payment['maintenance_charges'] ?></th>
						<th><?= $consolidated_payment['emc'] ?></th>
						<th><?= $consolidated_payment['seatrent'] ?></th>
						<th><?= $consolidated_payment['total_amount_paid'] ?></th>
					</tr>
				</tfoot>
			</table>
		<?php else: ?>
			<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Mess transactions are not approved//uploaded by Hostel Office. <br>
				<a href="#">Click here</a> to learn more.
			</div>
		<?php endif; ?>
		<!--allowed hostel mess start here-->
		<strong>Allowed Hostel & Mess</strong>
		<!--allowed hostel mess ends here-->
	</div>
</div>