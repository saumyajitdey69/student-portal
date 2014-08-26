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
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Important note</h3>
    </div>
    <div class="panel-body">
        <ul>
            <li>Once you are registered for the course you cannot edit it</li>
            <li>Fill the semester and year for all the courses and you will be able to print registration slip</li>
            <li>For printing registration slip reclick on Registration slip on side menu</li>
        </ul>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <legend>Courses Registered for Make up </legend>
<div class="alert hidden alert-makeup">
</div>

  <table class="table table-hover table-condensed table-striped table-bordered">
     <thead>
        <tr>
           <th>S.NO</th>
           <th>Course Id</th>
           <th>Course Title</th>
           <th>Semester</th>
           <th>Year</th>
           <th>Action</th>
       </tr>
   </thead>
   <tbody>

       <?php foreach ($reg_course_id as $key => $value): ?>
        <tr>
        <td class="hidden id">
               <?php echo $reg_id[$key]; ?>
           </td>
            <td>
               <?php echo ($key+1); ?>
           </td>
           <td>
               <?php echo $reg_course_id[$key]; ?>
           </td>
           <td>
               <?php echo strtoupper($reg_course_name[$key]); ?>
           </td>
           <td>
            <div class="form-group" style="margin-bottom:0" >
                <input type="hidden" name="course_id" value='.$reg_course_id[$key].' >
                <div class="col-sm-16"> 
                    <select name="semester"   class="form-control input-sm sem" requir="required" > 
                        <option value="">select one</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
                </div>
            </div>
        </td>

        <td>
            <div class="form-group" style="margin-bottom:0">					
                <select name="year"  class="form-control input-sm year" required="required">
                    <option value="">select one</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>							
                </select>
            </div>
        </td>
        <td>
            <button type="submit" id="btnsubmit" name="btnsubmit" value="update" class="btn btn-success btn-sm pull-center btn-update" data-loading-text="Updating" >Update</button>
        </td>
    </tr>
<?php endforeach; ?>

</table>
</div>
<div style = "<?php if(!isset($flag)) echo 'display:none;'; ?>" >
    <legend>Backlog</legend>
    <table  id = "backlog_course_table" class="table table-bordered table-condensed">
        <th>S.No.</th>
        <th>Course Code</th>
        <th>Course Title</th>
        <th>Credit</th>
        <th>Type</th>
        <?php
                //printing out all course detail
        foreach ($reg_course_id as $key => $value){
            $i = 1;
            echo "<tr>";
            echo "<td>";
            echo ($i+1);
            echo "</td>";
            echo "<td>";
            echo $reg_course_id[$key];
            echo "</td>";
            echo "<td>";
            echo strtoupper($reg_course_name[$key]);
            echo "</td>";
                // echo "<td>";
                // echo $reg_course_credit[$key];
                // echo "</td>";
                // echo "<td>";
                // echo $type[$reg_study_exam[$key]];
                // echo "</td>";
            echo "</tr>";

        }
        ?>
    </table>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <a href="<?php echo base_url('/makeup/makeup_slip') ?>" type="button" class="btn btn-default btn-sm">Click here to generate registration slip</a>
</div>



