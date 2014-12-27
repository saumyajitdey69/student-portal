<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
	<!-- <h3 class="text-info">OMAHA Fee Calculator</h3> -->
	<form action="#" class="form form-horizontal" method="POST" role="form">
		<br>
		<div class="form-group">
			<label for="inputSession" class="col-sm-5 control-label">OMAHA Session</label>
			<div class="col-sm-7">
				<select name="session" id="inputSession" class="form-control" required="required">
					<option value="Main">Main (Mess & Hostel Allotment)</option>
					<option value="Winter">Winter (Even Semester)</option>
					<option value="Summer">Summer (Hostel & Mess during summer vacation)</option>
					<option value="Last">Last (For Final Year Students)</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="inputMess_dues" class="col-sm-5 control-label">Mess Dues</label>
			<div class="col-sm-7">
				<input type="number" name="mess_dues" id="inputMess_dues" class="form-control" value="" required="required" title="Mess dues are uploaded by Hostel Office.">
			</div>
		</div>

		<hr>

		<div class="form-group">
			<label for="inputMess_advance" class="col-sm-5 control-label">Mess Advance</label>
			<div class="col-sm-7">
				<input type="number" name="mess_advance" id="inputMess_advance" class="form-control" value="" required="required" title="Mess dues are uploaded by Hostel Office.">
			</div>
		</div>
		<hr>

		<div class="form-group">
			<label for="inputMaintenance" class="col-sm-5 control-label">Maintenance Charge</label>
			<div class="col-sm-7">
				<input type="number" name="maintenance" id="inputMaintenance" class="form-control" value="" required="required" title="Mess dues are uploaded by Hostel Office.">
			</div>
		</div>

		<div class="form-group">
			<label for="inputSearent" class="col-sm-5 control-label">Seat Rent</label>
			<div class="col-sm-7">
				<input type="number" name="seatrent" id="inputSearent" class="form-control" value="" required="required" title="Mess dues are uploaded by Hostel Office.">
			</div>
		</div>
		<hr>
		<div class="form-group">
			<label for="inputEMC" class="col-sm-5 control-label tips" title="Electricity & Water Maintenance Charges">EWC</label>
			<div class="col-sm-7">
				<input type="number" name="EMC" id="inputEMC" class="form-control" value="" required="required" title="Mess dues are uploaded by Hostel Office.">
			</div>
		</div>

		<div class="form-group">
			<label for="inputCaution" class="col-sm-5 control-label">Caution Deposite</label>
			<div class="col-sm-7">
				<input type="number" name="Caution" id="inputCaution" class="form-control" value="" required="required" title="Mess dues are uploaded by Hostel Office.">
				<span class="help-block">Only for newly admitted students.</span>
			</div>
		</div>

		<div class="form-group">
			<label for="inputTotal" class="col-sm-5 control-label">Total</label>
			<div class="col-sm-7">
				<input type="number" name="total" id="inputTotal" class="form-control" value="" required="required" title="Mess dues are uploaded by Hostel Office.">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-5 col-sm-7">
				<button type="submit" class="btn btn-primary">Calculate</button>
			</div>
		</div>		
	</form>
</div>
