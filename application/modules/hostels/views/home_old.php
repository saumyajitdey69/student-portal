<div class="well wsdc-well">
	<h1>Online Hostel & Mess Allotment (OHMA)</h1>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Transaction Summary of <strong><?php echo $regno ?></strong></h3>
			</div>
			<?php if (!empty($studenttransactions) && $studenttransactions != FALSE): ?>
				<table class="table table-hover table-condensed table-striped table-bordered">
					<thead>
						<tr>
							<th>Reg No</th>
							<th>Mess dues</th>
							<th>Mess Advance</th>
							<th>Maintenance</th>
							<th>Tuition fees</th>
							<th>Other fees</th>
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
								<td><?php echo $item['tuitionfee'] ?></td>
								<td><?php echo $item['otherfee'] ?></td>
								<td><?php echo $item['emc'] ?></td>
								<td><?php echo $item['seatrent'] ?></td>
								<td><?php echo $item['total'] ?></td>
								<td><?php echo $item['timestamp'] ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<hr>
			<?php else: ?>
				<br>
				<div class="panel-body text-danger">
					<p>
						Payment procedure will start soon. Inorder to book a room online all the institue fees including tuition fees or any other must be paid prior to booking. Other details will be posted on facebook as well as will updated on Student Portal.
					</p>	
					<p>
						<!-- No transactions are recorded. -->
						It takes maximum of 2 working days to upload transaction details on this portal. In case your transaction details are not uploaded within two days, please drop a mail to wsdc.nitw@gmail.com on the third day.
					</p>
					<p>
						<strong><span class="glyphicon glyphicon-warning-sign"></span> Hostel Allotment will start for all the students of NITW at the same time. Do not voilate the code of conduct of WSDC. If found your account will be blocked without prior intimation.</strong>
					</p>
					<p class="text-primary">
						follow us on facebook for updates
						<div class="fb-like" data-href="https://www.facebook.com/wsdc.nitw" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
					</p>
					<!-- <p>
						<div class="fb-post" data-href="https://www.facebook.com/wsdc.nitw/posts/1472966139611452?" data-width="300"></div>
					</p> -->
				</div>
			<?php endif; ?>
			<?php if (!empty($messtransactions) && $messtransactions != FALSE): ?>
				<table class="table table-hover table-condensed table-striped table-bordered">
					<thead>
						<tr>
							<td colspan="9"> Chief Warden Account <span class="badge"></span></td>
						</tr>
					</thead>
					<thead>
						<tr>
							<th>#</th>
							<th>Bank Ref. No</th>
							<th><span class="tips" title="Date of transaction">T. Date</span></th>
							<th>Reg No</th>
							<th>Mess dues</th>
							<th>Mess Advance</th>
							<th>Maintenance</th>
							<th>Total</th>
							<th>Type</th>
							<th>Last update</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($messtransactions as $key => $item): ?>
							<tr>
								<td><?php echo $key+1 ?></td>
								<td><?php echo $item['transactionid'] ?></td>
								<td><?php echo $item['date'] ?></td>
								<td><?php echo $item['regno'] ?></td>
								<td><?php echo $item['mess_dues'] ?></td>
								<td><?php echo $item['mess_advance'] ?></td>
								<td><?php echo $item['maintenance_charges'] ?></td>
								<td><?php echo $item['total'] ?></td>
								<td><?php echo $item['transaction_type'] ?></td>
								<td><?php echo $item['timestamp'] ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			<?php endif ?>
			<br>
			<?php if (!empty($hosteltransactions) && $hosteltransactions != FALSE): ?>
				<table class="table table-hover table-condensed table-striped table-bordered">
					<thead>
						<tr>
							<td colspan="9"> FEE Account NITW <span class="badge"></span></td>
						</tr>
					</thead>
					<thead>
						<tr>
							<th>#</th>
							<th>Bank Ref. No</th>
							<th><span class="tips" title="Date of transaction">T. Date</span></th>
							<th>Reg No</th>
							<th>Tuition fees</th>
							<th>Other fees</th>
							<th>EMC</th>
							<th>Seat Rent</th>
							<th>Total</th>
							<th>Type</th>
							<th>Last update</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($hosteltransactions as $key => $item): ?>
							<tr>
								<td><?php echo $key+1 ?></td>
								<td><?php echo $item['transactionid'] ?></td>
								<td><?php echo $item['date'] ?></td>
								<td><?php echo $item['regno'] ?></td>
								<td><?php echo $item['tuitionfee'] ?></td>
								<td><?php echo $item['otherfee'] ?></td>
								<td><?php echo $item['emc'] ?></td>
								<td><?php echo $item['seatrent'] ?></td>
								<td><?php echo $item['total'] ?></td>
								<td><?php echo $item['transaction_type'] ?></td>
								<td><?php echo $item['timestamp'] ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			<?php endif ?>
		</div>
