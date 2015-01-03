<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 hidden-print sidebar" role="navigation">
    <ul class="list-group">
      <li class="list-group-header">WSDC OMAHA</li>
      <li class="list-group-item <?php echo (isset($current_page) && $current_page === "home")?"active":""; ?>">
       <a href="<?php echo base_url("hostels/"); ?>">
        Home
      </a>
    </li>
    <li class="list-group-item <?php echo (isset($current_page) && $current_page === "slip")?"active":""; ?>">
      <a href="<?php echo base_url("hostels/"); ?>">
        Mess dues
      </a>
    </li>
    <li class="list-group-item <?php echo (isset($current_page) && $current_page === "transaction-histroy")?"active":""; ?>">
      <a href="<?php echo base_url("hostels/"); ?>">
        Transaction History
      </a>
    </li>
    <li class="list-group-item <?php echo (isset($current_page) && $current_page === "allotment-histroy")?"active":""; ?>">
      <a href="<?php echo base_url("hostels/"); ?>">
        Allotment History
      </a>
    </li>
    <li class="list-group-item <?php echo (isset($current_page) && $current_page === "slip")?"active":""; ?>">
      <a href="<?php echo base_url("hostels/no_dues"); ?>">
        No Dues Certificate <br> <small>(Winter Session)</small>
      </a>
    </li>
    <li class="list-group-header">INFORMATION CORNER</li>
    <li class="list-group-item <?php echo (isset($current_page) && $current_page === "getting-started")?"active":""; ?>">
      <a href="<?php echo  base_url('hostels/') ?>">Getting Started</a>
    </li>
    <li class="list-group-item <?php echo (isset($current_page) && $current_page === "fee-calculator")?"active":""; ?>">
      <a href="<?php echo base_url("hostels/calculator"); ?>">
       Fee calculator
     </a>
   </li>
   <li class="list-group-item <?php echo (isset($current_page) && $current_page === "payment-procedure")?"active":""; ?>">
    <a href="<?php echo  base_url('hostels/rules/winter') ?>">Payment Procedure</a>
  </li>
  <li class="list-group-item <?php echo (isset($current_page) && $current_page === "sms")?"active":""; ?>">
    <a href="<?php echo  base_url('hostels/') ?>">SMS Services</a>
  </li>
  <li class="list-group-item <?php echo (isset($current_page) && $current_page === "faqs")?"active":""; ?>">
    <a href="<?php echo  base_url('hostels/') ?>">FAQs</a>
  </li>

  <li class="list-group-header">PAYMENT MODES</li>
  <li class="list-group-item <?php echo (isset($current_page) && $current_page === "wsdc_collect")?"active":""; ?>">
    <a href="<?php echo base_url("hostels/wsdc_collect/"); ?>">
      WSDC Collect
    </a>
  </li>
  <li class="list-group-item <?php echo (isset($current_page) && $current_page === "wsdc_collect")?"active":""; ?>">
    <a href="#">
      State Bank Collect
    </a>
  </li>
     <!--  <li class="list-group-item <?php echo (isset($current_page) && $current_page === "slip")?"active":""; ?>">
        <a href="<?php echo base_url("hostels/hostel_slip"); ?>">
          Room Allotment Slip
        </a>
      </li> -->

    </ul>
  </div>
  <div class="clearfix visible-xs hidden-print"></div>
  <div class="col-sm-12 col-md-10 main">
    <!-- <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"> -->
