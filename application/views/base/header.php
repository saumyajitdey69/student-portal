<?php if (!isset($current_section)) { $current_section = ''; } ?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Student Protal for students of NIT Warangal developed by WSDC">
<meta name="author" content="WSDC">
<head>
	<title><?php if(!empty($title)) echo $title; else echo 'WSDC'; ?></title>
<<<<<<< HEAD
	<link href="<?php echo asset_url()."css/flatty.bootstrap.min.css" ?> " rel="stylesheet">
	<link href="<?php echo asset_url()."css/google.bootstrap.min.css" ?> " rel="stylesheet">
	<link href="<?php echo asset_url()."css/offcanvas.css" ?>" rel="stylesheet">
=======
	<link href="<?php echo asset_url()."css/bootstrap.min.css" ?> " rel="stylesheet">
	<link href="<?php echo asset_url()."css/offcanvas.css" ?>" rel="stylesheet">	<!-- Notify CSS -->
	<link href="<?php echo asset_url()."css/bootstrap-notify.css" ?>" rel="stylesheet">
	<link href="<?php echo asset_url()."css/alert-bangtidy.css" ?>" rel="stylesheet">
	<link href="<?php echo asset_url()."css/alert-blackgloss.css" ?>" rel="stylesheet">
>>>>>>> e917856c5876303385c28f763b51dd0c0a2d3aa5
	<?php
	if (isset($css)) {
		foreach ($css as $index => $c) {
			?>
			<script src="<?php echo asset_url()."css/".$c; ?>"></script>
			<?php
		}
	}
	?>
<<<<<<< HEAD
=======

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-46078676-1', 'auto');
		ga('require', 'displayfeatures');
		ga('send', 'pageview');

	</script>
>>>>>>> e917856c5876303385c28f763b51dd0c0a2d3aa5
</head>
<body class="google">
	<!-- <div class="container-fluid"> -->
	<div class="navbar navbar-fixed-top navbar-inverse hidden-print" role="navigation">
		<div class="row">	
			<div class="col-md-2">
				<div class="navbar-header google-header-img">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<a class="navbar-brand" href="<?php echo base_url() ?>">
						<img class="img" width="70px" src="<?php echo base_url('assets/images/logo_wsdc.png') ?>" alt="wsdc_logo">
					</a>
				</div>
			</div>
			<div class="col-md-10">
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse google-header-center navbar-ex1-collapse">
					<form onsubmit="return false;" class="navbar-form google-header-form col-md-6 col-xs-12" role="search">
						<div class="input-group google-input-group">
							<input type="search" class="form-control google-search-bar google-search-size" placeholder="Search students" id="search-item-input" oninput="OnInput(this.value)" autocomplete="off" name="search-item">
							<span class="input-group-btn">
								<button class="btn btn-default btn-primary google-search-btn" type="button"> <span class="glyphicon glyphicon-search"></span></button>
							</span>
						</div><!-- /input-group -->
						<div class="list-group search-result-box google-search-size" id="search-item-output" >
						</div> 
					</form>						

					<ul class="nav navbar-nav navbar-right">
						<!-- <li data-placement="bottom" class="tips <?php echo ($current_section === 'audit')?'active':''; ?>" title="Academic Audit : Results, Feedback, Registration">
							<a href="<?php echo base_url('audit/home'); ?>">
								<span class="glyphicon glyphicon-list-alt"></span> <span class="hidden-sm">Academic Audit</span>
							</a>
						</li>
						<li data-placement="bottom" class=" tips <?php echo ($current_section === 'hostels')?'active':''; ?>"  title="Online Hostel Allotment">
							<a href="<?php echo base_url('hostels'); ?>">
								<span class="glyphicon glyphicon-cutlery"></span> <span class="hidden-sm"> Hostel & Mess</span>
							</a>
						</li>
						<li data-placement="bottom" class=" tips <?php echo ($current_section === 'wsdc')?'active':''; ?>"  title="WSDC website">
							<a href="http://wsdc.nitw.ac.in/" target="_blank">
								<span class="glyphicon glyphicon-list"></span> <span class="hidden-sm">About WSDC</span>
							</a>
						</li>
						<li data-placement="bottom" class="tips <?php echo $current_page === "profile" ? "'active'" : ""?>" title="My Profile">
							<a href="<?php echo base_url('audit/profile'); ?>">
								Profile
							</a>
						</li> -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?php echo $this->session->userdata('name'); ?>
								<!-- <span class="glyphicon glyphicon-cog"></span> -->  <b class="caret"></b> &nbsp;
							</a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url('auth/changepasswd') ?>"><span class="glyphicon glyphicon-barcode"></span> Change Password</a> </li>
								<li><a href="<?php echo base_url('auth/logout') ?>"><span class="glyphicon glyphicon-off"></span> Logout</a> </li>
							</ul>
						</li>
						<li class="google-profile-img">
							<img src="http://graph.facebook.com/v2.2/100002451127231/picture" alt="profil_img" class="img img-rounded img-responsive" width="50px" height="50px">	
						</li>

					</ul>
				</div>	
			</div>
		</div>
	</div>
<div class="container">
