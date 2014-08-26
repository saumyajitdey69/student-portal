<div class="row">
	<!-- <h2 class="text-center">Exit Survey</h2> -->
	<legend class="text-center">Exit Survey</legend>
</div>
<div class="row">
	
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
	<form role="form" id="mainform" class="form form-horizontal" action="<?php echo base_url('audit/exit_feedback/submit_feedback');?>" method="post">
		<div class="row">
			<div class="col-md-12">
				<!-- <p class="text-primary lead">About You</p> -->
			</div>
		</div>
		<div class="row about_div">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<legend><small>1. Degree Details </small></legend>
				<div class="form-group">
					<label for="" class="control-label col-sm-4">Program</label>
					<div class="col-md-8">
						<select name="degree" id="degree" class="form-control input-sm" required>
							<option value="">Select option</option>
							<option value="B.Tech">B.Tech</option>
							<option value="M.Tech">M.Tech</option>
							<option value="MCA">MCA</option>
							<option value="MBA">MBA</option>
							<option value="MSc">MSc</option>
						</select>
					</div>
					<!-- <input required type="text" class="form-control input-sm" id="degree" name="degree"> -->
				</div>		
				<div class="form-group">
					<label for="" class="control-label col-sm-4">Department</label>
					<div class="col-md-8">
						<select name="department" class="form-control input-sm" required>
							<option value="">Select Department</option>
							<option value="1">Civil Engineering</option>
							<option value="2">Electrical Engineering</option>
							<option value="3">Mechanical Engineering</option>
							<option value="4">Electronics &amp; communication Engineering</option>
							<option value="5">Metallurgical &amp; Materials Engineering</option>
							<option value="6">Chemical Engineering</option>
							<option value="7">Computer Science And Engineering</option>
							<option value="8">Biotechnology</option>
							<option value="9">Physics</option>
							<option value="10">Chemistry</option>
							<option value="11">Mathematics</option>
							<option value="12">Humanities &amp; Social Science</option>
							<option value="13">Physical Education</option>
							<option value="14">School of Management</option>
						</select></div>
						<!-- <input required type="text" class="form-control input-sm" name="department"> -->

					</div>
					<div class="form-group">
						<label for="" class="control-label col-sm-4">Specialization</label>
						<div class="col-md-8">
							<!-- <input required type="text" class="form-control input-sm" name="specialization"> -->
							<select name="specialization" class="form-control input-sm" required>
								<option value="">Select one</option>
								<option value="1">BACHELOR OF TECHNOLOGY</option>
								<option value="2">MASTER OF TECHNOLOGY - TRANSPORTATION ENGINEERING</option>
								<option value="3">MASTER OF TECHNOLOGY - REMOTE SENSING AND GIS</option>
								<option value="4">MASTER OF TECHNOLOGY - GEOTECHNICAL ENGINEERING</option>
								<option value="5">MASTER OF TECHNOLOGY - ENGINEERING STRUCTURES</option>
								<option value="6">MASTER OF TECHNOLOGY - ENVIRONMENTAL ENGINEERING</option>
								<option value="7">MASTER OF TECHNOLOGY - CONSTRUCTION TECHNOLOGY AND MGMT</option>
								<option value="8">MASTER OF TECHNOLOGY - WATER RESOURCES ENGINEERING</option>
								<option value="9">MASTER OF TECHNOLOGY - POWER ELECTRONICS AND DRIVES</option>
								<option value="10">MASTER OF TECHNOLOGY - POWER SYSTEMS ENGINEERING</option>
								<option value="11">MASTER OF TECHNOLOGY - THERMAL ENGINEERING</option>
								<option value="12">MASTER OF TECHNOLOGY - MANUFACTURING ENGINEERING</option>
								<option value="13">MASTER OF TECHNOLOGY - COMPUTER INTEGRATED MANUFACTURING</option>
								<option value="14">MASTER OF TECHNOLOGY - PRODUCT DESIGN AND DEVELOPMENT</option>
								<option value="15">MASTER OF TECHNOLOGY - AUTOMOBILE ENGINEERING</option>
								<option value="16">MASTER OF TECHNOLOGY - ELECTRONIC INSTRUMENTATION</option>
								<option value="17">MASTER OF TECHNOLOGY - VLSI SYSTEM DESIGN</option>
								<option value="18">MASTER OF TECHNOLOGY - ADVANCED COMMUNICATION SYSTEMS</option>
								<option value="19">MASTER OF TECHNOLOGY - MATERIALS  TECHNOLOGY</option>
								<option value="20">MASTER OF TECHNOLOGY - INDUSTRIAL METALLURGY</option>
								<option value="21">MASTER OF TECHNOLOGY - COMPUTER AIDED PROCESS AND EQUIPMENT DESIGN</option>
								<option value="22">MASTER OF TECHNOLOGY - COMPUTER SCIENCE &amp; ENGG</option>
								<option value="23">MASTER OF TECHNOLOGY - INFORMATION SECURITY</option>
								<option value="70">MASTER OF TECHNOLOGY - MATERIALS AND SYSTEM ENGINEERING DESIGN</option>
								<option value="24">M.SC.(CHEMISTRY) MMCA</option>
								<option value="25">M.SC.(CHEMISTRY) DDPP</option>
								<option value="26">M.SC. APPLIED MATHEMATICS</option>
								<option value="27">M.SC. MATHEMATICS AND SCIENTIFIC COMPUTING</option>
								<option value="28">M.SC. (TECH) ENGINEERING PHYSICS</option>
								<option value="29">M.SC(TECH) ELECTRONICS</option>
								<option value="30">M.SC (TECH) PHOTONICS</option>
								<option value="31">M.SC. (TECH) INSTRUMENTATION</option>
								<option value="32">MASTER OF COMPUTER APPLICATIONS</option>
								<option value="33">MASTER OF BUSINESS MANAGEMENT</option>
								<option value="65">MASTER OF TECHNOLOGY</option>
								<option value="66">MASTER OF SCIENCE</option>
							</select>
						</div>

					</div>	
					<legend><small>2. What is your CGPA at the end of the pre-final semester?</small></legend>
					<div class="form-group">
						<label for="" class="control-label col-sm-4"></label>
						<div class="col-md-8"><input required type="text" pattern="[0-9]+|([0-9]+[.][0-9]+)" class="form-control input-sm" name="cgpa"></div>

					</div>
					<legend><small>3. The highest level of education completed by your parents/guardian</small></legend>
					<div class="form-group">
						<label for="" class="control-label col-sm-4">Mother</label>
						<div class="col-md-8"><input type="text" class="form-control input-sm" name="level_edu_mother"></div>

					</div>	
					<div class="form-group">
						<label for="" class="control-label col-sm-4">Father</label>
						<div class="col-md-8"><input type="text" class="form-control input-sm" name="level_edu_father"></div>

					</div>	
					<div class="form-group">
						<label for="" class="control-label col-sm-4">Guardian</label>
						<div class="col-md-8"><input type="text" class="form-control input-sm" name="level_edu_guardian" ></div>

					</div>	


				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="well well-sm">
						<h4 class="">
							Dear Graduands!
						</h4>
						<blockquote>
							<p class="text-justify">Your considered comprehensive feedback on the program, facilities, faculty, staff and the Institute will be of great value to the Department concerned as well as the Institute to enhance the quality of learning. You can be assured of the confidentiality of your feedback.</p>
							<footer>DIRECTOR</footer>
						</blockquote>
					</div>
				</div>

			</div>
			<table class="table table-condensed table-hover about_details">
				<thead>
					<tr>
						<td>

						</td>
						<td class="col-md-2 col-sm-3 col-xs-3"></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							4. Which of the following best describes your social class
						</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="social_class" tabindex="-1" required id="t1">
									<option value="">Select Option</option>
									<option value="5">Wealthy</option>
									<option value="4">Upper Middle Class</option>
									<option value="3">Middle Class </option>
									<option value="2">Lower middle class</option>
									<option value="1">Low income/poor</option>
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>
							5. Did you ever receive any warning/punishment for any act of indiscipline: 
						</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="punishment" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="1">Yes</option>
									<option value="0">No</option>
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>
							6. Were you an elected/nominated representative of any recognized student association/ club/council?
						</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="nominated" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="1">Yes</option>
									<option value="0">No</option>
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>7. How often you go for partying in the campus?</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="party_in" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="5">Very Often</option>
									<option value="4">Frequently</option>
									<option value="3">Occassionally</option>
									<option value="2">Rarely</option>
									<option value="1">Never</option>
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>8. How often you go for partying outside the campus? (5-Very often  to 1-Never)</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="party_out" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="5">Very Often</option>
									<option value="4">Frequently</option>
									<option value="3">Occassionally</option>
									<option value="2">Rarely</option>
									<option value="1">Never</option>

								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>9. Thinking back over the last four years, on how many occasions, if any, have you had alcoholic drinks? (5-Very often  to 1-Never)</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="drinks" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="5">Very Often</option>
									<option value="4">Frequently</option>
									<option value="3">Occassionally</option>
									<option value="2">Rarely</option>
									<option value="1">Never</option>

								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>10. Is it justified, in your opinion, to ban the usage of motorized vehicles in the campus? Yes / No </td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="ban_vehicles" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="1">Yes</option>
									<option value="0">No</option>
								</select>
							</label>
						</td>
					</tr> 
				</tbody>
			</table>
			<table class="table table-condensed table-hover academics-A">
				<thead>
					<tr>
						<td>
							<font color="#0092C8" size=4><p class="text-primary">Academics at NIT-Warangal:</p></b></font>
						</td>
						<td class="col-md-2 col-sm-3 col-xs-3"></td>
					</tr>

				</thead>
				<tbody>
					<tr>
						<td>
							<font size=4><p>A. Indicate your rating in respect of the following issues:</p></font> 
						</td>
					</tr>
					<tr>
						<td>
							1. Class room ambience and learning experience.
						</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="academicsA[]" tabindex="-1" required id="t2">
									<option value="">Select Option </option>
									<option value="5">Very Satisfied</option>
									<option value="4">Satisfied</option>
									<option value="3">Good</option>
									<option value="2">Bad</option>
									<option value="1">Very Dissatisfied</option>	
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>
							2. Overall quality of instruction.
						</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="academicsA[]" tabindex="-1" required>
									<option value="">Select Option </option>
									<option value="5">Very Satisfied</option>
									<option value="4">Satisfied</option>
									<option value="3">Good</option>
									<option value="2">Bad</option>
									<option value="1">Very Dissatisfied</option>	
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>
							3. Usefulness and availability of texts and course materials. 
						</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="academicsA[]" tabindex="-1" required>
									<option value="">Select Option </option>
									<option value="5">Very Satisfied</option>
									<option value="4">Satisfied</option>
									<option value="3">Good</option>
									<option value="2">Bad</option>
									<option value="1">Very Dissatisfied</option>	
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>
							4. Content and structure of the program 
						</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="academicsA[]" tabindex="-1" required>
									<option value="">Select Option </option>
									<option value="5">Very Satisfied</option>
									<option value="4">Satisfied</option>
									<option value="3">Good</option>
									<option value="2">Bad</option>
									<option value="1">Very Dissatisfied</option>	
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>
							5. Access and willingness of faculty to interact outside class.
						</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="academicsA[]" tabindex="-1" required>
									<option value="">Select Option </option>
									<option value="5">Very Satisfied</option>
									<option value="4">Satisfied</option>
									<option value="3">Good</option>
									<option value="2">Bad</option>
									<option value="1">Very Dissatisfied</option>	
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>
							6. Overall quality of assistance provided by the department 
						</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="academicsA[]" tabindex="-1" required>
									<option value="">Select Option </option>
									<option value="5">Very Satisfied</option>
									<option value="4">Satisfied</option>
									<option value="3">Good</option>
									<option value="2">Bad</option>
									<option value="1">Very Dissatisfied</option>	
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>
							7. Opportunities for useful non-classroom experiences 
						</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="academicsA[]" tabindex="-1" required>
									<option value="">Select Option </option>
									<option value="5">Very Satisfied</option>
									<option value="4">Satisfied</option>
									<option value="3">Good</option>
									<option value="2">Bad</option>
									<option value="1">Very Dissatisfied</option>	
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>
							8. Quality of facilities and equipments
						</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="academicsA[]" tabindex="-1" required>
									<option value="">Select Option </option>
									<option value="5">Very Satisfied</option>
									<option value="4">Satisfied</option>
									<option value="3">Good</option>
									<option value="2">Bad</option>
									<option value="1">Very Dissatisfied</option>	
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>
							9. Competence in the chosen field of study 
						</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="academicsA[]" tabindex="-1" required>
									<option value="">Select Option </option>
									<option value="5">Very Satisfied</option>
									<option value="4">Satisfied</option>
									<option value="3">Good</option>
									<option value="2">Bad</option>
									<option value="1">Very Dissatisfied</option>	
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>
							10. Application of theoretical knowledge to practical situations. 
						</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="academicsA[]" tabindex="-1" required>
									<option value="">Select Option </option>
									<option value="5">Very Satisfied</option>
									<option value="4">Satisfied</option>
									<option value="3">Good</option>
									<option value="2">Bad</option>
									<option value="1">Very Dissatisfied</option>	
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>
							11. Written communication skills
						</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="academicsA[]" tabindex="-1" required>
									<option value="">Select Option </option>
									<option value="5">Very Satisfied</option>
									<option value="4">Satisfied</option>
									<option value="3">Good</option>
									<option value="2">Bad</option>
									<option value="1">Very Dissatisfied</option>	
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>
							12. Oral communication skills
						</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="academicsA[]" tabindex="-1" required>
									<option value="">Select Option </option>
									<option value="5">Very Satisfied</option>
									<option value="4">Satisfied</option>
									<option value="3">Good</option>
									<option value="2">Bad</option>
									<option value="1">Very Dissatisfied</option>	
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>
							13. Critical thinking skills 
						</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="academicsA[]" tabindex="-1" required>
									<option value="">Select Option </option>
									<option value="5">Very Satisfied</option>
									<option value="4">Satisfied</option>
									<option value="3">Good</option>
									<option value="2">Bad</option>
									<option value="1">Very Dissatisfied</option>	
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>
							14. Quantitative reasoning skills 
						</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="academicsA[]" tabindex="-1" required>
									<option value="">Select Option </option>
									<option value="5">Very Satisfied</option>
									<option value="4">Satisfied</option>
									<option value="3">Good</option>
									<option value="2">Bad</option>
									<option value="1">Very Dissatisfied</option>	
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>
							15. Leadership qualities
						</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="academicsA[]" tabindex="-1" required>
									<option value="">Select Option </option>
									<option value="5">Very Satisfied</option>
									<option value="4">Satisfied</option>
									<option value="3">Good</option>
									<option value="2">Bad</option>
									<option value="1">Very Dissatisfied</option>	
								</select>
							</label>
						</td>
					</tr>
				</tbody>
			</table>

			<table class="table table-condensed table-hover academics-B">
				<thead>
					<tr>
						<td><font size="4"><p>B. During your study, how often have you done each of the 
							following?    </p></font></td>
							<td class="col-md-2 col-sm-3 col-xs-3"></td>
						</tr>

					</thead>

					<tbody>
						<tr>
							<td>1. Worked on a class assignment, project, or presentation with other students </td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="academicsB[]" tabindex="-1" required id="t3">
										<option value="">Select Option</option>
										<option value="5">Very Often</option>
										<option value="4">Frequently</option>
										<option value="3">Occassionally</option>
										<option value="2">Rarely</option>
										<option value="1">Never</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>2. Participated in class discussions     </td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="academicsB[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Often</option>
										<option value="4">Frequently</option>
										<option value="3">Occassionally</option>
										<option value="2">Rarely</option>
										<option value="1">Never</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>3. Made a formal presentation in a class     </td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="academicsB[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Often</option>
										<option value="4">Frequently</option>
										<option value="3">Occassionally</option>
										<option value="2">Rarely</option>
										<option value="1">Never</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>4. Discussed intellectual ideas with other students </td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="academicsB[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Often</option>
										<option value="4">Frequently</option>
										<option value="3">Occassionally</option>
										<option value="2">Rarely</option>
										<option value="1">Never</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>5. Worked on a paper or project that required integrating ideas or information from various sources </td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="academicsB[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Often</option>
										<option value="4">Frequently</option>
										<option value="3">Occassionally</option>
										<option value="2">Rarely</option>
										<option value="1">Never</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>6. Prepared a major technical report/research paper     </td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="academicsB[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Often</option>
										<option value="4">Frequently</option>
										<option value="3">Occassionally</option>
										<option value="2">Rarely</option>
										<option value="1">Never</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>7. Read scientific articles on topics outside the curriculum</td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="academicsB[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Often</option>
										<option value="4">Frequently</option>
										<option value="3">Occassionally</option>
										<option value="2">Rarely</option>
										<option value="1">Never</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>8. Worked with a faculty member on a research project either for credit/non-credit     </td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="academicsB[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Often</option>
										<option value="4">Frequently</option>
										<option value="3">Occassionally</option>
										<option value="2">Rarely</option>
										<option value="1">Never</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>9. Discussed academic and career plans with a faculty member     </td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="academicsB[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Often</option>
										<option value="4">Frequently</option>
										<option value="3">Occassionally</option>
										<option value="2">Rarely</option>
										<option value="1">Never</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>10. Interacted with a faculty member at a social event     </td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="academicsB[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Often</option>
										<option value="4">Frequently</option>
										<option value="3">Occassionally</option>
										<option value="2">Rarely</option>
										<option value="1">Never</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>11. Found and shared interesting and useful topics while browsing in the library     </td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="academicsB[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Often</option>
										<option value="4">Frequently</option>
										<option value="3">Occassionally</option>
										<option value="2">Rarely</option>
										<option value="1">Never</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>12. Used the library as a quiet place to read or study    </td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="academicsB[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Often</option>
										<option value="4">Frequently</option>
										<option value="3">Occassionally</option>
										<option value="2">Rarely</option>
										<option value="1">Never</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>13. Worked with others on a group assignment/project/seminar/presentation</td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="academicsB[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Often</option>
										<option value="4">Frequently</option>
										<option value="3">Occassionally</option>
										<option value="2">Rarely</option>
										<option value="1">Never</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>14. Attended a lecture, conference, symposium or any event not required by a course</td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="academicsB[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Often</option>
										<option value="4">Frequently</option>
										<option value="3">Occassionally</option>
										<option value="2">Rarely</option>
										<option value="1">Never</option>

									</select>
								</label>
							</td>
						</tr>
					</tbody>
				</table>

				<table class="table table-condensed table-hover academics-C">
					<thead>
						<tr>
							<td>
								<font size=4><p>C. During the course of your study, how much has your coursework emphasized the following mental activities?</p> </font>
							</td>	
							<td class="col-md-2 col-sm-3 col-xs-3">

							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1. Memorize facts, ideas or methods from your courses and readings so you can repeat them in pretty much the same form. </td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="academicsC[]" tabindex="-1" required id="t4">
										<option value="">Select Option </option>
										<option value="5">Extremely</option>
										<option value="4">Better</option>
										<option value="3">Good</option>
										<option value="2">Low</option>
										<option value="1">Very Low</option>	
									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>2. Analyze the basic elements of an idea, experience, or theory, such as examining a particular case or situation.  </td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="academicsC[]" tabindex="-1" required>
										<option value="">Select Option </option>
										<option value="5">Extremely</option>
										<option value="4">Better</option>
										<option value="3">Good</option>
										<option value="2">Low</option>
										<option value="1">Very Low</option>	
									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>3. Synthesize and organize ideas, information, or experiences into new, more complex interpretations and relationships.  </td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="academicsC[]" tabindex="-1" required>
										<option value="">Select Option </option>
										<option value="5">Extremely</option>
										<option value="4">Better</option>
										<option value="3">Good</option>
										<option value="2">Low</option>
										<option value="1">Very Low</option>	
									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>4. Apply theories or concepts to practical problems or in new situations.</td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="academicsC[]" tabindex="-1" required>
										<option value="">Select Option </option>
										<option value="5">Extremely</option>
										<option value="4">Better</option>
										<option value="3">Good</option>
										<option value="2">Low</option>
										<option value="1">Very Low</option>	
									</select>
								</label>
							</td>
						</tr>
					</tbody>
				</table>

				<table class="table table-condensed table-hover experiences_div">
					<thead>
						<tr>
							<td>
								<font size="3"><p>A. How satisfied are you with the following facilities:</p>

								</td>	
								<td class="col-md-2 col-sm-3 col-xs-3">

								</td>
							</tr>

						</thead>
						<tbody>
							<tr>
								<td>1. Institute website</td>
								<td>
									<label>
										<select class="form-control select-row input-sm select-row"  name="experiences[]" tabindex="-1" required id="t5">
											<option value="">Select Option</option>
											<option value="5">Very Satisified</option>
											<option value="4">Satisfied</option>
											<option value="3">Good</option>
											<option value="2">Bad</option>
											<option value="1">Very Dissatisfied</option>

										</select>
									</label>
								</td>
							</tr>
							<tr>
								<td>2. Training &amp; Placement section </td>
								<td>
									<label>
										<select class="form-control select-row input-sm select-row"  name="experiences[]" tabindex="-1" required>
											<option value="">Select Option</option>
											<option value="5">Very Satisified</option>
											<option value="4">Satisfied</option>
											<option value="3">Good</option>
											<option value="2">Bad</option>
											<option value="1">Very Dissatisfied</option>

										</select>
									</label>
								</td>
							</tr>
							<tr>
								<td>3. Library </td>
								<td>
									<label>
										<select class="form-control select-row input-sm select-row"  name="experiences[]" tabindex="-1" required>
											<option value="">Select Option</option>
											<option value="5">Very Satisified</option>
											<option value="4">Satisfied</option>
											<option value="3">Good</option>
											<option value="2">Bad</option>
											<option value="1">Very Dissatisfied</option>

										</select>
									</label>
								</td>
							</tr>
							<tr>
								<td>4. Computer Centre</td>
								<td>
									<label>
										<select class="form-control select-row input-sm select-row"  name="experiences[]" tabindex="-1" required>
											<option value="">Select Option</option>
											<option value="5">Very Satisified</option>
											<option value="4">Satisfied</option>
											<option value="3">Good</option>
											<option value="2">Bad</option>
											<option value="1">Very Dissatisfied</option>

										</select>
									</label>
								</td>
							</tr>
							<tr>
								<td>5. Sports and Games facilities</td>
								<td>
									<label>
										<select class="form-control select-row input-sm select-row"  name="experiences[]" tabindex="-1" required>
											<option value="">Select Option</option>
											<option value="5">Very Satisified</option>
											<option value="4">Satisfied</option>
											<option value="3">Good</option>
											<option value="2">Bad</option>
											<option value="1">Very Dissatisfied</option>

										</select>
									</label>
								</td>
							</tr>
							<tr>
								<td>6. Campus upkeep and maintenance</td>
								<td>
									<label>
										<select class="form-control select-row input-sm select-row"  name="experiences[]" tabindex="-1" required>
											<option value="">Select Option</option>
											<option value="5">Very Satisified</option>
											<option value="4">Satisfied</option>
											<option value="3">Good</option>
											<option value="2">Bad</option>
											<option value="1">Very Dissatisfied</option>

										</select>
									</label>
								</td>
							</tr>
							<tr>
								<td>7. Medical facilities and ambulance service</td>
								<td>
									<label>
										<select class="form-control select-row input-sm select-row"  name="experiences[]" tabindex="-1" required>
											<option value="">Select Option</option>
											<option value="5">Very Satisified</option>
											<option value="4">Satisfied</option>
											<option value="3">Good</option>
											<option value="2">Bad</option>
											<option value="1">Very Dissatisfied</option>

										</select>
									</label>
								</td>
							</tr>
							<tr>
								<td>8. Hostel accommodation and upkeep</td>
								<td>
									<label>
										<select class="form-control select-row input-sm select-row"  name="experiences[]" tabindex="-1" required>
											<option value="">Select Option</option>
											<option value="5">Very Satisified</option>
											<option value="4">Satisfied</option>
											<option value="3">Good</option>
											<option value="2">Bad</option>
											<option value="1">Very Dissatisfied</option>

										</select>
									</label>
								</td>
							</tr>
							<tr>
								<td>9. Quality of food in the messes</td>
								<td>
									<label>
										<select class="form-control select-row input-sm select-row"  name="experiences[]" tabindex="-1" required>
											<option value="">Select Option</option>
											<option value="5">Very Satisified</option>
											<option value="4">Satisfied</option>
											<option value="3">Good</option>
											<option value="2">Bad</option>
											<option value="1">Very Dissatisfied</option>

										</select>
									</label>
								</td>
							</tr>
							<tr>
								<td>10. Coffee shops and Canteen facilities</td>
								<td>
									<label>
										<select class="form-control select-row input-sm select-row"  name="experiences[]" tabindex="-1" required>
											<option value="">Select Option</option>
											<option value="5">Very Satisified</option>
											<option value="4">Satisfied</option>
											<option value="3">Good</option>
											<option value="2">Bad</option>
											<option value="1">Very Dissatisfied</option>

										</select>
									</label>
								</td>
							</tr>
							<tr>
								<td>11. Guest House facilities for the parents</td>
								<td>
									<label>
										<select class="form-control select-row input-sm select-row"  name="experiences[]" tabindex="-1" required>
											<option value="">Select Option</option>
											<option value="5">Very Satisified</option>
											<option value="4">Satisfied</option>
											<option value="3">Good</option>
											<option value="2">Bad</option>
											<option value="1">Very Dissatisfied</option>

										</select>
									</label>
								</td>
							</tr>
							<tr>
								<td>12. Administration’s responsiveness to student needs</td>
								<td>
									<label>
										<select class="form-control select-row input-sm select-row"  name="experiences[]" tabindex="-1" required>
											<option value="">Select Option</option>
											<option value="5">Very Satisified</option>
											<option value="4">Satisfied</option>
											<option value="3">Good</option>
											<option value="2">Bad</option>
											<option value="1">Very Dissatisfied</option>

										</select>
									</label>
								</td>
							</tr>
						</tbody>
					</tbody>
				</table>

				<table class="table table-condensed table table-hover goals_div">
					<thead>
						<tr>
							<td>
								<font color="#0092C8" size=4><p class="text-primary"> Goals Acheived</p></b></font>
							</td>
							<td class="col-md-2 col-sm-3 col-xs-3">

							</td>	

						</tr>


					</thead>
					<tbody>
						<tr>
							<td>
								<font size="3"><p>A. For items below, rate the extent to which NIT Warangal’s education program prepared you to:</p></font>
							</td>
						</tr>

						<tr>
							<td>
								1. Foster positive interaction with colleagues/faculty in support of student learning and well-being. 
							</td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="goals[]" tabindex="-1" required id="t6">
										<option value="">Select Option</option>
										<option value="5">Very Satisified</option>
										<option value="4">Satisfied</option>
										<option value="3">Good</option>
										<option value="2">Bad</option>
										<option value="1">Very Dissatisfied</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								2. Create learning environment that encourage positive social interaction, and active engagement in learning.
							</td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="goals[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Satisified</option>
										<option value="4">Satisfied</option>
										<option value="3">Good</option>
										<option value="2">Bad</option>
										<option value="1">Very Dissatisfied</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								3. Understand the central concepts of the subject matter 
							</td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="goals[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Satisified</option>
										<option value="4">Satisfied</option>
										<option value="3">Good</option>
										<option value="2">Bad</option>
										<option value="1">Very Dissatisfied</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								4. Provide learning opportunities that support students’ intellectual, social and physical development. 
							</td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="goals[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Satisified</option>
										<option value="4">Satisfied</option>
										<option value="3">Good</option>
										<option value="2">Bad</option>
										<option value="1">Very Dissatisfied</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								5. Develop critical thinking, problem solving, and soft skills. 
							</td>  
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="goals[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Satisified</option>
										<option value="4">Satisfied</option>
										<option value="3">Good</option>
										<option value="2">Bad</option>
										<option value="1">Very Dissatisfied</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								6. Present subject matter in a clear and meaningful way
							</td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="goals[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Satisified</option>
										<option value="4">Satisfied</option>
										<option value="3">Good</option>
										<option value="2">Bad</option>
										<option value="1">Very Dissatisfied</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								7. Understand the process of continuous and life-long learning 
							</td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="goals[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Satisified</option>
										<option value="4">Satisfied</option>
										<option value="3">Good</option>
										<option value="2">Bad</option>
										<option value="1">Very Dissatisfied</option>

									</select>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								8. Actively seek opportunities for continuous professional growth
							</td>
							<td>
								<label>
									<select class="form-control select-row input-sm select-row"  name="goals[]" tabindex="-1" required>
										<option value="">Select Option</option>
										<option value="5">Very Satisified</option>
										<option value="4">Satisfied</option>
										<option value="3">Good</option>
										<option value="2">Bad</option>
										<option value="1">Very Dissatisfied</option>

									</select>
								</label>
							</td>
						</tr>
					</tbody>
				</table>

				<table class="table table-condensed table-hover extra_curricular_div">

					<thead>
						<tr>
							<td>
								<font color="#0092C8" size=4><p class="text-primary"> Extra-Curricular activities</p></b></font>
							</td>
							<td class="col-md-2 col-sm-3 col-xs-3"></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<font size="4"><p>
									A. How frequently you have participated in the following extra-curricular and free-time activities during your stay at NIT Warangal
								</p>
							</font>	
						</td>
					</tr>

					<tr>
						<td>1. Participating in Intercollegiate sports &amp; games</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="extra-curricular[]" tabindex="-1" required id="t7">
									<option value="">Select Option</option>
									<option value="5">Very Often</option>
									<option value="4">Frequently</option>
									<option value="3">Occassionally</option>
									<option value="2">Rarely</option>
									<option value="1">Never</option>

								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>2. Playing on intramural sports events </td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="extra-curricular[]" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="5">Very Often</option>
									<option value="4">Frequently</option>
									<option value="3">Occassionally</option>
									<option value="2">Rarely</option>
									<option value="1">Never</option>

								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>3. Exercising for fitness </td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="extra-curricular[]" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="5">Very Often</option>
									<option value="4">Frequently</option>
									<option value="3">Occassionally</option>
									<option value="2">Rarely</option>
									<option value="1">Never</option>

								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>4. Competing informally on a team or sport </td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="extra-curricular[]" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="5">Very Often</option>
									<option value="4">Frequently</option>
									<option value="3">Occassionally</option>
									<option value="2">Rarely</option>
									<option value="1">Never</option>

								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>5. Participating in student government           </td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="extra-curricular[]" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="5">Very Often</option>
									<option value="4">Frequently</option>
									<option value="3">Occassionally</option>
									<option value="2">Rarely</option>
									<option value="1">Never</option>

								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>6. Participating in student club activities</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="extra-curricular[]" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="5">Very Often</option>
									<option value="4">Frequently</option>
									<option value="3">Occassionally</option>
									<option value="2">Rarely</option>
									<option value="1">Never</option>

								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>7. Participating in Spring Spree/Technozion /Association activities</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="extra-curricular[]" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="5">Very Often</option>
									<option value="4">Frequently</option>
									<option value="3">Occassionally</option>
									<option value="2">Rarely</option>
									<option value="1">Never</option>

								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>8. Volunteering in the community         </td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="extra-curricular[]" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="5">Very Often</option>
									<option value="4">Frequently</option>
									<option value="3">Occassionally</option>
									<option value="2">Rarely</option>
									<option value="1">Never</option>

								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>9. Socializing with friends           </td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="extra-curricular[]" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="5">Very Often</option>
									<option value="4">Frequently</option>
									<option value="3">Occassionally</option>
									<option value="2">Rarely</option>
									<option value="1">Never</option>

								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>10. Watching TV           </td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="extra-curricular[]" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="5">Very Often</option>
									<option value="4">Frequently</option>
									<option value="3">Occassionally</option>
									<option value="2">Rarely</option>
									<option value="1">Never</option>

								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>11. Social networking and surfing the net</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="extra-curricular[]" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="5">Very Often</option>
									<option value="4">Frequently</option>
									<option value="3">Occassionally</option>
									<option value="2">Rarely</option>
									<option value="1">Never</option>

								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>12. Playing video games </td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="extra-curricular[]" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="5">Very Often</option>
									<option value="4">Frequently</option>
									<option value="3">Occassionally</option>
									<option value="2">Rarely</option>
									<option value="1">Never</option>

								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>13. Reading literary articles           </td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="extra-curricular[]" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="5">Very Often</option>
									<option value="4">Frequently</option>
									<option value="3">Occassionally</option>
									<option value="2">Rarely</option>
									<option value="1">Never</option>

								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>14. Relaxing by yourself</td>
						<td>
							<label>
								<select class="form-control select-row input-sm select-row"  name="extra-curricular[]" tabindex="-1" required>
									<option value="">Select Option</option>
									<option value="5">Very Often</option>
									<option value="4">Frequently</option>
									<option value="3">Occassionally</option>
									<option value="2">Rarely</option>
									<option value="1">Never</option>

								</select>
							</label>
						</td>
					</tr> 
				</tbody>
			</table>

			<table class="table table-condensed table-hover changes_div">
				<thead>
					<tr>
						<td>
							<font color="#0092C8" size=4><p class="text-primary">The Changes </p></b></font>
						</td>
						<td class="col-md-2 col-sm-3 col-xs-3">

						</td>
					</tr> 

				</thead>
				<tbody>
					<tr>
						<td colspan="2"><font size="4"><p>
							A. The list below contains some of the abilities and skills that may be developed as part of education at NIT Warangal. Please indicate how your ability has changed since you first enrolled at this Institute. (Stronger now-5 to Weaker now-1)

						</p></td>
					</font>
				</tr>
				<tr>
					<td>1. Write effectively     </td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required id="t8">
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>2. Communicate well orally     </td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>3. Acquire new skills and knowledge on my own    </td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>4. Think analytically and logically     </td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>5. Formulate/create original ideas and solutions     </td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>6. Evaluate and choose between alternative courses of action     </td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>7. Lead and supervise tasks and groups of people     </td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>8. Relate well to people of different races, nations, and religions </td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>9. Function effectively as a member of a team     </td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>10. Moral and ethical values</td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>11. Understand myself: abilities, interests, limitations, personality     </td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>12. Function independently     </td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>13. Gain in-depth knowledge of a field  </td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>14. Plan and execute complex projects     </td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>15. Appreciate art, literature, music, drama     </td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>16. Develop an awareness for social problems     </td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>17. Develop self-esteem/self-confidence     </td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>18. Resolve interpersonal conflicts positively     </td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>19. Synthesize and integrate ideas and information     </td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr>
				<tr>
					<td>20. Prepare for a career</td>
					<td>
						<label>
							<select class="form-control select-row input-sm select-row"  name="changes[]" tabindex="-1" required>
								<option value="">Select Option </option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>	
							</select>
						</label>
					</td>
				</tr> 
			</tbody>
		</table>
		<table class="table table-condensed table-hover overall-A"> 
			<thead>
				<tr>
					<td>
						<font color="#0092C8" size=4><p class="text-primary">Overall Remarks</p></b></font>

					</td>		
					<td class="col-md-2 col-sm-3 col-xs-3"></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><font size="3">
						<p>
							A. How satisfied are you with the following aspects of your experience at NIT Warangal 
						</p>
					</font>
				</td>
			</tr>
			<tr>
				<td>1. Overall quality of instruction</td>
				<td>
					<label>
						<select class="form-control select-row input-sm select-row"  name="overallA[]" tabindex="-1" required id="t9">
							<option value="">Select Option </option>
							<option value="5">Very Satisfied</option>
							<option value="4">Satisfied</option>
							<option value="3">Good</option>
							<option value="2">Bad</option>
							<option value="1">Very Dissatisfied</option>	
						</select>
					</label>
				</td>
			</tr>
			<tr>
				<td>2. Administration’s responsiveness to student concerns:</td>
				<td>
					<label>
						<select class="form-control select-row input-sm select-row"  name="overallA[]" tabindex="-1" required>
							<option value="">Select Option </option>
							<option value="5">Very Satisfied</option>
							<option value="4">Satisfied</option>
							<option value="3">Good</option>
							<option value="2">Bad</option>
							<option value="1">Very Dissatisfied</option>	
						</select>
					</label>
				</td>
			</tr>
			<tr>
				<td>3. Social life on Campus:</td>
				<td>
					<label>
						<select class="form-control select-row input-sm select-row"  name="overallA[]" tabindex="-1" required>
							<option value="">Select Option </option>
							<option value="5">Very Satisfied</option>
							<option value="4">Satisfied</option>
							<option value="3">Good</option>
							<option value="2">Bad</option>
							<option value="1">Very Dissatisfied</option>	
						</select>
					</label>
				</td>
			</tr>
			<tr>
				<td>4. Sense of community on campus</td>
				<td>
					<label>
						<select class="form-control select-row input-sm select-row"  name="overallA[]" tabindex="-1" required>
							<option value="">Select Option </option>
							<option value="5">Very Satisfied</option>
							<option value="4">Satisfied</option>
							<option value="3">Good</option>
							<option value="2">Bad</option>
							<option value="1">Very Dissatisfied</option>	
						</select>
					</label>
				</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-condensed table-hover overall-B">
		<thead>
			<tr>
				<td>
					<font size="4"><p>
						B. Indicate how strongly you agree or disagree with each of the following statements. (Agree fully-5 to Do not agree-1)
					</p>
				</font>
			</td>
			<td class="col-md-2 col-sm-3 col-xs-3">

			</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				1. Students are respected here regardless of their economic or social class
			</td>
			<td>
				<label>
					<select class="form-control select-row input-sm select-row"  name="overallB[]" tabindex="-1" required id="t10">
						<option value="">Select Option </option>
						<option value="5">5</option>
						<option value="4">4</option>
						<option value="3">3</option>
						<option value="2">2</option>
						<option value="1">1</option>	
					</select>
				</label>
			</td>
		</tr>
		<tr>
			<td>
				2. Students are respected here regardless of their academic performance
			</td>
			<td>
				<label>
					<select class="form-control select-row input-sm select-row"  name="overallB[]" tabindex="-1" required>
						<option value="">Select Option </option>
						<option value="5">5</option>
						<option value="4">4</option>
						<option value="3">3</option>
						<option value="2">2</option>
						<option value="1">1</option>	
					</select>
				</label>
			</td>
		</tr>
		<tr>
			<td>
				3. Students are respected here regardless of their gender
			</td>
			<td>
				<label>
					<select class="form-control select-row input-sm select-row"  name="overallB[]" tabindex="-1" required>
						<option value="">Select Option </option>
						<option value="5">5</option>
						<option value="4">4</option>
						<option value="3">3</option>
						<option value="2">2</option>
						<option value="1">1</option>	
					</select>
				</label>
			</td>
		</tr>
		<tr>
			<td>
				4. Students are respected here regardless of their region/nation
			</td>
			<td>
				<label>
					<select class="form-control select-row input-sm select-row"  name="overallB[]" tabindex="-1" required>
						<option value="">Select Option </option>
						<option value="5">5</option>
						<option value="4">4</option>
						<option value="3">3</option>
						<option value="2">2</option>
						<option value="1">1</option>	
					</select>
				</label>
			</td>
		</tr>
	</tbody>
