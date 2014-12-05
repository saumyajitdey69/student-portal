  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 hidden-print sidebar" role="navigation">
      <ul class="list-group">
        <li class="list-group-header">OMAHA</li>
        <li class="list-group-item <?php echo (isset($current_page) && $current_page === "home")?"active":""; ?>">
         <a href="<?php echo base_url("hostels/"); ?>">
          Winter Session Home
        </a>
      </li>
      <li class="list-group-item <?php echo (isset($current_page) && $current_page === "rules")?"active":""; ?>">
      <a href="<?php echo  base_url('hostels/rules/winter') ?>">Instructions</a>
     </li>

     <li class="list-group-item <?php echo (isset($current_page) && $current_page === "slip")?"active":""; ?>">
      <a href="<?php echo base_url("hostels/hostel_slip"); ?>">
        Room Allotment Slip
      </a>
    </li>
  </ul>
</div>
<div class="clearfix visible-xs hidden-print"></div>
<div class="col-sm-9 col-md-10 main">
  <!-- <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"> -->
