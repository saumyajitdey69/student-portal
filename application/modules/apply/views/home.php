</div>
<div class="well wsdc-well">
	<div class="container">
		<legend class="text-danger">
			<br>
			<a href="http://www.nitw.ac.in/wsdc">
				<img class="img" width="150px" src="<?php echo base_url('assets/images/logo_wsdc.png') ?>">
			</a> 
			<span class="text-center">
				Last date of online application is 17th Aug, 2014 midnight. Read the instructions carefully.
			</span>
		</legend>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-justify">
			<legend>Instructions</legend>
			<div class="row">
				<ol>
					<li>Students are requested to update the phone number and email id under profile section</li>
					<li>CGPA >= 6.50 (Only for Btech)</li>
					<li>Eligible Students: <br> B.Tech > 3rd year (registered for 5th semester), 2nd year (registered for 3rd semester) <br>MCA > 1st and 2nd years</li>
					<li>B.Tech 3rd and 2nd years can apply for all profiles</li>
					<li>MCA students can apply for Web Developer (Websites) only</li>
					<li>Team is valid for the current year (2014-15). Certificates will be given based on performance only.</li>
					<li>Team count and selection criteria is based on Project and Project Leads</li>
					<li>
						Prerequisites:
						<ul>							
							<li>Web Developer (Web Applications):
								<ul>
									<li>Basic knowledge of algorithms</li>
									<li>Primary work: OMAHA, student portal, faculty portal and others</li>
								</ul>
							</li>
							<li>Web Developer (Websites)
								<ul>
									<li>Introduction to HTML, CSS</li>
									<li>Introduction to Content Management System (CMS) like Joomla and Drupal (not mandatory)</li>
									<li>Primary work: Developing and maintaining institute and department websites</li>
								</ul>
							</li>
							<li>Photoshop Designer: Experience with designing</li>
						</ul>
					</li>
					<li>Only shortlisted candidates will be informed with further details via email.<br><span class="text-danger">Don't spam WSDC email account</span> </li>
					<li>Students are requested to drop an email to wsdc.nitw@gmail.com only in case of any technical issue. Calling wsdc memeber is highly not recommended. Email sent on or before the last date and times of applications will be replied within two to three days and will be considered as eligible candidates.</li>
					<li>Please be prepared before coming for interview</li>
				</ol>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
			
			<!-- Btech and MCA check here -->
			<?php $class = trim($class); $flag = 1;?>
			<?php if($class != "BTech" and $class != "MCA") : ?>
				<div class="alert alert-danger">
					Only B.Tech (2nd year and 3rd year) and MCA (1st year & 2nd year) are allowed to apply. <strong> <?php echo $class ?> students are not allowed</strong>. Best of luck.
				</div>
				<?php $flag = 0; endif; ?>
				<!-- Btech and MCA check ends here -->
				<?php if($check === 0) : ?>
					<div class='alert alert-success'>
						<center>Your application is submitted.</center>
					</div>
				<?php else: ?>
					<?php if( $class == 'BTech'):?>
						<?php if($sem != "3" and $sem != "5"): ?>
							<div class='alert alert-danger'>
								You registered for <?php echo $sem ?>th semester. Hence you are not eligible for the application. Only Btech (2nd year and 3rd year) are allowed to apply. Best of luck.
							</div>
							<?php $flag = 0; endif; ?>
							<?php if($cgpa < 6.5):  ?>								
								<div class='alert alert-danger'>
									You are not eligible for the application. Your CGPA must be greater than 6.5. Best of luck.
								</div>
								<?php  $flag = 0; endif; ?>
							<?php endif; ?>
							<?php if($class == 'MCA'): ?>
								<?php if($sem != "1" and $sem != '3'): ?>
									<div class='alert alert-danger'>
										You are not eligible for the application. Only MCA (1st year and 2nd year) are allowed to apply. Best of luck
									</div>
									<?php $flag = 0; endif; ?>
									<!--  no cgpa for mca -->
								<?php endif; ?>	
								<?php if($flag == 1): ?>
									<legend>Online Applications for WSDC membership 2014-15 </legend>
									<form class="form form-horizontal" action="<?php echo base_url('apply/submit') ?>" method="POST" role="form"><br>		
										<div class="form-group">
											<div class='col-md-12 hidden'>
												<input id="roll" name = "roll" type = "text" value="<?php echo $roll; ?>">
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-3">
												<label for="" class="control-label">Preference 1<span class="text-danger">*</span> </label>
											</div>
											<div class="col-sm-9">
												<select name="preference1" id="preference1" class="form-control" required title="Preference one is mandatory">
													<option value="">-- Select One --</option>				
													<option value="website">Web Developer (Websites)</option>
													<?php if($class == 'BTech'): ?>
														<option value="webdeveloper">Web Developer (Web Applications)</option>
														<option value="photoshop">Photoshop Designer</option>
													<?php endif; ?>
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
													<option value="website">Web Developer (Websites)</option>
													<?php if($class == 'BTech'): ?>
														<option value="webdeveloper">Web Developer (Web Applications)</option>
														<option value="photoshop">Photoshop Designer</option>
													<?php endif; ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<div class='col-md-12'>
												<label for="" >
													Why do you think you are suitable for WSDC, NITW?
												</label>
												<textarea class="form-control" name="question1" id="question1" rows="4" placeholder="Don't write stories. Be specific. Less than 100 Words" required="required" title="Think and write, Not more than 100 words" max="1000" style="max-width:100%"></textarea>
											</div>
										</div>
										<button type="submit" class="btn btn-primary">Submit</button>
									</form>
								<?php endif; ?>
							<?php endif; ?>
						</div>	
					</div>
				</div>