<div class="row">
  <div class="col-sm-3 col-md-2 hidden-print sidebar" role="navigation">
    <ul class="list-group">
      <li class="list-group-header">ACADEMIC SECTION</li>
      <li class="list-group-item <?php echo $current_page === "home" ? "active" : ""?>">
        <a href="<?php echo base_url('audit/home'); ?>">Home</a>
      </li>
      <li class="list-group-item <?php echo $current_page === "profile" ? "active" : ""?>">
        <a href="<?php echo base_url('audit/profile'); ?>">Profile</a>
      </li>
      <li class="list-group-item <?php echo $current_page === "attendance" ? "active" : ""?>"> 
        <a href="<?php echo base_url('attendance'); ?>">Attendance(2014-15 Odd sem)</a>
      </li>
      <li class="list-group-item <?php echo $current_page === "attendance_even" ? "active" : ""?>"> 
        <a href="<?php echo base_url('attendance/even_sem14_15'); ?>">Attendance(2014-15 Even sem)<span class="label label-danger"> New</span></a>
      </li>
      <li class="list-group-item <?php echo $current_page === "feedback" ? "active" : ""?>">
       <a href="<?php echo base_url('audit/feedback'); ?>">Feedback</a>
     </li>
     <!-- <li class="list-group-item <?php echo $current_page === "exit_feedback" ? "active" : ""?>">
      <a href="<?php echo base_url('audit/exit_feedback'); ?>">
       Exit Feedback
     </a>
   </li> -->
   <li title="Results are not yet announced" class=" tips list-group-item text-danger <?php echo $current_page === "result" ? "active" : ""?>">
    <a href="<?php //echo base_url('audit/results') ?>">
      Results
    </a>
  </li>
  <li  class="list-group-item <?php echo $current_page === "slip" ? "active" : ""?>" >
    <a href="<?php echo base_url('audit/slip'); ?>">
      Registration Slip(2014-15 Odd sem)
    </a>
  </li>
  <li  class="list-group-item <?php echo $current_page === "slip_even" ? "active" : ""?>" >
    <a href="<?php echo base_url('audit/slip/even_sem14_15'); ?>">
      Registration Slip(2014-15 Even sem)<span class="label label-danger"> New</span>
    </a>
  </li>
  <li  class="list-group-item <?php echo $current_page === "calendar" ? "active" : ""?>">
    <a href="<?php echo base_url('audit/calendar'); ?>">
      Academic Calendar
    </a>
  </li>
</ul>
</div>
<div class="clearfix visible-xs hidden-print"></div>
<div class="col-sm-9 col-md-10 main">
