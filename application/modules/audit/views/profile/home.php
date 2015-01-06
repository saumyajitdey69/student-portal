<?php 
if($this->session->flashdata('success') == TRUE) 
  echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>'.$this->session->flashdata('success').'</div>';

if($this->session->flashdata('warning') == TRUE) 
  echo '<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>'.$this->session->flashdata('warning').'</div>';

if($this->session->flashdata('info') == TRUE)
  echo '<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>'.$this->session->flashdata('info').'</div>';

if($this->session->flashdata('danger') == TRUE)
  echo '<div class="alert alert-danger"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>'.$this->session->flashdata('danger').'</div>';
?>
<?php
if($submitted === '0')
{
  $invalid_details['first_name'] = set_value('first_name');
  $invalid_details['middle_name'] = set_value('middle_name');
  $invalid_details['last_name'] = set_value('last_name');
  $invalid_details['registration_number'] = set_value('registration_number');
  $invalid_details['roll_number'] = set_value('roll_number');
  $invalid_details['gender'] = set_value('gender');
  $invalid_details['birthday'] = set_value('dob');
  $invalid_details['country'] = set_value('nationality');
  $invalid_details['name'] = set_value('name');
  $invalid_details['passport'] = set_value('passport');
  $invalid_details['joining_year'] = set_value('yearofjoining');
  $invalid_details['course'] = set_value('course');
  $invalid_details['branch'] = set_value('branch');
  $invalid_details['current_section'] = set_value('section');
  $invalid_details['email'] = set_value('email');
  $invalid_details['mobile'] = set_value('phone_number');
  $invalid_details['emergency_contact'] = set_value('emergency_contact');
  $invalid_details['sbh_account'] = set_value('sbh_account');
  $invalid_details['hostel_room'] = set_value('room_number');
  $invalid_details['hostel'] = set_value('hostel');
  $invalid_details['mess'] = set_value('mess');
  $details = (object) $invalid_details;
}
else if(!empty($submitted))
{
  echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>'.$submitted.'</div>';
}

?>
<?php echo validation_errors(); ?>
<h3 class="text-primary"> &nbsp; My Profile</h3>

<form class="form-horizontal" name="form_profile" role="form" action=" <?php echo base_url("audit/profile/validate"); ?>" method="POST">
  <div class="row">
    <div class="col-md-offset-1 col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <div class="form-group">
        <label for="inputFirstName" class="col-sm-4 control-label">First Name</label>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
          <input type="text" name="first_name" id="inputFirstName" class="form-control input-sm" value="" required="required"  title="only alphabets" placeholder="Madatory">
        </div>
      </div>
      <div class="form-group">
        <label for="inputMiddleName" class="col-sm-4 control-label">Middle Name</label>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
          <input type="text" name="middle_name" id="inputMiddlName" class="form-control input-sm" value=""  title="only alphabets" placeholder="Optional">
        </div>
      </div>
      <div class="form-group">
        <label for="inputLastName" class="col-sm-4 control-label">Last Name</label>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
          <input type="text" name="last_name" id="inputLastName" class="form-control input-sm" value="" required="required"  title="only alphabets" placeholder="Mandatory">
        </div>
      </div>
      <div class="form-group well">
        <label for="inputRegistration_number" class="col-sm-4 control-label">Registration Number <span class="text-danger">**</span></label>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 "> 
          <input type="text" name="registration_number" id="inputRegistration_number"  class="form-control input-sm" value="" required="required" title="" placeholder="First year roll number" >
          <span class="help-block">Must be same as on your Institute ID Card. <p class="text-danger"><strong>PG students <u>should append </u>the prefix to registration number (e.g of registration number for PG student ME12343).</strong></p> </span>
        </div>
      </div>
<!-- <div class="form-group hidden">
<label for="inputRegistration_number" class="col-sm-4 control-label">Registration Number</label>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
<input type="text" name="registration_number1" id="inputRegistration_number"  class="form-control input-sm" value="" required="required" title="" placeholder="First year roll number" >
</div>
</div> -->
<div class="form-group well">
  <label for="inputRoll_number" class="col-sm-4 control-label">Roll Number<span class="text-danger">**</span></label>
  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
    <input type="text" name="roll_number" id="inputRoll_number" class="form-control input-sm"  required="required"  >
    <span class="help-block">Must be same as on Institute ID card. Do not swap roll number and registration number, check throughly before submitting. <p class="text-danger"><strong>UG students <u>must not</u> use 'UG' prefix.</strong></p></span>
  </div>
