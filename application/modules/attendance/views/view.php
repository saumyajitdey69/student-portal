<div class=" alert alert-warning ">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	The subjects having total classes as <strong>zero (0)</strong> are not yet entered by respective faculty.Lab are excluded from online attendance.
</div>
<!-- <div class="page-header">
  <h3> &nbsp; Attendance Report</h3>
</div> -->
<!-- <table class="table table-responsive table-condensed">
	<tr>
		<th>Roll No:</th>
		<td><?php echo $reg_roll; ?></td>
		<th>Name:</th>
		<td><?php echo $reg_name; ?></td>
	</tr>
	<tr>
		<th>Branch:</th>
		<td><?php echo $reg_branch; ?></td>
		<th>Section:</th>
		<td><?php echo $reg_section=="0" ? "NO" : $reg_section; ?><td>
		</tr>
		<tr>
			<th>Course: </th>
			<td><?php echo $reg_course; ?></td>
			<th>Semester:</th>
			<td><?php echo $reg_semester; ?></td>
		</tr>
	</table> -->
	<?php $type=array('regular'=>'Regular','backlog'=>'Backlog'); 
	foreach ($type as $key => $value) : 
		if(sizeof(${$key.'_courses'}['reg_course_id']) <= 0)
			continue;
	?>
	<legend> &nbsp; Attendace report of <?php echo $value; ?> Subjects</legend>
	<table class="table table-hover table-responsive">
		<thead>
			<tr>
				<th>
					#
				</th>
				<th>
					Course Id
				</th>
				<th>
					Course Name
				</th>
				<th>
					Mode of Study
				</th>
				<th>
					Total Classes
				</th>
				<th>
					Classes Attended
				</th>
				<th>
					Percentage Attendance
				</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			for($i=0; $i<sizeof(${$key.'_courses'}['reg_course_id']); $i++) : ?>
			<?php 
					$shortage=-1;
					switch (${$key.'_courses'}['attendance_details'][$i]['status']) {
						case 0:
							 $att_data='<td>0</td>'.
							 '<td>0</td>'.
							 '<td>NA</td>';
							break;
						case 1 :
							$att_data='<td>0</td>'.
							 '<td>0</td>'.
							 '<td>NA</td>';
							break;
						case 2:
							$Percentage=round(${$key.'_courses'}['attendance_details'][$i]['no_classes_attended']/${$key.'_courses'}['attendance_details'][$i]['no_classes']*100,2);
							$att_data='<td>'.${$key.'_courses'}['attendance_details'][$i]['no_classes'].'</td>'.
								'<td>'.${$key.'_courses'}['attendance_details'][$i]['no_classes_attended'].'</td>'.
							'<td>'.$Percentage.' %</td>';
							if($Percentage < 75)
								$shortage=1;
							else
								$shortage=0;
							break;
						default:
							$att_data='<td>NA</td>'.
							 '<td>NA</td>'.
							 '<td>NA</td>';
							break;
					}
			?>
			<tr class="<?php if($shortage==1) 
								echo "google-attendance-danger"; 
							else if($shortage==0) 
								echo "google-attendance-success";
					 ?>">
				<td><?php echo ($i+1) ?></td>
				<td><?php echo ${$key.'_courses'}['reg_course_id'][$i]; ?></td>
				<td><?php echo(strtoupper(${$key.'_courses'}['reg_course_name'][$i])) ?></td>
				<td>
					<?php 
						switch (${$key.'_courses'}['reg_study_exam'][$i]) {
							case 'e':
								echo "Exam";
								break;
							case 'sb':
								echo "Backlog Study";
							default:
								echo "Study";
								break;
						}
					 ?>
				</td>
				<?php echo $att_data; ?>
					
			</tr>

		<?php endfor;?>
	</tbody>
</table>
<?php endforeach;?>

