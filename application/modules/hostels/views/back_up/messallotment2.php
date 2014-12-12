<div class="container-full">
	<div class="row">
		<div id = "loadingDiv" style="display:none;position: absolute; width: 100%; height: 100%;background: rgba(0, 0, 0, 0.46); z-index: 1000;">
			<img src="/student/assets/images/728.GIF">
		</div>
		<?php //$this->load->view('hostel/allotmentsidebar') ?>
		<div class="clearfix visible-xs"></div>
		<div class="col-xs-12 col-sm-9 col-md-10">
			<br>
			<form class = "form-inline" role="form" method="POST">
				<div class="col-md-9 col-xs-9 col-sm-9 col-md-9">
					<div class="form-group col-md-9 col-xs-9 col-sm-9 col-md-7">
						<label for="floor">Mess</label>
						<select class="form-control" id = "mess">
							<option value = "">--Select One--</option>
							<?php
							$mess_detail = $hostel_mess_detail['mess'];
							foreach ($mess_detail as $mess) {
								echo "<option value = '" . $mess['messid'] . "'>";
								echo $mess['name'];
								echo "</option>";
							}
							?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-8 col-sm-8 col-md-8">
						<br>
						<center>
							<div id = "noRoomAlert" class="alert alert-danger" style = "display:none;">Sorry! Mess capacity is full.</div>
						</center>
					</div>
					<div class="clearfix"></div>
					<br>
					<div class="col-xs-5 col-sm-5 col-md-5">
						<button type="button" class="btn btn-default btn-lg btn-block" onclick = "bookMess()">Book Mess</button>
					</div>
				</div>
				<div class="clearfix visible-xs"></div>
				<div class="col-md-offset-3 col-xs-5 col-sm-5 col-md-5">
				<br>
					<div class="fb-like" data-href="https://www.facebook.com/wsdc.nitw" data-layout="standard" data-action="recommend" data-show-faces="true" data-share="true"></div>
				</div>
			</form>
		</div>
	</div>
</div>