</div>
<!-- <div class="form-group hidden">
<label for="inputRoll_number" class="col-sm-4 control-label">Roll Number</label>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
<input type="text" name="roll_number1" id="inputRoll_number" class="form-control input-sm"  required="required"  >
</div>
</div> -->
<!--  <div class="form-group">
<div class="col-sm-offset-4 col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
<input type="checkbox" id="swap" name="swap"> Swap reg no. and roll no.
</div> -->
<!-- </div> -->
<div class="form-group">
  <label for="inputGender" class="col-sm-4 control-label">Gender</label>
  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
    <select name="gender" id="inputGender" class="form-control input-sm">
      <option value="">-- Select One --</option>
      <option value="M">Male</option>
      <option value="F">Female</option>
    </select>
  </div>
</div>
<div class="form-group">
  <label for="inputDob" class="col-sm-4 control-label">Date of Birth</label>
  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
    <input type="date" name="dob" id="inputDob" class="form-control input-sm" value="" required="required" title="">
  </div>
</div>
<div class="form-group">
  <label for="nationality" class="col-sm-4 control-label">Nationality</label>
  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
    <input type="text" name="nationality" id="inputNationality" class="form-control input-sm" value="" required="required" >
  </div>
</div>
<div class="form-group">
  <label for="inputPassport" class="col-sm-4 control-label">Passport</label>
  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
    <input type="text" name="passport" id="inputPassport" class="form-control input-sm" value="" >
  </div>
</div>
<legend>Contact Details</legend>
<div class="form-group well">
  <label for="inputEmail" class="col-sm-4 control-label">Email Id<span class="text-danger">**</span></label>
  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
    <input type="email" name="email" id="inputEmail" class="form-control input-sm" value="" required="required" rel="tooltip" title="Registered email ID" placeholder="Valid email ID">
    <span class="help-block">Always use valid email id. In case you forgot the password, a reset link will be sent to this email id.</span>
  </div>
</div>
<div class="form-group well">
  <label for="inputPhone_number" class="col-sm-4 control-label">Phone No.<span class="text-danger">**</span></label>
  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
    <input type="text" name="phone_number" id="inputPhone_number" class="form-control input-sm" value="" required="required" max='10' title="10 Digit phone number">
    <span class="help-block">Enter only 10 digit phone number. Do not use +91 or 0 or 91 prefix.</span>
  </div>
</div>
<div class="form-group">
  <label for="inputEmergency_contact" class="col-sm-4 control-label">Emergency Contact</label>
  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
    <input type="text" name="emergency_contact" id="inputEmergency_contact" class="form-control input-sm" value="" required="required" title="" placeholder="Parent phone number">
    <span class="help-block">Enter only 10 digit phone number. Do not use +91 or 0 or 91 prefix.</span>
  </div>
</div>
</div>
<div class="clearfix">

</div>
<div class=" col-md-offset-1 col-xs-12 col-sm-12 col-md-6 col-lg-6">
  <legend>Course Details</legend>
  <div class="form-group well ">
    <label for="inputYearofjoining" class="col-sm-4 control-label">Year of Joining<span class="text-danger">**</span></label>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
      <input type="text" name="yearofjoining" id="inputYearofjoining" class="form-control input-sm" value="" required="required"  title="">
    </div>
  </div>
  <div class="form-group">
    <label for="inputCourses" class="col-sm-4 control-label">Course</label>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
      <select name="course" id="inputCourse" class="form-control input-sm" >
        <option value="">-- Select One --</option>
        <option value="btech">B. Tech.</option>
        <option value="mtech">M. Tech.</option>
        <option value="phd">PhD</option>
        <option value="msc">MSc.</option>
        <option value="mca">MCA</option>
        <option value="mba">MBA</option>
        <option value="Msc. Tech">MSc.Tech</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputBranch" class="col-sm-4 control-label">Branch</label>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
      <select name="branch" id="inputBranch" class="form-control input-sm">
        <option value="">-- Select One --</option>
        <option value="civil">Civil Engineering</option>
        <option value="eee">Electrical and Electronics Engineering</option>
        <option value="mech">Mechnical Engineering</option>
        <option value="ece">Electronics and Communication Engineering</option>
        <option value="meta">Metallurgical and Materials Engineering</option>
        <option value="che">Chemical Engineering</option>
        <option value="cse">Computer Science and Engineering</option>
        <option value="biotech">Biotechnology</option>
        <option value="math">Mathematics</option>
        <option value="phy">Physics</option>
        <option value="chem">Chemistry</option>
        <option value="humanity">Humanities and Social Science</option>
        <option value="mba">School of Management</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputBranch" class="col-sm-4 control-label">Section</label>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
      <select name="section" id="inputSection" class="form-control input-sm">
        <option value="">-- Select One --</option>
        <option value="0">No Section</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
        <option value="F">F</option>
        <option value="G">G</option>
        <option value="H">H</option>
        <option value="K">K</option>
        <option value="L">L</option>
        <option value="M">M</option>
        <option value="N">N</option>
      </select>
    </div>
  </div>
  <legend>Bank Details</legend>
  <div class="form-group">
    <label for="inputSbh_account" class="col-sm-4 control-label">SBH Account No.</label>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
      <input type="text" name="sbh_account" id="inputSbh_account" class="form-control input-sm" value=""  title="">

    </div>
  </div>
  <div class="form-group">
  <div class="col-sm-offset-4 col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
    <button type="submit" id="submit_profile" class="btn btn-block btn-lg btn-success"> Update my profile</button>
  </div>