<!-- 			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">History</h3>
				</div> -->
				<!-- Nav tabs -->
				<ul class="nav nav-tabs">
					<li class="active"><a href="#hostelhistory" data-toggle="tab">Hostel History</a></li>
					<li><a href="#messhistory" data-toggle="tab">Mess History</a></li>
					<!-- <li><a href="#fees" data-toggle="tab">Fee details</a></li> -->
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane fade in active" id="hostelhistory">
						<?php if(!empty($hostelhistory)): ?>

							<?php foreach ($hostelhistory as $key => $item): ?>
								<li class="list-group-item <?php echo $item['status'] == '1' ? 'text-success' : '' ?>">
									<?php echo $item['hostel']  ?>, Floor #: <?php echo $item['floor'] ?>, Room #: <?php echo $item['room'] ?>
									<br>
									Last change: <?php echo $item['timestamp']; ?>

								<?php endforeach ?>

							<?php endif; ?>
						</div>
						<div class="tab-pane fade" id="messhistory">
							<?php if(!empty($messhistory)): ?>
								<ul>
									<?php foreach ($messhistory as $key => $item): ?>
										<li class="list-group-item <?php echo $item['status'] == '1' ? 'text-success' : '' ?>">
											Mess Name: <?php echo $item['mess']  ?>
											<br>
											Last change: <?php echo $item['timestamp']; ?>
										</li>
									<?php endforeach ?>

								</ul>
							<?php endif; ?>
						</div>
					</div>
					<!-- </div> -->
				</div>
				<!-- <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<table class="table table-hover table-condensed table-striped">
						<thead>
							<tr>
								<th>Payment type</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div> -->
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<button type="button" class="btn btn-primary btn-wsdc-font-sm btn-lg btn-block img-circle img">
						Your Mess dues : <?php echo isset($messdues) ? '&#x20B9; '.$messdues : 'N/A'; ?>
					</button>
					<br>
					<a href="<?php echo base_url('hostels/details') ?>">Click here for hostel and Mess fee structure</a>
					<br><br>
					<!-- <button type="button" class="btn btn-primary btn-wsdc-font-sm btn-lg btn-block img-circle img">
						Paid via NEFT or DD? <br>
						<p>Click here to enter your transaction ID</p>
					</button>
					<br> -->
					<!-- <button type="button" class="btn btn-primary btn-wsdc-font-sm btn-lg btn-block img-circle img">
						<span class="glyphicon glyphicon-print"></span> Print receipt
					</button>
					<br> -->

					<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#messdues">
										Click here for help on messdues
									</a>
								</h4>
							</div>
							<div id="messdues" class="panel-collapse collapse in">
								<ul>
									<li>Please check your registration number and roll number if messdue is displayed as N/A.</li>
									
								</ul>
							</div>
						</div>
						<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									Instructions for all students
								</a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse">
							<ul>
								<li>Rooms are available on first come first serve basis</li>
								<li>To avoid any inconvenience during online allotment please make sure that your registration number and roll number is same as on ID card.</li>
								<li>Do not use any hypens, underscore or spaces in you registration number or roll number</li>
								<li>If you roll number is same as of regsitration number on your ID card please upadate the same on audit profile and use the same during bank transactions.</li>
							</ul>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									Instructions for B. Tech Students
								</a>
							</h4>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse">
							<ul>
								<li>Do not use UG prefix in your roll number</li>
								<li>Phd students: Please create a WSDC account if do not not have one</li>
							</ul>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
									Instructions for Phd students
								</a>
							</h4>
						</div>
						<div id="collapseThree" class="panel-collapse collapse">
							<ul>
								<li>Please create a WSDC account if do not have one</li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="clearfix">
		</div>


