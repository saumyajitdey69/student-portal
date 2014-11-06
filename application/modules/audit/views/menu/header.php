<div class="row">

  <div class="col-sm-3 col-md-2 hidden-print sidebar" role="navigation">
    <div class="bs-sidebar hidden-print affix" role="complementary">
     <ul class="nav nav-sidenav"><br>
      <li <?php echo $current_page === "home" ? "class='active'" : ""?>>
        <a href="<?php echo base_url('audit/home'); ?>">
          ACADEMIC SECTION
        </a>
      </li>
      <!-- <li <?php echo $current_page === "profile" ? "class='active'" : ""?>>
        <a href="<?php echo base_url('audit/profile'); ?>">
          <span class="glyphicon glyphicon-user"></span> Profile
        </a>
      </li> -->
      <!-- <hr> -->
      <li <?php echo $current_page === "attendance" ? "class='active'" : ""?>>
        <a href="<?php echo base_url('attendance'); ?>">
          Attendance
        </a>
      </li>
      <li <?php echo $current_page === "feedback" ? "class='active'" : ""?>>
        <a href="<?php echo base_url('audit/feedback'); ?>">
         Student Feedback
       </a>
     </li>

     <li <?php echo $current_page === "exit_feedback" ? "class='active'" : ""?>>
      <a href="<?php echo base_url('audit/exit_feedback'); ?>">
       Exit Feedback
     </a>
   </li>
   <li <?php echo $current_page === "result" ? "class='active'" : ""?>>
    <a href="<?php echo base_url('audit/results') ?>">
      April 2014 (Even Sem)
    </a>
  </li>
  <li <?php echo $current_page === "slip" ? "class='active'" : ""?> class="tips" title="Registration slip avalilable">
    <a href="<?php echo base_url('audit/slip'); ?>" target="_blank">
      Registration Slip
    </a>
  </li>
  <li <?php echo $current_page === "calendar" ? "class='active'" : ""?>>
    <a href="<?php echo base_url('audit/calendar'); ?>">
      Academic Calender 2014-15
    </a>
  </li>
</ul>
</div><!--/span-->
</div>
<div class="clearfix visible-xs hidden-print"></div>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <br>