<?php echo validation_errors(); ?>
		<?php echo form_open('audit/slip/'); ?>
		<div class="form-group col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<label>Roll</label>
			<input name = "reg_slip_roll" type = "text" class="form-control" required></input>
		</div>
		<div class = "clearfix"></div>
		<div class="form-group col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<button type="submit" class="btn btn-success">Submit</button>
		</div>
	</form>
