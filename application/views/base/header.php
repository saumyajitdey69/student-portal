<?php if (!isset($current_section)) { $current_section = ''; } ?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Student Protal for students of NIT Warangal developed by WSDC">
<meta name="author" content="WSDC">
<head>
	<title><?php if(!empty($title)) echo $title; else echo 'Student Portal | NITW'; ?></title>
	<link href="<?php echo asset_url()."css/bootstrap.min.css" ?> " rel="stylesheet">
	<link href="<?php echo asset_url()."css/google.bootstrap.min.css" ?> " rel="stylesheet">
	<link href="<?php echo asset_url()."css/offcanvas.css" ?>" rel="stylesheet">
	<?php
	if (isset($css)) {
		foreach ($css as $index => $c) {
			?>
			<link href="<?php echo asset_url()."css/".$c; ?>" rel="stylesheet">
			<?php
		}
	}
	?>
</head>
<body class="google">
	<!-- <div class="container-fluid"> -->
	<div class="navbar navbar-fixed-top navbar-inverse hidden-print" role="navigation">
		<div class="container">
			<div class="row">	
				<div class="col-md-2">
					<div class="navbar-header google-header-img">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<a class="navbar-brand" href="http://wsdc.nitw.ac.in">
							<img class="img" width="70px" src="<?php echo base_url('assets/images/logo_wsdc.png') ?>" alt="wsdc_logo">
						</a>
					</div>
				</div>
				<div class="col-md-10 google-mobile">
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse google-header-center navbar-ex1-collapse">
						<?php if($this->ion_auth->is_admin()): ?>
							<form onsubmit="return false;" class="hidden-xs navbar-form google-header-form col-md-6 col-xs-12" role="search">
								<div class="has-feedback form-group">
									<div class="input-group google-input-group">
										<input type="search" class="form-control google-search-bar google-search-size" placeholder="Search students" id="search-item-input" oninput="OnInput(this.value)" autocomplete="off" name="search-item">
										<span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
										<span class="input-group-btn">
											<span class="glyphicon glyphicon-search"></span>
										</span>
									</div>
								</div>

								<div class="list-group search-result-box google-search-size" id="search-item-output" >
								</div> 
							</form>						
						<?php endif; ?>
						<ul class="nav navbar-nav navbar-right">
							<li class="google-main-menu" >
								<a tabindex="0" data-toggle="popover" data-trigger="focus"  data-content='<?php echo modules::run("enotice", "main-menu") ?>' data-html=true  data-placement="bottom">
									<span class="glyphicon glyphicon-th-large"></span>
								</a>
							</li>
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle google-name-email" data-toggle="dropdown">
								<?php echo $this->session->userdata('name'); ?>
								<br/>
								<small><?php echo $this->session->userdata('email'); ?></small>
								<!-- <span class="glyphicon glyphicon-cog"></span> -->  <b class="caret"></b> &nbsp;
							</a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url('audit/profile') ?>"><span class="glyphicon glyphicon-user"></span> My Profile </a> </li>
								<li><a href="<?php echo base_url('auth/change_password') ?>"><span class="glyphicon glyphicon-barcode"></span> Change Password</a> </li>
								<li><a href="<?php echo base_url('auth/logout') ?>"><span class="glyphicon glyphicon-off"></span> Logout</a> </li>
							</ul>
						</li>
						<li class="google-profile-img hidden-xs hidden-print">
							<!-- <a class="google-profile-img-container" href="<?php echo base_url('profile'); ?>"> -->
							<img src="<?= base_url('assets/upload/thumbs/'.$this->session->userdata('registration_number').'.jpg')?>" alt="profil_img" class="img img-rounded img-responsive" width="50px" height="50px">
							<!-- </a>		 -->
						</li>

					</ul>
				</div>	
			</div>
		</div>
	</div>
</div>
<div class="container">
