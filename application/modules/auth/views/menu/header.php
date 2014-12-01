<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Authentication of credentials">
<meta name="author" content="WSDC">
<title>Login | Student Portal</title>

<head>
    <title>Faculty Login</title>
    <link href="<?php echo base_url(); ?>assets/css/0.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/signin.css" rel="stylesheet">
    <script src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
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
    <div class="container">
        <div class="row">
        <div class="alert alert-info">
            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
            <!-- <p class="text-center">The student portal authentication has been changed. 
            You can login with your correct old account credentials.
            </p>
            <p class="text-danger text-center lead">In case you have forgot your password of old account or old account was not activated,<a href="../old_auth/auth">Click here</a>
                </p>
                <p class="text-danger text-center lead">If forgot Password says "No email record found",Try checking this <a href="../old_auth/auth">Page
            </p> -->
            
            <p class="text-center lead">
            1) First years can create account now.Don't forget to check your SPAM folder for mails. if you face any issues contact your friends who did it correctly.
            <br>
            <!-- 2) If you are getting error like Wrong Username/password,Try using this link to check whether account exists or you have to create new account -->
            </p>
        </div>
        <div class="hidden-xs col-md-8 col-sm-7 col-lg-8 well">
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
                    <a href="http://www.nitw.ac.in/wsdc">
                        <img src="<?php echo asset_url(); ?>images/logo_wsdc.png" alt="WSDC logo">
                    </a>
                </div>
            </div>
            <div class="clearfix visible-xs"></div>
            <div class="col-md-4 col-sm-5 col-lg-4" style="padding:15px">