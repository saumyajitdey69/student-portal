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

<img src="/faculty/assets/images/banner_print.jpg" alt="header" class="visible-print">
<div class="row">
	<button type = "button" class = "btn btn-success btn-sm hidden-print pull-right" onclick = "javascript:window.print()"><span class="glyphicon glyphicon-print"></span> Print</button>
	<br><br>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<table class = "table table-condensed">
			<tr>
				<td><strong>Roll:</strong></td>
				<td><?php echo $reg_roll; ?></td>
				<td><strong>Name:</strong></td>
				<td><?php echo $reg_name; ?></td>
			</tr>
			<tr>
				<td><strong>Branch:</strong></td>
				<td><?php echo $reg_branch; ?></td>
				<td><strong>Section:</strong></td>
				<td><?php echo $reg_section; ?></td>
			</tr>
			<tr>
				<td><strong>Course:</strong></td>
				<td><?php echo $reg_course; ?></td>
				<td><strong>Semester:</strong></td>
				<td><?php echo $reg_semester; ?></td>
			</tr>
		</table>
		<!-- <strong>Regular Courses</strong> -->
		<table id = "regular_course_table" class="table table-bordered table-condensed">
			<th class='text-center'>#</th>
			<th class='text-center'>Course Code</th>
			<th>Course Title</th>
			<th class='text-center'>Credit</th>
			<th class='text-center'>Type</th>
			<?php 
			$type  = array(
				's' =>"Study" ,
				'e' =>"Exam" ,
				"sb" =>"Study"
				);
		  			//printing out all course detail
			for($i=0; $i<sizeof($regular_courses['reg_course_id']); $i++)
			{
				echo "<tr>";
				echo "<td class='text-center'>";
				echo ($i+1);
				echo "</td>";
				echo "<td class='text-center'>";
				echo $regular_courses['reg_course_id'][$i];
				echo "</td>";
				echo "<td>";
				echo $regular_courses['reg_course_name'][$i];
				echo "</td>";
				echo "<td class='text-center'>";
				echo $regular_courses['reg_course_credit'][$i];
				echo "</td>";
				echo "<td class='text-center'>";
				echo $type[$regular_courses['reg_study_exam'][$i]];
				echo "</td>";
				echo "</tr>";
			}

			?>
		</table>
		<br><br>
		<div style = "<?php if(sizeof($backlog_courses['reg_course_id'])==0) echo 'display:none;'; ?>" >
			<!-- <strong>Backlog courses</strong> -->
			<table  id = "backlog_course_table" class="table table-bordered table-condensed">
				<th class='text-center'>#</th>
				<th class='text-center'>Course Code</th>
				<th>Course Title</th>
				<th class='text-center'>Credit</th>
				<th class='text-center'>Type</th>
				<?php
		  			//printing out all course detail
				for($i=0; $i<sizeof($backlog_courses['reg_course_id']); $i++)
				{
					echo "<tr>";
					echo "<td class='text-center'>";
					echo ($i+1);
					echo "</td>";
					echo "<td class='text-center'>";
					echo $backlog_courses['reg_course_id'][$i];
					echo "</td>";
					echo "<td>";
					echo $backlog_courses['reg_course_name'][$i];
					echo "</td>";
					echo "<td class='text-center'>";
					echo $backlog_courses['reg_course_credit'][$i];
					echo "</td>";
					echo "<td class='text-center'>";
					echo $type[$backlog_courses['reg_study_exam'][$i]];
					echo "</td>";
					echo "</tr>";
				}
				?>
			</table>
		</div>
		<div class="clear-fix"></div>
		<table class="table table-condensed">
			<tbody>
				<tr>
					<td><strong>Total Credits [Study]</strong>:	<?php echo $reg_credits_study; ?></td>
					</tr>
					<tr>
					<td class="text-right"><strong>Total Credits [Study+Exam]</strong>: <?php echo $reg_credits_study_exam; ?></td>
				</tr>
			</tbody>
		</table>
	</form>
	<p><label>Date : </label> <?php  echo date("m-d-y");?></p>
	<p><label>Remarks (if any) : </label></p>
</div>
</div>
<div class="">
	<br><br><br>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left">
		Signature of Student
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
		Signature of Faculty Advisor
	</div>
</div>
<br><br>
<table class="table">
	<tbody>
		<tr>
			<td> 
				<center>**No student will be permitted to the examinations of this semester without the Registration Slip</center>
			</td>
		</tr>
		<tr>
			<td> 
				<center> <br> <img src="<?php echo base_url('assets/images/logo_wsdc.png') ?>" alt="WSDC" width="80px"><br><br><br> <span class="glyphicon glyphicon-copyright-mark"></span> 2014, WEB AND SOFTWARE DEVELOPMENT CELL, NITW</center>
			</td>
		</tr>
	</tbody>
</table>
</div>

