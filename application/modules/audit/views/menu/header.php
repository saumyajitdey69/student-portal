<div class="row">
  <div class="col-sm-3 col-md-2 hidden-print sidebar" role="navigation">
    <ul class="list-group">
      <li class="list-group-header">ACADEMIC SECTION</li>
      <li class="list-group-item <?php echo $current_page === "home" ? "active" : ""?>">
        <a href="<?php echo base_url('audit/home'); ?>">Home</a>
      </li>
      <li class="list-group-item <?php echo $current_page === "attendance" ? "active" : ""?>"> 
        <a href="<?php echo base_url('attendance'); ?>">Attendance</a>
      </li>
      <li class="list-group-item <?php echo $current_page === "feedback" ? "active" : ""?>">
       <a href="<?php echo base_url('audit/feedback'); ?>">Feedback</a>
     </li>
     <li class="list-group-item <?php echo $current_page === "exit_feedback" ? "active" : ""?>">
      <a href="<?php echo base_url('audit/exit_feedback'); ?>">
       Exit Feedback
     </a>
   </li>
   <li  class="list-group-item <?php echo $current_page === "result" ? "active" : ""?>">
    <a href="<?php echo base_url('audit/results') ?>">
      Results
    </a>
  </li>
  <li  class="list-group-item <?php echo $current_page === "slip" ? "active" : ""?>" >
    <a href="<?php echo base_url('audit/slip'); ?>">
      Registration Slip
    </a>
  </li>
  <li  class="list-group-item <?php echo $current_page === "calendar" ? "active" : ""?>">
    <a href="<?php echo base_url('audit/calendar'); ?>">
      Academic Calendar
    </a>
  </li>
  <!-- <li class="list-group-header">Another list header</li> -->
  <!-- <li class="list-group-item">
    <span class="collapse-caret collapsed dropdown-toggle" data-toggle="collapse" data-target="#profile"></span>
    <div class="list-group-item-wrapper">
      <div class="dropdown pull-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
        <ul role="menu" class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </div>
      <a href="#">Profile</a>
    </div>
    <div id="profile" class="collapse">
      <ul role="menu" class="list-group-item-menu">
        <li class="list-group-item">
          <div class="list-group-item-wrapper">
            <div class="dropdown pull-right">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
              <ul role="menu" class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>

            <a href="#">Action</a>
          </div>
        </li>
      </ul>
    </div>
  </li>
  <li class="list-group-item">
    <span class="collapse-caret collapsed dropdown-toggle" data-toggle="collapse" data-target="#settings"></span>
    <div class="list-group-item-wrapper">
      <div class="dropdown pull-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
        <ul role="menu" class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </div>

      <a href="#">
        Settings
      </a>
    </div>

    <div id="settings" class="collapse">
      <ul role="menu" class="list-group-item-menu">
        <li class="list-group-item">
          <div class="list-group-item-wrapper">
            <div class="dropdown pull-right">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
              <ul role="menu" class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>

            <a href="#">Action</a>
          </div>
        </li>
        <li class="divider"></li>
        <li class="list-group-item">
          <span class="dropdown-toggle collapse-caret collapsed" data-toggle="collapse" data-target="#sub-settings"></span>
          <div class="list-group-item-wrapper">
            <div class="dropdown pull-right">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
              <ul role="menu" class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>

            <a href="#">
              Separated link
            </a>
          </div>

          <div class="collapse" id="sub-settings">
            <ul role="menu" class="list-group-item-menu">
              <li class="list-group-item">
                <div class="list-group-item-wrapper">
                  <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                    <ul role="menu" class="dropdown-menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                    </ul>
                  </div>

                  <a href="#">Action 1</a>
                </div>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </li> -->
 <!--  <li class="divider"></li>
 <li class="list-group-item"><a href="#">Help</a></li> -->
</ul>
</div>
<div class="clearfix visible-xs hidden-print"></div>
<div class="col-sm-9 col-md-10 main">
<!-- <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"> -->
<!--   <br> -->
