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
<h3 class="text-primary"> &nbsp; NITW Mann Ka Radio <small>powered by LAN Radio Club, NITW</small> <span class="pull-right"><span id="online-indicator" class="label label-danger">OFFLINE </span></span></h3>
<br>
<div class="row">
	<div class="col-md-12">
		<div id="jquery_jplayer_1" class="jp-jplayer"></div>
		<div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
			<div class="jp-type-single">
				<div class="jp-gui jp-interface">
					<div class="jp-controls">
						<button class="jp-play" role="button" tabindex="0">play</button>
						<button class="jp-stop" role="button" tabindex="0">stop</button>
					</div>
					<div class="jp-progress">
						<div class="jp-seek-bar">
							<div class="jp-play-bar"></div>
						</div>
					</div>
					<div class="jp-volume-controls">
						<button class="jp-mute" role="button" tabindex="0">mute</button>
						<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
						<div class="jp-volume-bar">
							<div class="jp-volume-bar-value"></div>
						</div>
					</div>
					<div class="jp-time-holder">
						<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
						<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
						<div class="jp-toggles">
							<button class="jp-repeat" role="button" tabindex="0">repeat</button>
						</div>
					</div>
				</div>
				<div class="jp-details">
					<div class="jp-title" aria-label="title">&nbsp;</div>
				</div>
				<div class="jp-no-solution">
					<span>Update Required</span>
					To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div role="tabpanel">

			<!-- Nav tabs -->
			<ul class="nav nav-tabs nav-tabs-google radioTabs" role="tablist">
				<li role="presentation" class="active"><a href="#about" aria-controls="about" role="tab" data-toggle="tab">About LAN Radio</a></li>
				<li role="presentation"><a href="#troubleshooting" aria-controls="troubleshooting" role="tab" data-toggle="tab">Troubleshooting</a></li>
				<li role="presentation"><a href="#Contact" aria-controls="Contact" role="tab" data-toggle="tab">Contact Us</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="about">
					<br>
					<ul>
						<li>Get enthralled in the chitchats, gossips, facts, happenings, of the college right away from your room.</li>
						<li>Convey your wishes to your friends on their special occasions.</li>
						<li>Listen to the interviews of adroit people.</li>
						<li>Hark to your favorite songs.</li>
						<li>Dedicate songs to your lovable one.</li>
						<li>Open up your voice by coming out with your opinions on various issues so that college will listen to you through radio.</li>						
					</ul>		

					<blockquote>
						Dr. L. Anjaneyulu <small>Faculty Advisor, NITW LAN Radio Club</small>
					</blockquote>			
				</div>
				<div role="tabpanel" class="tab-pane" id="troubleshooting">
					<br>
					<b>Unable to listen anything?</b>
					<br>
					<ul>
						<li>Check out the green coloured "ON AIR" label on the top right corner of your desktop screen. If you don't find it on this page, sorry we don't have any live show. We will be back soon.
							<ul> 
								<strong>For more updates on our live shows</strong>
								<li>Like us on <a href="https://www.facebook.com/NITWCollegeRadio" target="_blank">Facebook</a></li>
								<li>Follow us on <a href="https://www.twitter.com/nitwradio" target="_blank">Twitter</a></li>
							</ul>
						</li>
						<li>
							Please wait for 5 minutes and then read next point.
						</li>
						<li>
							If you don't hear anything, check out your volume setting and power supply to speakers. Still the problem persists then try your desktop media player like VLC or GOM.
							<ul>
								<li><a href="http://nitwradio.co.nr/" target="_blank">Click here</a> to learn more about it.</li>
								<li><a href="http://santoshboms.blogspot.in/2011_12_01_archive.html" target="_blank">Click here</a> to troubleshoot.</li>								
							</ul>
						</li>
						<li>
							Still no sound?, <a onclick="$('.radioTabs li:eq(2) a').tab('show')" href="#Contact"> click here</a> to contact us.
						</li>
					</ul>
				</div>
				<div role="tabpanel" class="tab-pane" id="Contact">
					<br>
					<ul>
						<li>For any technical help, contact D. Gowtham ( +91 9494866224, +91 7386727231 )</li>
						<li>For any suggestions on RJ's, contact ​﻿R.Sarath (+91 8500729446)  </li>						
					</ul>
				</div>
			</div>

		</div>
	</div>
</div>

<script>
	var url = "<?php echo base_url('apps/radio/indicator')?>";
</script>

