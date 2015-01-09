<?php $valid_grades = array('A','B','C','D','E','F','P','R','EX','X'); ?>
<!-- <div class="alert alert-danger hidden-print">All the queries will be answered within 72 hours (if any). For any assistance send an email to wsdc.nitw@gmail.com</div> -->
<?php if(empty($results)):?>
	<?php if(isset($message)): ?>
		<div class="alert alert-danger hidden-print">
			<?php echo $message; ?>
		</div>
		<table class="table table-hover table-responsive table-condensed">
			<thead>
				<tr><th style="text-align:center">#</th>
					<th>COURSE ID</th><th>COURSE NAME</th>
					<th>FACULTY ALLOTED</th><th style="text-align:center">FEEDBACK</th>
				</tr>
			</thead>
			<tbody>

				<?php
				$course_id=1;
				foreach ($students_courses as $list) {
					foreach ($list['courses'] as $course) {
						$is_feedback_filled=0;

						$faculty_name="HOD";
						$alloted=0;
						$text_color="text-danger";
						$glyphicon="glyphicon-remove";
						if(isset($course['faculty_name'])){
							$faculty_name=$course['faculty_name'];
							$alloted=1;
						}
						if($feedback_status[$course_id-1]=='1'){
							$is_feedback_filled=1;
							$text_color="text-success";
							$glyphicon="glyphicon-ok";
						}
						?>
						<tr class="course_row"s>
							<td class="text-center"><?php echo $course_id;?></td>
							<td><?php echo $course['id'];?></td>
							<td><?php echo $course['name'];?></td>
							<td><?php echo $faculty_name;?></td>

							<td style="text-align:center;" class="<?php echo $text_color;?>"><span rel="tooltip" data-placement="left" title="Feedback<?php if($is_feedback_filled==0) echo 'not ';?> submitted" class="tips glyphicon <?php echo $glyphicon;?>"></span></td>
						</tr>
						<?php
						$course_id++;
					}
				} ?>
			</tbody>
		</table>
	<?php else: ?>
		<div class="alert alert-warning hidden-print">
			Your results are not yet uploaded. Please contact Dean Academics(<a href="mailto:dean_acad@nitw.ac.in">dean_acad@nitw.ac.in</a>).
		</div>
	<?php endif; ?>
<?php else: ?>
	<div id="result-column">
		<img class="visible-print" src="<?php echo base_url('assets/images/results_header.png') ?>" alt="header">
		<br><br><br>
		<button type="button" onclick="window.print()" class="btn btn-sm btn-default pull-right hidden-print">Print</button>
		<div id="grade-column">
			<?php foreach($results as $result): ?>
				<center><h4>Academic Result</h4></center>
				<?php if($result['publish_status'] === "0") : ?>
					<center><h3 class="text-danger">Your results will be published shortly.</h3></center>		
				<?php else: ?>
					<table id="info-table" class="table">
						<?php if($result['specialization']): ?>
							<tr>
								<td><b class="color">Specialization</b></td>
								<td colspan="3"><?php echo $result['specialization']; ?></td>

							</tr>
						<?php endif; ?>
						<tr>
							<td><b class="color">Roll no.</b></td>
							<td><?php echo $result['RegNo']; ?></td>
							<td><b class="color">Year/Sem</b></td>
							<td><?php echo $result['semester']; ?></td>

						</tr>
						<tr>
							<td><b class="color">Name</b></td>
							<td><?php echo strtoupper($result['Name']); ?></td>
							<td><b class="color">Examination</b></td>
							<td>April 2014</td>
						</tr>
					</table>
					<table id="" class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>Sub.Code</th>
								<th>Subject Name</th>
								<th>Credit(s)</th>
								<th>Grade</th>
							</tr>
						</thead>
						<tbody>
							<?php

							for($i = 1; $i<15; $i++)
							{
								$g  = trim(strtoupper($result['Grade'.$i]));
								if(in_array($g, $valid_grades))
								{
									echo '<tr>';
									echo '<td>'.$result['code'.$i].'</td>';
									echo '<td>'.$result['name'.$i].'</td>';
									echo '<td>'.$result['credit'.$i].'</td>';
									echo '<td>'.$result['Grade'.$i].'</td>';
									echo '<tr>';
								}
							}
							?>
						</tbody>


					</table>
					
					<div class="row">
						<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
							<b class="color">Semester Grade Point Average (SGPA)</b>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<?php echo round($result['Sgpa'], 2) ?>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
							<b class="color">Cumulative Grade Point Average (CGPA)</b>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<?php echo round($result['Cgpa'], 2) ?>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
			<br><br>
			<table class="table table-hover">
				<tbody>
					<tr>
						<td> 
							<center>**DISCLAIMER: There could be some slips in the grade calculation, the GRADE REPORT issued by the Academic Section will be final. Also, these Results are meant for Student Information and are not meant to be the GRADE REPORTS
							</center>

						</td>
					</tr>
					<tr>
						<td> 
							<center> <br> <img src="<?php echo base_url('assets/images/logo_wsdc.png') ?>" alt="WSDC" width="80px"><br><br><br> <span class="glyphicon glyphicon-copyright-mark"></span> WEB AND SOFTWARE DEVELOPMENT CELL, NITW</center>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
<?php endif; ?>
