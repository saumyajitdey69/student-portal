<div class="row" style="margin-top:1%;" >
  <div class="col-xs-12 col-sm-3 col-md-2 hidden-print" id="sidebar" role="navigation">
    <div class="bs-sidebar hidden-print affix" role="complementary">
     <ul class="nav bs-sidenav">
      <li <?php echo $current_page === "home" ? "class='active'" : ""?>>
        <a href="<?php echo base_url('audit/home'); ?>">
          <span class="glyphicon glyphicon-home"></span> HOME
        </a>
      </li>
      <li <?php echo $current_page === "profile" ? "class='active'" : ""?>>
        <a href="<?php echo base_url('audit/profile'); ?>">
          <span class="glyphicon glyphicon-user"></span> Profile
        </a>
      </li>
      <hr>
      <li <?php echo $current_page === "attendance" ? "class='active'" : ""?>>
        <aref="<?php echo base_url('attendance'); ?>">ATTENDANCE </a>
      </li>
      <hr>
      <!-- <li>FEEDBACK</li>
      <li <?php echo $current_page === "feedback" ? "class='active'" : ""?>>
        <a href="<?php //echo base_url('audit/feedback'); ?>">
          <span class="glyphicon glyphicon-check"></span> Feedback (December 2014)
        </a>
      </li> -->
      <li <?php echo $current_page === "feedback" ? "class='active'" : ""?> class="tips" title="Feedback">FEEDBACK
       <a href="<?php echo base_url('audit/feedback'); ?>">
          <span class="glyphicon glyphicon-check"></span> Feedback (December 2014)
        </a>
      </li>
      <li>
        <a href="http://172.20.0.4/ro"><span class="glyphicon glyphicon-tasks"></span> Routine Order </a>
      </li>
     <!-- <li <?php echo $current_page === "exit_feedback" ? "class='active'" : ""?>>
        <a href="<?php echo base_url('audit/exit_feedback'); ?>">
          <span class="glyphicon glyphicon-check"></span> Exit Feedback
        </a>
      </li>-->

      <hr>
      <li>
        RESULTS
      </li>
      <li <?php echo $current_page === "result" ? "class='active'" : ""?>>
        <a href="<?php echo base_url('audit/results') ?>">
          <span class="glyphicon glyphicon-list"></span> April 2014 (Even Sem)
        </a>
      </li>
      <hr>
      <li <?php echo $current_page === "slip" ? "class='active'" : ""?> class="tips" title="Registration slip avalilable">
        <a href="<?php echo base_url('audit/slip'); ?>" target="_blank">
          <span class="glyphicon glyphicon-file"></span> Registration Slip 
        </a>
      </li>
      <li <?php echo $current_page === "calendar" ? "class='active'" : ""?>>
        <a href="<?php echo base_url('audit/calendar'); ?>">
          <span class="glyphicon glyphicon-calendar"></span> Academic Calender 2014
        </a>
      </li>
     </ul>
  </div><!--/span-->
</div>
<div class="clearfix visible-xs hidden-print"></div>
<div class="col-xs-12 col-sm-9 col-md-10">
  <br>