</div>
</div>

<!-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
<legend> Hostel Details</legend>
<div class="form-group">
<label for="inputHostel" class="col-sm-4 control-label">Hostel</label>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
<select name="hostel" id="inputHostel" class="form-control input-sm">
<option value="">-- Select One --</option>
<option value="day">Day Scholar</option>
<option value="1">Azad Hall (1st Block)</option>
<option value="2">Bose Hall (2nd Block)</option>
<option value="3">Ambedkar Hall (3rd Block)</option>
<option value="4">Babha Hall (4th Block)</option>
<option value="5">Gandhi Hall (5th Block)</option>
<option value="6">Gokhale Hall (6th Block)</option>
<option value="7">Radhakrishnan Hall (7th Block)</option>
<option value="8">Raman Hall (8th Block)</option>
<option value="9">Nehru Hall (9th Block)</option>
<option value="10">Patel Hall (10th Block)</option>
<option value="11">Tagore Hall (11th Block)</option>
<option value="12">Viswesvraya Hall (12th Block)</option>
<option value="13">Rajendra Prasad Hall (13th Block)</option>
<option value="14">Vikram Sarabhai Hall (14th Block)</option>
<option value="1k">1K Hall of Residence</option>
<option value="1.8k">1.8K Ultra Mega Hostel</option>
<option value="dasa">International Student Hall</option>
<option value="ph">Priyadarshini Hall (LH-PH)</option>
<option value="sh">Sarojini Hall(LH-SH)</option>
<option value="lha">New Ladies Hostel - A (New LH-A)</option>
<option value="lhb">New Ladies Hostel - B (New LH-B)</option>
<option value="lhc">New Ladies Hostel - C (New LH-C)</option>
</select>
</div>
</div>
<div class="form-group">
<label for="inputRoom_number" class="col-sm-4 control-label">Hostel Room No.</label>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
<input type="text" name="room_number" id="inputRoom_number" class="form-control input-sm" value="" title="">
</div>
</div>
<div class="form-group">
<label for="inputmess" class="col-sm-4 control-label">Mess</label>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
<select name="mess" id="inputMess" class="form-control input-sm">
<option value="">-- Select One --</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="A">IFC-A</option>
<option value="B">IFC-B</option>
</select>

</div>
</div>
</div> -->

</div>  <!-- /row-->
</form>
<script>
  document.form_profile.first_name.value = '<?php echo $details->first_name; ?>';
  document.form_profile.last_name.value = '<?php echo $details->last_name; ?>';
  document.form_profile.middle_name.value = '<?php echo $details->middle_name; ?>';
  document.form_profile.registration_number.value = '<?php echo $details->registration_number; ?>';
  document.form_profile.roll_number.value = '<?php echo $details->roll_number; ?>';
// document.form_profile.registration_number1.value = '<?php echo $details->registration_number; ?>';
// document.form_profile.roll_number1.value = '<?php echo $details->roll_number; ?>';
document.form_profile.gender.value = '<?php echo $details->gender; ?>';
document.form_profile.dob.value = '<?php echo $details->birthday; ?>';
document.form_profile.nationality.value = '<?php echo $details->country; ?>';
document.form_profile.passport.value = '<?php echo $details->passport; ?>';
document.form_profile.yearofjoining.value = '<?php echo $details->joining_year; ?>';
document.form_profile.course.value = '<?php echo $details->course; ?>';
document.form_profile.branch.value = '<?php echo $details->branch; ?>';
document.form_profile.section.value = '<?php echo $details->current_section; ?>';
document.form_profile.email.value = '<?php echo $details->email; ?>';
document.form_profile.phone_number.value = '<?php echo $details->mobile; ?>';
document.form_profile.emergency_contact.value = '<?php echo $details->emergency_contact; ?>';
document.form_profile.sbh_account.value = '<?php echo $details->sbh_account; ?>';
// document.form_profile.hostel.value = '<?php echo $details->hostel; ?>';
// document.form_profile.room_number.value = '<?php echo $details->hostel_room; ?>';
// document.form_profile.mess.value = '<?php echo $details->mess; ?>';

</script>