</table>
<table class="table table-condensed table-hover overall-C">
	<thead>

		<tr>
			<td>
				<font size="4"><p>C. What is your impression of NITW’s community? (Agree fully-5 to Do not agree-1)
				</p></font>
			</td>
			<td class="col-md-2 col-sm-3 col-xs-3">

			</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				1. Safe
			</td>
			<td>
				<label>
					<select class="form-control select-row input-sm select-row"  name="overallC[]" tabindex="-1" required id="t11">
						<option value="">Select Option </option>
						<option value="5">5</option>
						<option value="4">4</option>
						<option value="3">3</option>
						<option value="2">2</option>
						<option value="1">1</option>	
					</select>
				</label>
			</td>
		</tr>
		<tr>
			<td>
				2. Welcoming
			</td>
			<td>
				<label>
					<select class="form-control select-row input-sm select-row"  name="overallC[]" tabindex="-1" required>
						<option value="">Select Option </option>
						<option value="5">5</option>
						<option value="4">4</option>
						<option value="3">3</option>
						<option value="2">2</option>
						<option value="1">1</option>	
					</select>
				</label>
			</td>
		</tr>
		<tr>
			<td>
				3. Competitive
			</td>
			<td>
				<label>
					<select class="form-control select-row input-sm select-row"  name="overallC[]" tabindex="-1" required>
						<option value="">Select Option </option>
						<option value="5">5</option>
						<option value="4">4</option>
						<option value="3">3</option>
						<option value="2">2</option>
						<option value="1">1</option>	
					</select>
				</label>
			</td>
		</tr>
		<tr>
			<td>
				4. Diverse
			</td>
			<td>
				<label>
					<select class="form-control select-row input-sm select-row"  name="overallC[]" tabindex="-1" required>
						<option value="">Select Option </option>
						<option value="5">5</option>
						<option value="4">4</option>
						<option value="3">3</option>
						<option value="2">2</option>
						<option value="1">1</option>	
					</select>
				</label>
			</td>
		</tr>
	</tbody>
</table>
<button  class="btn btn-block btn-lg btn-success" id="t_submit"> S U B M I T</button>
</form>
</div>
<div class="row" style="height: 100px;">
	
</div>
