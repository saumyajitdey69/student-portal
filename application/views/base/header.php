<?php if (!isset($current_section)) { $current_section = ''; } ?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Edit profile of faculty of NITW">
<meta name="author" content="WSDC">
<head>
	<title><?php if(!empty($title)) echo $title; else echo 'WSDC'; ?></title>
	<link href="<?php echo asset_url()."css/flatty.bootstrap.min.css" ?> " rel="stylesheet">
	<link href="<?php echo asset_url()."css/introjs.min.css" ?>" rel="stylesheet">
	<link href="<?php echo asset_url()."css/offcanvas.css" ?>" rel="stylesheet">
	<!-- Notify CSS -->
	<link href="<?php echo asset_url()."css/bootstrap-notify.css" ?>" rel="stylesheet">

	<!-- Custom Styles -->
	<link href="<?php echo asset_url()."css/alert-bangtidy.css" ?>" rel="stylesheet">
	<link href="<?php echo asset_url()."css/alert-blackgloss.css" ?>" rel="stylesheet">
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-46078676-1', 'auto');
		ga('require', 'displayfeatures');
		ga('send', 'pageview');

	</script>
</head>
<body>
	<div class="container-fluid">
		<div class="navbar navbar-fixed-top navbar-default hidden-print" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo base_url() ?>"> <span class="glyphicon glyphicon-user"></span> STUDENT PORTAL</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<div class="col-md-5 col-xs-12">
						<form class="navbar-form" role="search" style="width:100%">
							<input type="text" class="form-control" placeholder="Search students" name="search-item" style="width:100%">
						</form></div>
						<ul class="nav navbar-nav">
							
						<!-- <li data-placement="bottom" class=" tips <?php echo ($current_section === 'form')?'active':''; ?>"  title="tz Application">
							<a href="<?php echo base_url('forms'); ?>">
								<span class="glyphicon glyphicon-floppy-disk"></span> <span class="hidden-sm"> tz Application</span>
							</a>
						</li> -->

						<!-- <li data-placement="bottom" class=" tips <?php echo ($current_section === 'makeup')?'active':''; ?>"  title="Online Makeup Exam Registration">
							<a href="<?php echo base_url('makeup'); ?>">
								<span class="glyphicon glyphicon-list-alt"></span> <span class="hidden-sm"> Registrations</span>
							</a>
						</li> -->
					</ul>

					

					<ul class="nav navbar-nav navbar-right">
					<!-- <li class="pops" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-html="true" data-content="" role="button" data-original-title="About">
					<a href="#"></a>
				</li> -->
				<li class="tips <?php echo ($current_section === 'audit')?'active':''; ?>" title="Academic Audit : Results, Feedback, Registration">
					<a href="<?php echo base_url('audit/home'); ?>">
						<span class="glyphicon glyphicon-list-alt"></span> <span class="hidden-sm"><!-- Academic Audit --></span>
					</a>
				</li>
				<li data-placement="bottom" class=" tips <?php echo ($current_section === 'hostels')?'active':''; ?>"  title="Online Hostel Allotment">
					<a href="<?php echo base_url('hostels'); ?>">
						<span class="glyphicon glyphicon-cutlery"></span> <span class="hidden-sm"> <!-- Hostel & Mess --></span>
					</a>
				</li>
				<!-- <li data-placement="bottom" class=" tips <?php echo ($current_section === 'form')?'active':''; ?>"  title="WSDC Online Applications">
					<a href="<?php echo base_url('apply'); ?>">
						<span class="glyphicon glyphicon-share-alt"></span> <span class="hidden-sm">WSDC Applications</span>
					</a>
				</li> -->
				<li data-placement="bottom" class=" tips <?php echo ($current_section === 'wsdc')?'active':''; ?>"  title="WSDC website">
					<a href="http://wsdc.nitw.ac.in/" target="_blank">
						<span class="glyphicon glyphicon-list"></span> <span class="hidden-sm"><!-- About WSDC --></span>
					</a>
				</li>
				<li data-placement="bottom" class="tips <?php echo $current_page === "profile" ? "'active'" : ""?>" title="My Profile">
					<a href="<?php echo base_url('audit/profile'); ?>">
						<span class="glyphicon glyphicon-user"></span> <!-- Profile -->
					</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="glyphicon glyphicon-cog"></span> <!-- Settings <b class="caret"></b> --> &nbsp;
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url('auth/changepasswd') ?>"><span class="glyphicon glyphicon-barcode"></span> Change Password</a> </li>
						<li><a href="<?php echo base_url('auth/logout') ?>"><span class="glyphicon glyphicon-off"></span> Logout</a> </li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>

