<?php if(isset($admin_logged) && $admin_logged==1): ?>
<div class="row" style="">
  <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 hidden-print" id="sidebar" role="navigation">
    <div class="bs-sidebar hidden-print affix" role="complementary">
     <ul class="nav bs-sidenav">
       <li class="<?php echo (isset($current_page) && $current_page === "auth")?"active":""; ?>">
         <a href="<?php echo base_url("auth"); ?>">
          Authentication
        </a>
      </li>
      <li class="<?php echo (isset($current_page) && $current_page === "new_group")?"active":""; ?>">
        <a href="<?php echo base_url("auth/create_group"); ?>">
          Create new group
        </a>
      </li>
      <li class="<?php echo (isset($current_page) && $current_page === "new_user")?"active":""; ?>">
        <a href="<?php echo base_url("auth/create_user"); ?>">
          Create new user
        </a>
      </li>
    </ul>
  </div><!--/span-->
</div>
<div class="clearfix visible-xs hidden-print"></div>
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
  <br>
<?php endif; ?>