<div class="row">
	<span class="hidden-print">
		<br><br>
	</span>
	<div class="col-md-2 col-lg-2 hidden-print">
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="row visible-print" style="border-bottom:2px solid black">
			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				<img class="img img-responsive" width="50px" src="<?php echo asset_url(); ?>images/logo_nitw.png" />
			</div>
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<h4 style="margin:0"><b>National Institute of Technology, Warangal</b></h4>
				<h5 style="margin:0">No dues cetificate, OMAHA Winter Session</h5>
				<br>
			</div>
			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				powered by <br>
				<img class="img" style="width:60px" src="<?php echo asset_url(); ?>images/logo_wsdc.png" />
			</div>
		</div>
		<!-- <div class="well  hidden-print"> 
								2nd Year, BTech ICCR students, please start booking your new rooms in 1k (Mega Hostel) at 10:00 pm  <br>
								2nd year, BTech ICCR students are requested to vacate the rooms in ISH before 12:00 pm
								<br>
								-By order Chief Warden, NITW Hostel Office
		
							</div> -->
		<div class="clearfix">		
		</div>
		<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
			<h5>Student Details</h5>
			<table class="table table-condensed google-table-extra-condensed table-striped">
				<tr>
					<td>Reg. No. </td>
					<td><label class="reg_num"><?php echo $details['regno'] ?></label></td>
				</tr>
				<tr>
					<td>Name </td>
					<td><label class="stu_name"><?php echo $details['sname'] ?></label></td>
				</tr>
				<tr>
					<td>Roll No. </td>
					<td><label class="roll_num"><?php echo $details['roll'] ?></label></td>
				</tr>
				<tr>
					<td>Course (Year)</td>
					<td><label class="stu_class"><?php echo $details['class'] ?></label> (<label class="stu_year"><?php echo $details['year'] ?></label>)</td>
				</tr>
				<tr>
					<td>Admision Type</td>
					<td><label class="stu_admissiontype"><?php echo $details['admissiontype'] ?></label></td>
				</tr>
			</table>
		</div>
		<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
			<h5>Allotment Details</h5>
			<table class="table table-condensed google-table-extra-condensed table-mess-hostel table-striped">
				<tr>
					<td>Hostel </td>
					<td><label class="stu_hostel"><?php echo $details['hostel'] ?></label></td>
				</tr>
				<tr>
					<td>Floor Number</td>
					<td>
						<label class="stu_floor"><?php echo $details['floor'] ?></label>
					</td>
				</tr>
				<tr>
					<td>Room No. </td>
					<td><label class="stu_room"><?php echo $details['room'] ?></label></td>
				</tr>
				<tr>
					<td>Mess </td>
					<td><label class="stu_mess"><?php echo $details['mess'] ?></label></td>
				</tr>
				<tr>
					<td>Receipt generated on </td>
					<td><label class="stu_mess"><?php echo date('d-M-Y'); ?></label></td>
				</tr>
			</table>
		</div>
		<div class="row" style="border-bottom:1px dotted black">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h5>Transcation Details </h5>
				<table class="table table-condensed google-table-extra-condensed table-transactions table-striped">
					<thead>
						<tr>
							<th>Reg No.</th>
							<th>Mess dues</th>
							<th>Mess Advance</th>
							<th>Total Amt Paid</th>
							<th>Extra Amount Paid</th>
						</tr>
					</thead>
					<tbody>
						<?php if(isset($messtransactions) and !empty($messtransactions)): ?>
							<tr>
								<td><?php echo $messtransactions['regno']; ?></td>
								<td><?php echo $messtransactions['mess_dues']; ?></td>
								<td><?php echo $messtransactions['mess_advance']; ?></td>
								<td><?php echo $messtransactions['total']; ?></td>
								<td><?php echo $extra; ?></td>
							</tr>
						<?php endif;	?>
					</tbody>
				</table>
				<center class="hidden-print">
					<button type="button" onclick="window.print()" class="btn btn-md btn-primary"><span class="glyphicon glyphicon-print"></span> Print</button>
				</center>
				<br><br><br><br>			
			</div>
		</div>



		<span class="visible-print" style="margin-top:50px;">
			<div class="row" style="border-bottom:2px solid black">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					<img class="img img-responsive" width="50px"  src="<?php echo asset_url(); ?>images/logo_nitw.png" />
				</div>
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<h4 style="margin:0"><b>National Institute of Technology, Warangal</b></h4>
					<h5 style="margin:0">No dues cetificate, OMAHA Winter Session</h5>
					<br>
				</div>
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					powered by <br>
					<img class="img" style="width:60px" src="<?php echo asset_url(); ?>images/logo_wsdc.png" />
				</div>
			</div>
			<div class="clearfix">		
			</div>
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<br><br>
				<img src="<?php echo asset_url(); ?>images/profile-img.png" height=144 width=144/>
			</div>
			<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
				<table class="table table-condensed google-table-extra-condensed table-striped">
					<tr>
						<td>Name </td>
						<td colspan="3"><label class="stu_name"><?php echo $details['sname'] ?></label></td>
					</tr>
					<tr>
						<td>Reg. No. </td>
						<td><label class="reg_num"><?php echo $details['regno'] ?></label></td>
						<td>Roll No. </td>
						<td><label class="roll_num"><?php echo $details['roll'] ?></label></td>
					</tr>
					<tr>
						<td>Course (Year)</td>
						<td><label class="stu_class"><?php echo $details['class'] ?></label> (<label class="stu_year"><?php echo $details['year'] ?></label>)</td>
						<td>Admision Type</td>
						<td><label class="stu_admissiontype"><?php echo $details['admissiontype'] ?></label></td>
					</tr>
					<tr>
						<td>Hostel </td>
						<td><label class="stu_hostel"><?php echo $details['hostel'] ?></label></td>
						<td>Room No. </td>
						<td><label class="stu_room"><?php echo $details['room'] ?></label></td>
					</tr>
					<tr>
						<td>Father's Name : </td>
						<td colspan="3"><label class="stu_father"><?php echo $details['father'] ?></label></td>
					</tr>
					<tr>
						<td>Home Address </td>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td>PIN  </td>
						<td>&nbsp;</td>
						<td>State </td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>Mobile </td>
						<td><label class="stu_contact"><?php echo $details['contact'] ?></label></td>
						<td>Email ID </td>
						<td><label class="stu_email"><?php echo $details['email'] ?></label></td>
					</tr>
				</table>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<table class="table table-condensed google-table-extra-condensed table-striped table-bordered">
					<tr>
						<td>Allotted Mess</td>
					</tr>
					<tr>
						<td><label class="stu_mess"><?php echo $details['mess'] ?></label></td>
					</tr>
				</table>
			</div>
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<br>
				<br>
				<br><h5 align="right"><b>Signature of the student</b></h5>
			</div>
		</span>
	</div>
</div>


