<div class="well wsdc-well">
<div class="container">
		<h1>Online Mess And Hostel Allotment (OMAHA)</h1>
</div>
</div>
<div class="container">
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
<legend id="transacitonsummary">Transaction Summary of <strong><?php echo $regno ?></strong></legend>

		<div class="panel panel-default">
			<?php if (!empty($studenttransactions) && $studenttransactions != FALSE): ?>
				<table class="table table-hover table-condensed table-striped table-bordered">
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
				<hr>
			<?php else: ?>
				<br>
				<div class="panel-body">
					<legend class="text-primary">
						OMAHA Payment Procedure
					</legend>	
					<legend class="text-danger">Electricity & Water charges &#x20B9; 4500 - reviewed by Hostel Office </legend>
					<p class="text-danger">
						Those who already paid via DD/NEFT/Inter Bank Transfer needs to make another DD/NEFT/Inter Bank Trasfer transaction of remaining amount
					</p>
					<hr>
					<legend> All the Education Loan holders (including all DD/NEFT transactions and (Inter/Intra Bank Transfer to Chief Warden Account) </legend>
					<ol>
						<li>Make a single transaction for Mess dues, mess advance (10k), seat rent, maintenance charge, Water and electricity charges(4.5k)</li>
						<li>Take an image of the transaction receipt and upload on student portal. (upload option will be activated on Monday)</li>
						<li>Enter Transaction ID (DD Number/ NEFT transaction Reference Number/ Inter or Intra bank Reference Number) and transaction date on student portal. (This feature will be activated on Monday) </li>
						<li>Within two days, your transaction will be approved by Hostel Office. If not drop us an email on 3rd day</li>
						<li>Once the transaction is approved, you can book the room when online booking starts</li>
						<li>Go to Hostel Office as soon as you reach college, get the receipt, go to your room</li>
						<li>If you fail to produce the same DD/NEFT receipt or if transaction id is incorrectly entered on student portal, your room allotment will be cancelled</li>
					</ol>
					<p class="text-danger">In case you followed the last year's process and made two DD. Please wait till Monday, we will find a way out.</p>
					<p>NOTE: Those who are paying via state bank collect need not to go to Hostel Office at all, everything is online for you :)</p>
					<hr>
					<p>State bank collect (i-collect) / DD / NEFT</p>
					<p>
						Students must pay following fees to avail Online Allotment
						<ul>
							<li>Mess Dues</li>
							<li>Mess Advance</li>
							<li>Maintenance Charges</li>
							<li>Seat Rent</li>
							<li>Water Elect.Charges</li>
						</ul>

						<strong>-To chief warden, NITW</strong>
					</p>

					<p>
						<strong class="text-danger">IMPORTANT NOTE: </strong>
						<ul>
						<li>New state-bank collect (i-collect) payment link : https://www.onlinesbh.com/prelogin/icollecthome.htm</li>
							<li>Tuition fees and other fees are not mandatory for OMAHA and can be paid before semester registrations.</li>
							<li>(State bank collect will start from 5th July, 2014 and OMAHA will start tentatively a week after this)</li>
							<li>It will take maximum of two days to upload your payment transactions on student portal.</li>
							<li>Make sure that the registration number on i-collect form and on the student portal are same.</li>
						</ul>
					</p>

					
					<p class="text-danger">
						<!-- No transactions are recorded. -->
						It takes maximum of 2 working days to upload transaction details on this portal. In case your transaction details are not uploaded within two days, please drop a mail to wsdc.nitw@gmail.com on the third day.
					</p>
					<p>
						<strong><span class="glyphicon glyphicon-warning-sign"></span> Hostel Allotment will start for all the students of NITW at the same time. Do not violate the code of conduct of WSDC. If found your account will be blocked without prior intimation.</strong>
					</p>
					<p class="text-primary">
						follow us on facebook for updates
						<div class="fb-like" data-href="https://www.facebook.com/wsdc.nitw" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
					</p>
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
		<!--allowed hostel mess start here-->
		<?php if(!empty($allowed_hostel_mess)||$allowed_hostel_mess['hosltel']||$allowed_hostel_mess['mess']) {
		 ?>
		<div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
			<legend id="transacitonsummary">Allowed hostel and mess of <strong><?php echo $regno ?></strong></legend>
			<table class="table table-hover table-condensed table-striped table-bordered" >
				<tbody>
					<tr>
						<td><strong>Allowed Hostels</strong></td>
						<td>
							<?php if($allowed_hostel_mess['hostel']){ ?>
							<ol>
								<?php foreach ($allowed_hostel_mess['hostel'] as $hostel) {
									echo '<li>'. $hostel['name'] . '</li>';
								} ?>
							</ol>
							<?php }else{
								echo "No hostels available.";
							}
							 ?>
						</td>
					</tr>
					<tr>
						<td><strong>Allowed Messes</strong></td>
						<td>
							<?php if($allowed_hostel_mess['mess']){ ?>
							<ol>
								<?php foreach ($allowed_hostel_mess['mess'] as $mess) {
									echo '<li>' . $mess['name'] .'</li>' ;
								} ?>
							</ol>
							<?php }else{
								echo "No messes available.";
							} ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php } ?>
		<!--allowed hostel mess ends here-->


		<!-- Instructions starts here -->
		<hr>
		<legend id="helpsupport">Help & Support</legend>

					<!-- <button type="button" class="btn btn-primary btn-wsdc-font-sm btn-lg btn-block img-circle img">
						Your Mess dues : <?php echo isset($messdues) ? '&#x20B9; '.$messdues : 'N/A'; ?>
					</button>
					<br>
					<a href="<?php echo base_url('hostels/details') ?>">Click here for hostel and Mess fee structure</a>
					<br><br> -->
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
										Mess dues help
									</a>
								</h4>
							</div>
							<div id="messdues" class="panel-collapse collapse in">
							<br>
								<ul>
									<li>Please check your registration number and roll number if messdue is displayed as N/A.</li>
										<!-- <li>If your mess dues is not correct, please contact Hostel Office (<a href="mailto:guru3386@gmail.com">Gurupathy Bejugam, Hostel & Mess superintendent</a>) not WSDC</li>
										<li>If you find any alteration in mess dues please contact Hostel Office only</li> -->
									<li>Phd Students: Mess dues are uploaded.</li>
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
								<li>Mess dues are uploaded. Please check</li>
								<li>Please create a WSDC account if do not have one</li>
							</ul>
						</div>
					</div>
				</div>

		<!-- Instructions ends here -->

		<!-- hostel and mess history -->
		<hr>
		<legend id="allotmenthistory">Allotment Hostory</legend>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#hostelhistory" data-toggle="tab">Hostel History</a></li>
			<li><a href="#messhistory" data-toggle="tab">Mess History</a></li>
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
		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		<a href="https://www.onlinesbh.com/prelogin/icollecthome.htm" class="btn btn-default btn-info btn-lg btn-block">State Bank Collect</a>
		<br>
		<a href="/student/hostels/wsdc_collect/" class="btn btn-default btn-info btn-lg btn-block">WSDC Collect <br> <small>for NEFT/DD/Intra Bank</small></a>
		<br>
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
						<td>&#x20B9; <?php echo $messdues ?> </td>
					</tr>
					<tr>
						<td>Mess Advance</td>
						<td>&#x20B9; 10000</td>
					</tr>
					<tr>
						<td>Water & electricity charges</td>
						<td>&#x20B9; 4500 </td>
					</tr>
					<tr>
						<td>Seat Rent and Maintenance Charge</td>
						<td><a href="<?php echo base_url('hostels/details') ?>">Click here </a></td>
					</tr>
				</tbody>
			</table>
			<div class="well text-justify">
				Follow us on facebook and twitter for updates. <br>
				<a href="https://www.facebook.com/wsdc.nitw" target="_blank">facebook</a> | 
				<a href="https://www.twitter.com/wsdcnitw" target="_blank">twitter</a>
			</div>	
		</div>
	</div>
</div>
<div class="clearfix">
</div>
</div>

