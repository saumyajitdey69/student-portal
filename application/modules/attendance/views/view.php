<div class="alert alert-danger">
	The subjects having total classes as zero are not yet entered by respective faculty.Lab and open elective courses are not included in online attendance.
</div>
<h3 class="text-center">
	Attendance Report
</h3>
<table class="table table-responsive">
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
	</table>
	<?php $type=array('regular'=>'Regular','backlog'=>'Backlog'); 
	foreach ($type as $key => $value) : 
		if(sizeof(${$key.'_courses'}['reg_course_id']) <= 0)
			continue;
	?>
	<p class="lead text-center"><?php echo $value; ?> Subjects</p>
	<table class="table table-bordered table-hover">
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
								echo "danger"; 
							else if($shortage==0) 
								echo "success";
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

