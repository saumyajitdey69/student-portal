<div class="row">
    <div class="col-md-4 col-sm-4 col-lg-4 offset-md-3">
        <form role="form" method="post" action="<?php echo base_url("audit/feedback/setcgpa"); ?>" class="form-horizontal">
          <div class="form-group">
            <label for="cgpa" class="control-label">Enter CGPA(till previous semester)</label>
        </div>
        <div class="form-group">
            <!-- <label for="inputCgpa" class="col-sm-2 control-label">Cgpa:</label> -->
            <div class="col-sm-10">
                <input type="text" name="cgpa" id="inputCgpa" class="form-control" value="" required="required" title="Enter cgpa">
            </div>
        </div>
                <!-- <div class="form-group">
                    <select name="cgpa" id="cgpa" class="form-control" required="required">
                        <option value=""> Select Option </option>
                        <option value="1000000000000">9.0 or above</option>
                        <option value=   "1000000000">Between 8.0 and 9.0</option>
                        <option value=      "1000000">Between 7.0 and 8.0</option>
                        <option value=         "1000">Between 6.0 and 7.0</option>
                        <option value=            "1">Less than 6.0</option>
                        <option value=            "1">First Year First Semester Student (Not Applicable)</option>
                    </select>
                </div> -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">SUBMIT & PROCEED &nbsp; &nbsp;<span class="glyphicon glyphicon-circle-arrow-right"></span> </button>
                </div>
            </form>

        </div>
    </div>