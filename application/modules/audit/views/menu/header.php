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
       <li class="list-group-item <?php echo $current_page === "image-upload" ? "active" : ""?>">
        <a href="<?php echo base_url('upload'); ?>">Upload Profile Image</a>
      </li>
      <li class="list-group-item">
        <span class="collapse-caret collapsed dropdown-toggle" data-toggle="collapse" data-target="#attendance"></span>
        <div class="list-group-item-wrapper">
          <a href="#">Attendance</a>
        </div>

        <div id="attendance" class="collapse">
          <ul role="menu" class="list-group-item-menu">
            <li class="list-group-item">
              <div class="list-group-item-wrapper">
                <a href="<?php echo base_url('attendance/even_sem14_15'); ?>">Even Semester</a>
              </div>
            </li>
            <li class="list-group-item">
              <div class="list-group-item-wrapper">
                <a href="<?php echo base_url('attendance'); ?>">Odd Semester</a>
              </div>
            </li>
          </ul>
        </div>
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
  <li class="list-group-item">
    <span class="collapse-caret collapsed dropdown-toggle" data-toggle="collapse" data-target="#registration-slip"></span>
    <div class="list-group-item-wrapper">
      <a href="#">Registration Slip</a>
    </div>

    <div id="registration-slip" class="collapse">
      <ul role="menu" class="list-group-item-menu">
        <li class="list-group-item">
          <div class="list-group-item-wrapper">
            <a href="<?php echo base_url('audit/slip/even_sem14_15'); ?>">Even Semester</a>
          </div>
        </li>
        <li class="list-group-item">
          <div class="list-group-item-wrapper">
            <a href="<?php echo base_url('audit/slip'); ?>">Odd Semester</a>
          </div>
        </li>
      </ul>
    </div>
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
