<form id="student-search" class="form hidden-print">
	<div class="form-group">
		<div class="input-group">
			<input id="roll" name = "roll" type = "text" class="form-control input-lg" placeholder="Search for students" required>

			<span class="input-group-btn">
				<button id="bt-get-students" type="submit" class="btn btn-lg btn-info"> <span class="glyphicon glyphicon-search"></span> search</button>
			</span> 

		</div><!-- /input-group -->
		<p class="help-block">NOT: Use comma to seperate different roll number or name of students</p>
	</div>
</form>

<hr>
<div class="row hidden" id="results">
	<table class="table table-hover table-condensed" >
		<thead>
			<th style="width:250px">Student Name</th>
			<th class="col-md-1">Roll No</th>
			<th><span class="tips" title="Registration Number">Reg No</span></th>
			<th class="col-md-1">Branch</th>
			<th>Joining year</th>
			<th>Mobile</th>
			<th>Emergency No.</th>
			<th class="col-md-3">Email ID</th>
		</thead>
		<tbody id="results-table">

		</tbody>
	</table>
	<hr>
</div>
<!-- Button trigger modal -->
<button class="btn btn-primary btn-lg pull-right hidden-print" data-toggle="modal" data-target="#emailModal">
	Send email to students
</button>

<!-- Modal -->
<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="emailModalLabel">Compose email</h4>
			</div>
			<div class="modal-body">
				<div class="row" id="message">
					<form class="form form-horizontal" id="students-message"  role="form">
						<div class="form-group">
							<label for="inputsubject" class="col-sm-2 control-label">Subject</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="subject" id="inputsubject" placeholder="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputmessage" class="col-sm-2 control-label">Message</label>
							<div class="col-sm-10">
								<textarea type="text" class="form-control" name="message" rows="6" id="inputmessage" placeholder=""></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary"> <span class="glyphicon glyphicon-envelope"></span> Send email to all</button>
						</div>
					</form>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

