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
<legend>Make-up Registration 2014</legend>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Instructions</h3>
	</div>
	<div class="panel-body">
		<ul>
		<li>Online Registrations are closed
		</li>
		<!-- <li class="lead">All the courses will be updated after 7:00 pm</li> -->
			<!-- <li>Once you are registered for the course you cannot edit it</li>
			<li>Last date of registration is 11<sup>th </sup> June, 2014 before 5:00 pm. Students can not register for makeup examination after this</li>
			<li>The student should bring i-collect (state-bank collect) receipt, institute identity card and registration slip for the examination</li>
			<li>Incase you did a mistake please contact Associate Dean Examination. WSDC is not authorize to edit any data submitted by students</li>
			<li>For any "TECHNICAL" help please drop an email to <a href="mailto:wsdc.nitw@gmail.com" target="_blank">wsdc.nitw@gmail.com</a></li>
			<li>If you feel we can improve the portal please send your seggestions to <a href="mailto:wsdc.nitw@gmail.com" target="_blank">wsdc.nitw@gmail.com</a></li>
 -->		</ul>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Student Details</h3>
			</div>
			<div class="panel-body">
				<div class="alert alert-warning">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>IMPORTANT! </strong> Check the following details, to edit these details click on "audit" tab, under that click on "Profile";
				</div>
				<table class="table table-hover table-condensed table-responsive table-striped">
					<tbody>
						<tr>
							<td>Reg No.</td>
							<td>:</td>
							<td><label class="reg_num"><?php echo $details['regno'] ?></label></td>
						</tr>
						<tr>
							<td>Name</td>
							<td>:</td>
							<td><label class="stu_name"><?php echo $details['name'] ?></label></td>
						</tr>
						<tr>
							<td>Roll No</td>
							<td>:</td>
							<td><label class="roll_num"><?php echo $details['roll'] ?></label></td>
						</tr>
						<tr>
							<td>Branch</td>
							<td>:</td>
							<td><label class="stu_contact"><?php echo $details['branch'] ?></label></td>
						</tr>
						<tr>
							<td>Class</td>
							<td>:</td>
							<td><label class="stu_contact"><?php echo $details['class'] ?></label></td>
						</tr>
<!--             <tr>
              <td>Year</td>
              <td>:</td>
              <td><label class="stu_contact"><?php //echo $details['contact'] ?></label></td>
          </tr> -->
          <tr>
          	<td>Contact No.</td>
          	<td>:</td>
          	<td><label class="stu_contact"><?php echo $details['contact'] ?></label></td>
          </tr>
      </tbody>
  </table>
</div>
</div>

</div>
<!-- <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">New Registration</h3>
		</div>
		<div class="panel-body">
			<div class="alert alert-makeup hidden">
			</div>
			<form action="#" onsubmit="return false;" class="form new-registration" method="POST" role="form">
				<div class="col-sm-4 col-xs-12">
					<div class="form-group">
						<label for="inputTransactionId" class="control-label">Transaction Id</label>
						<input type="text" class="form-control input-sm" id="inputTransactionId" placeholder="Transaction Id" required pattern="[a-zA-Z0-9 ]+" title="Refer SBH transaction receipt for valid transaction id">
						<span class="help-block">recheck your transaction id, it cannot be changed later</span>
					</div>
				</div>
				<div class="col-sm-4 col-xs-12">
					<div class="form-group">
						<label for="ihnputTotalAmt" class="control-label">Total amount paid</label>
						<input type="number" step="600" class="form-control input-sm" id="inputTotalAmt" placeholder="Total amount paid" value="600" min="600" required>
						<span class="help-block">multiple of 600 only</span>
					</div>
				</div>
				<div class="col-sm-4 col-xs-12">
					<div class="form-group">
						<label for="inputTDate" class="control-label">Date of Transaction</label>
						<input type="date" class="form-control input-sm" id="inputTDate" placeholder="Date of Transaction" required>
					</div>
				</div>
				<div class="clearfix">
				</div>
				<div class="col-sm-4 col-xs-12">
					<div class="form-group">
						<label for="inputTDate" class="control-label">Course id </label>
						<div class="input-group">
							<input type="text" name="courseid" id="inputCourseid" class="form-control input-sm" value="" placeholder="course id">
							<span class="input-group-btn">
								<button class="btn btn-info btn-sm btn-courseid" data-loading-text="searching" type="button"><span class="glyphicon glyphicon-plus"></span> add</button>
							</span>
						</div>/input-group
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
						<table class="table table-hover table-condensed table-editable">
							<thead>
								<tr>
									<th class="col-xs-3">Course Id</th>
									<th>Course Name</th>
									<th>Delete?</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<div class="alert alert-danger">
							<strong>IMPORTANT! </strong>Check the course name before submitting
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-md btn-submit"  data-loading-text="registering" ><span class="glyphicon glyphicon-check"></span> Register</button>
					<div class="alert text-warning">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div> -->
</div>
<span id="status-panel">
	<?php if ($registered != false): ?>
		<div class="row div-status">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Registration Status</h3>
					</div>
					<div class="panel-body">
						<table class="table table-hover table-condensed table-striped table-bordered table-status">
							<thead>
								<tr>
									<th>Transaction Id</th>
									<th>Total Amt. Paid</th>
									<th>Transaction Date</th>
									<th>Registerted Courses</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($registered) and $registered != FALSE): ?>
									<?php foreach ($registered as $key => $r) : ?>
										<tr>
											<td><?php echo $r["transaction_id"] ?></td>
											<td><?php echo $r["paid"] ?></td>
											<td><?php echo $r["transaction_date"] ?></td>
											<td>
												<?php if (!$r["lists"] == false): ?>
													<?php foreach ($r["lists"] as $key => $list): ?>
														<ul>
															<li><?php echo $list['course_id']." (".$list["course_name"].") " ;?></li>
														</ul>
													<?php endforeach ?>
												<?php else: ?>
													<p class="text-danger">Invalid Entry, Please contact WSDC (wsdc.nnitw@gmail.com)</p>

												<?php endif ?>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php endif ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>  
	<?php endif ?>
</span>

