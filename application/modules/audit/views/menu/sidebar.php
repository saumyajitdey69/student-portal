<?php if(isset($admin_logged) && $admin_logged==1): ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 hidden-print sidebar" role="navigation">
      <ul class="list-group">
      <li class="list-group-header">USER AUTHENTICATION</li>
        <li class="list-group-item <?php echo (isset($current_page) && $current_page === "auth")?"active":""; ?>">
         <a href="<?php echo base_url("auth"); ?>">
          Authentication
        </a>
      </li>
      <li class="list-group-item <?php echo (isset($current_page) && $current_page === "new_group")?"active":""; ?>">
        <a href="<?php echo base_url("auth/create_group"); ?>">
          Create new group
        </a>
      </li>
      <li class="list-group-item <?php echo (isset($current_page) && $current_page === "new_user")?"active":""; ?>">
        <a href="<?php echo base_url("auth/create_user"); ?>">
          Create new user
        </a>
      </li>
    </ul>
 </div>
<div class="clearfix visible-xs hidden-print"></div>
<div class="col-sm-9 col-md-10 main">
<!-- <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"> -->
  <br>
<?php endif; ?>