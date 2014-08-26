    <!DOCTYPE html>
    <html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Authentication of credentials">
    <meta name="author" content="WSDC">
    <title>Register | Student Portal</title>
    <head>
        <title>Student Login</title>
        <link href="<?php echo asset_url(); ?>css/0.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo asset_url(); ?>css/signin.css" rel="stylesheet">
    </head>
    <body style="padding-top:0">
        <div class="container-fluid">
            <nav class="navbar navbar-default" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"> &nbsp; <span class="glyphicon glyphicon-user"></span> STUDENT  PORTAL</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo base_url('auth') ?>">Sign In</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div>
        
        <div class="container">
            <div class="page-header">
              <h1 class="text-center">Create your WSDC Account<small></small></h1>
          </div>
          <div class="row">
            <div class="hidden-xs col-xs-12 col-sm-6 col-md-8  col-lg-8">
            <div id="center">
                    <div id="main_name">
                        <a href="http://www.nitw.ac.in/">
                            <img src="<?php echo asset_url(); ?>images/logo_nitw.png" alt="">
                        </a>
                    </div>
                    <div id="full_form">
                        NATIONAL INSTITUTE OF TECHNOLOGY WARANGAL
                        <br>
                        <br>An Institute of National Importance
                    </div>
                </div>
                <div id="main_name">
                    <a href="http://www.nitw.in">
                        <img src="<?php echo asset_url(); ?>images/logo_wsdc.png" alt="WSDC logo">
                    </a>
                </div>
            </div>
            <div class="clearfix visible-xs"></div>
            <div class="col-xs-12 col-sm-6 col-md-4  col-lg-4 well">
