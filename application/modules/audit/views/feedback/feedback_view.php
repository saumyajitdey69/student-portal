<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="alert alert-info" id="info_div" style="display:none;">
			<!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
			<span></span>
		</div>
		<div class="alert alert-success" id="info_div_success" style="display:none;">
			<!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
			<span></span>
		</div>

		<ul id="navigation" class="pager" style='display:none'>
			<li class="list"><a href="javascript:void(0)"> <span class="glyphicon glyphicon-list-alt "></span> &nbsp; Show all courses</a ></li>
			<li class="previous"><a href="javascript:void(0)">&larr; Previous </a ></li>
			<li class="next"><a href="javascript:void(0)">Next &rarr;</a ></li>
		</ul>

		<div id="ques_theory"  style="display:none;">
			<table id="feedback_course_details" class="table">
				<tr>
					<th style="font-size:16px;"><span id="course-id"></span> - <span id="course-name"></span></th>
					<th style="text-align: right;font-size:16px;"><span id="faculty-name"></span></th>
				</tr>
			</table>
			<div class='notifications top-right'></div>
			<div class="feedback_course_div">
				<table id="feedback_course" class="table table-hover table-condensed">
					<tr>
						<td><font color="#0092C8" size=4><p class="text-primary">The Course</p></b></font></td>
						<td class="col-md-2"></td>

					</tr>
					<tr>
						<td>The course outcomes were clearly stated.</td>
						<td>
							<label>
								<select class="form-control input-sm select-row"  name="q[]" id="t1" tabindex="-1">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>Do you feel course outcomes were accomplished ?</td>
						<td>
							<label>
								<select class="form-control input-sm select-row"  name="q[]" id="t2" tabindex="-1">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>


					<tr>
						<td>The assigned reading material was helpful in meeting the course outcomes and adequate number of text books are available.</td>
						<td>
							<label>
								<select class="form-control input-sm select-row"  name="q[]" id="t3"  tabindex="-1">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>Was there agreement between announced course outcomes and what was taught ?</td>
						<td>
							<label>
								<select class="form-control input-sm select-row"  name="q[]" id="t4" tabindex="-1">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>
							The course content was just right for the defined outcomes.
						</td>
						<td>
							<label>
								<select class="form-control input-sm select-row"  name="q[]" id="t5" tabindex="-1">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>The course was well organized.</td>
						<td>
							<label>
								<select class="form-control input-sm select-row"  name="q[]" id="t6" tabindex="-1">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>Reasonable amount of work had to be put in for the course outside the class room.</td>
						<td>
							<label>
								<select class="form-control input-sm select-row"  name="q[]" id="t7" tabindex="-1">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>The class room sessions (lectures, discussions) and reading material worked well to compliment one another.</td>
						<td>
							<label>
								<select class="form-control input-sm select-row"  name="q[]" id="t8" tabindex="-1">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>

					</tr>

					<tr>
						<td>Did this course improve your understanding of concepts and principles ?</td>
						<td>
							<label>
								<select class="form-control input-sm select-row"  name="q[]" id="t9" tabindex="-1">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>The course helped improve my problem solving abilities.</td>
						<td>
							<label>
								<select class="form-control input-sm select-row"  name="q[]" id="t10" tabindex="-1">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>The course provided a stimulating atmosphere for critical and independent thinking ?</td>
						<td>
							<label>
								<select class="form-control input-sm select-row"  name="q[]" id="t11" tabindex="-1">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>Attending the classes to understand the subject matter is essential ?</td>
						<td>
							<label>
								<select class="form-control input-sm select-row"  name="q[]" id="t12" tabindex="-1">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>The course content was relevant to the major field of study.</td>
						<td>
							<label>
								<select class="form-control input-sm select-row"  name="q[]" id="t13" tabindex="-1">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>The examinations reflected important aspects in the course.</td>
						<td>
							<label>
								<select class="form-control input-sm select-row"  name="q[]" id="t14" tabindex="-1">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>Overall rating of the course.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row"  name="q[]" id="t15" tabindex="-1">
									<option value="0"> Select Option </option>
									<option value="1">Poor</option>
									<option value="2">Fair</option>
									<option value="3">Good</option>
									<option value="4">Very Good</option>
									<option value="5">Excellent</option>
								</select>
							</label>
						</td>
					</tr>


				</table>
				<table id="feedback_comments_course" class="table">
					<tr>
						<td><font color="#0092C8" size=4><p class="text-primary">Comments (optional)</p></font></td>
						<td></td>
					</tr>
					<tr>
						<th style="width:50%">The main strengths of this course are:</th>
						<th style="width:50%">Topics to be included/deleted in the course to make it more effective are:</th>
					</tr>
					<tr>
						<td>
							<div id="postcomment">
								<!-- idcourse from table id course -->
								<textarea class="form-control" rows="5" id = "comment1" name="cmnt1" placeholder=" Type your comment here (Optional). Maximum 500 characters." style="text-align:justify;" rel="tooltip" title="Drag down the right bottom corner to increase space" class="mycomment" ></textarea>
							</div>
						</td>
						<td>
							<div id="postcomment">
								<!-- idcourse from table id course -->
								<textarea class="form-control" rows="5" id = "comment2" name="cmnt2" placeholder=" Type your comment here (Optional). Maximum 500 characters." style="text-align:justify;" rel="tooltip" title="Drag down the right bottom corner to increase space" class="mycomment" ></textarea>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<!-- Faculty Feedback-->
			<div class="faculty_feedback_div">
				<table id="feedback_faculty" class="table table-hover">
					<tr>
						<td><font color="#0092C8" size=4><p class="text-primary">The Faculty</p></font></td>
						<td> </td>
					</tr>
					<tr>
						<td>The faculty is audible to all the students in the class.</td>
						<td>
							<label>
								<select class="form-control input-sm select-row" name="q[]" id="t16">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>Questions and discussion from students in the class were encouraged and handled effectively.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t17">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>
					<tr>
						<td>The faculty raised challenging questions in class.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t18">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>The faculty was able to answer questions clearly and concisely.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t19">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>The faculty helped improve the problem solving abilities.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t20">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>The faculty used blackboard / other visual aids appropriately.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t21">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>The faculty’s speaking and writing was clear, coherent and effective.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t22">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>The faculty arrived on time and used the class time effectively.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t23">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>Faculty was willing to meet the students outside the class hours for seeking clarifications.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t24">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>Lectures were organized properly and delivered in a clear and concise manner as per the teaching plan.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t25">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>The faculty was organized and well prepared for every class.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t26">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>The tests were at a reasonable level of difficulty and allowed sufficient time.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t27">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>Answer scripts were evaluated fairly & impartially and proper feedback is given to students on their performance.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t28">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>Minor and mid semester performance adequately discussed after the examination.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t29">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>Faculty stimulated interest on the subject.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t30">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>The faculty related the subject area to other disciplines, when appropriate.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t31">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>The faculty had a good command on the subject.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t32">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>The faculty used appropriate examples and illustrations wherever necessary.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t33">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>The faculty was fair and sensitive to the student needs in the class.</td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t34">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>

					<tr>
						<td>Overall the faculty was very effective. </td>
						<td>
							<label>
								<select  class="form-control input-sm select-row" name="q[]" id="t35">
									<option value="0"> Select Option </option>
									<option value="5"> 5 </option>
									<option value="4"> 4 </option>
									<option value="3"> 3 </option>
									<option value="2"> 2 </option>
									<option value="1"> 1 </option>
								</select>
							</label>
						</td>
					</tr>


				</table>
				<table id="feedback_comments_faculty" class="table">
					<tr>
						<td><font color="#0092C8" size=4><p class="text-primary">Comments (optional)</p></font></td>
						<td> </td>
					</tr>
					<tr>
						<td style="width:50%">Mention one or two of the faculty's most effective practices :</td>
						<td style="width:50%">What additional constructive feedback can you offer to the faculty which might help the effectiveness of teaching ?</td>
					</tr>
					<tr>
						<td>
							<div id="postcomment">
								<!-- idcourse from table id course -->
								<textarea class="form-control" rows="5" id="comment3" placeholder=" Type your comment here (Optional). Maximum 500 characters." style="text-align:justify;" title="Drag down the right bottom corner to increase space" class="mycomment"></textarea>
							</div>
						</td>
						<td>
							<div id="postcomment">
								<!-- idcourse from table id course -->
								<textarea class="form-control" rows="5" id="comment4" placeholder=" Type your comment here (Optional). Maximum 500 characters." style="text-align:justify;" title="Drag down the right bottom corner to increase space" class="mycomment"></textarea>
							</div>
						</td>
					</tr>
				</table>
			</div tabindex="-1">

			<div class="upper-bar" id="upper-bar">
				<button  class="btn btn-block btn-lg btn-success" id="t_submit"> S U B M I T</button>
			</div>
			<div align="center">
				<img src="<?php echo asset_url()."images/feedback-loading.gif"; ?>" id="t_img" width="160px" height="20px" />
			</div>
		</div>   <!--/ques_theory -->
		<div id="tabs" class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading"><span class="glyphicon glyphicon-list-alt "></span> &nbsp; Registered Courses</div>
			<div class="panel-body">
				<ul>
					<li class="text-info"> <strong>Anonymity of feedback is guaranteed</strong>	</li>
					<li>Only after the academic results are announced, consolidated feedback report will be shared with the faculty. <strong>No student details are stored.</strong></li>

					<li>If any of the lab/theory courses are missing or are extra, please contact WSDC before submitting the feedback</li>
					<li>All questions are mandatory except comments</li>
					<li>For assistance, contact <a href="mailto:wsdc.nitw@gmail.com">wsdc.nitw@gmail.com</a> , WSDC NITW
					</li>
				</ul>
			</div>
			<div>
				<table class="table table-hover table-condensed" data-questions=35 data-commentsize=4>
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
                                // if($alloted==0)
                                // {
                                //     $glyphicon="glyphicon-ban-circle";
                                // }

								?>
								<tr class="course_row" data-cfid="<?php if($alloted) echo $course['cfid'];?>" data-status="<?php echo $is_feedback_filled;?>" data-alloted="<?php echo $alloted;?>"
									data-credits="<?php echo $course['credits'];?>" data-type="<?php echo $course['type'];?>" data-sec="<?php echo $list['sec']; ?>" data-faculty-id="<?php if($alloted)  echo $course['faculty_id'];?>" >
									<td class="text-center"><?php echo $course_id;?></td>
									<td><?php echo $course['id'];?></td>
									<td><?php echo $course['name'];?></td>
									<td><?php echo $faculty_name;?></td>

									<td style="text-align:center;" class="<?php echo $text_color;?>"><span rel="tooltip" data-placement="left" title="Feedback<?php if($is_feedback_filled==0) echo 'not';?> submitted" class="glyphicon <?php echo $glyphicon;?>"></span></td>
								</tr>
								<?php
								$course_id++;
							}
						} ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- </div> panel -->
	</div>  <!-- /col-md-12-->
</div><!-- /row inside row -->
<center>
	<ol class="breadcrumb" style="display:none;">
		<li>5-Strongly agree</li>
		<li>4-Agree</li>
		<li>3-Partially agree</li>
		<li>2-Disagree</li>
		<li>1-Strongly disagree</li>
	</ol>
</center>		