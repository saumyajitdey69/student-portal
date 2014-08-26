</div>
<div class="well wsdc-well">
	<div class="container">
		<h1><img src="<?php echo base_url('assets/images/technozion/logo.png') ?>"> Workforce/Subcore Applications</h1>
		<legend class="text-danger">Event Managers applications will start soon (probably tonight) <br> Those who have applied for workforce and subcore can also apply for Event Manager post.  </legend>
		<legend class="text-info">
			Sponsorship, Design & Creatives, Web Development and Logistics applications are closed
		</legend>
		<span class="pull-right"><a href="http://www.technozion.org">www.technozion.org</a> | <a href="http://events.technozion.org">events.technozion.org</a> | <a href="http://blog.technozion.org">blog.technozion.org</a> | <a href="http://contact.technozion.org">contact.technozion.org</a></span>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 text-justify">
			<legend>Rules and Regulations</legend>
			<ul>
				<li>All the applicants should register using student portal (offline applications are not available)</li>
				<li>Third year, B. Tech. students ( registered for 5th ) must have minimum CGPA of 6.0 / 10 to apply for Subcore</li>
				<li>Second year, B. Tech. students ( registered for 3rd semester ) must have minimum CGPA of 6.5 / 10 to apply for workforce</li>
				<li>Students with backlog or subjected to any disciplinary action are not eligible to apply</li>
				<li>Only registered students are permitted for interview and will be eligible for the applied post</li>
				<li>Each applicant can apply for maximum of two departments only</li>
				<li>Above rules and regulations are only for subcore and workforce. Rules and regulations for event managers will be displayed soon</li>
			</ul>
			<p>** All the Sub-core/Work-force members will be given PRINTED certificate of Technozion 2014
			</p>
			<p>
				** All the applicants will be provided with appropriate guidance and resources by the respective team members
			</p>
		</div>
  		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 ">
  			<ul class="nav nav-tabs hidden-print">
  				<li class="active"><a href="#applications" data-toggle="tab"><?php if($sem = '3') echo " Workforce Applications"; else echo "Subcore Applications"; ?></a></li>
  				<li><a href="#event-managers" data-toggle="tab"> Event Manager Applications </a></li>
  			</ul>
  			<div class="tab-content">
				<div class="tab-pane active fade in" id="applications">
					<form class="form form-horizontal" action="<?php echo base_url('forms/submit') ?>" method="POST" role="form"><br>		
				<legend>TZ Department</legend>	
				<div class="form-group">
						<div class='col-md-12 hidden'>
							<input id="roll" name = "roll" type = "text" value="<?php echo $roll; ?>">
						</div>
					</div>
				<?php if($check === 0)
					echo "<br><center>Your application is submitted.<br>We will soon call you for the interview.</center>";
				else
				{ ?>
				<?php if($sem === -1 || $sem === 0)
				echo "<br><center> Sorry, You are not eligible for the application. </center>";
				else
					if(($sem === '3' && $cgpa < 6.5) || ($sem === '5' && $cgpa < 6))
						echo "<br><center> Sorry, You are not eligible for the application. </center>";
					else
						{ ?>
					<div class="form-group">
						<div class="col-sm-3">
							<label for="" class="control-label">Preference 1 * </label>
						</div>
						<div class="col-sm-9">
							<select name="preference1" id="preference1" class="form-control" required title="Preference one is mandatory">
								<option value="">-- Select One --</option>
								<option value="1">Treasury</option>
								<!-- <option value="2">Sponsorship & Public Relations</option> -->
								<option value="3">Event Coordination & Conduction (ECC)</option>
								<!-- <option value="4">Logistics & Security</option> -->
								<option value="5">Hospitality & Transportation</option>
								<option value="6">Publicity and Media Relations</option>
								<option value="7">Quality Control Management</option>
								<!--<option value="8">Web Development</option>
								<option value="9">Design & Creatives</option>-->
							</select>
						</div>

					</div>
					<div class="form-group">
						<div class="col-sm-3">
							<label for="" class="control-label">Preference 2</label>
						</div>
						<div class="col-sm-9">
							<select name="preference2" id="preference2" class="form-control">
								<option value="">-- Select One --</option>
								<option value="1">Treasury</option>
								<!-- <option value="2">Sponsorship & Public Relations</option> -->
								<option value="3">Event Coordination & Conduction (ECC)</option>
								<!-- <option value="4">Logistics & Security</option> -->
								<option value="5">Hospitality & Transportation</option>
								<option value="6">Publicity and Media Relations</option>
								<option value="7">Quality Control Management</option>
								<!--<option value="8">Web Development</option>
								<option value="9">Design & Creatives</option>-->
							</select>
						</div>
	
					</div>
					<div class="form-group">
						<div class="col-sm-3">
							<label for="" class="control-label">Position</label>
						</div>
						<div class="col-sm-9">
							<select name="position" id="position" class="form-control" required>
								<option value="">-- Optional --</option>
								<?php if($sem === '1'):?>
								<option value="0">Volunteers ( 1st years only )</option>
								<?php endif;?>
								<option value="1">Workforce ( 2nd years only )</option>
								<option value="2">Subcore ( 3rd years only )</option>
								<!--<option value="3">Event Manager ( open for all )</option>-->
							</select>
						</div>
	
					</div>
					<hr>
					<legend>Questions</legend>
	
					<div class="form-group">
						<div class='col-md-12'>
							<label for="" >
								Why Technozion?
							</label>
							<textarea class="form-control" name="question1" id="question1" rows="4" placeholder="not more than 200 words" required="required" title="This is just the first question you have to answer 2 more. It better if you think and answer, only shortlisted candidate will be selected for interview"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class='col-md-12'>
							<label for="" >
								Why do you think you are suitable candidate for this post? 
							</label>
							<textarea class="form-control" name="question2" id="question3" rows="4" placeholder="not more than 200 words" required="required" title="You should answer these questions honestly"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class='col-md-12'>
							<label for="" >
								Suggest at least three things you want to implement in Tehcnozion 14 and your role to achieve these goals.
							</label>
							<textarea class="form-control" name="question3" id="question3" rows="4" placeholder="not more than 200 words" required="required" title="Spent 5 more mins, this is the last question"></textarea>
						</div>
					</div>

					<button type="submit" class="btn btn-primary">Submit</button>
			</form>
			<?php } } ?>
				</div>	
				<div class="tab-pane fade in" id="event-managers">
					<center><br><br>Please don't submit your application now, we are testing the portal.<br> we will inform you when to start filling the application for Event Manager.</center>
				</div>
			</div>
		</div>
	</div>
</div>