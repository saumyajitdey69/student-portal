<div class="row" style="margin-top:1%;" >
  <div class="col-xs-12 col-sm-3 col-md-2 hidden-print" id="sidebar" role="navigation">
    <div class="bs-sidebar hidden-print affix" role="complementary">
     <ul class="nav bs-sidenav">
      <li <?php echo $current_page === "home" ? "class='active'" : ""?>>
        <a href="<?php echo base_url('makeup'); ?>">
          <span class="glyphicon glyphicon-home"></span> Make-up exam
        </a>
      </li>

      <li <?php echo $current_page === "slip" ? "class='active'" : ""?>>
        <a href="<?php echo base_url('makeup/makeup_slip'); ?>">
          <span class="glyphicon glyphicon-list"></span>Registration Slip
        </a>
      </li> 
     </ul>
  </div><!--/span-->
</div>
<div class="clearfix visible-xs hidden-print"></div>
<div class="col-xs-12 col-sm-9 col-md-10">
  <br>