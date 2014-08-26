<div class="container-full">
	<div class="row">
		<?php //$this->load->view('hostel/allotmentsidebar') ?>
		<div id ="loadingDiv" style="display:none;position: absolute; width: 100%; height: 100%;background: rgba(0, 0, 0, 0.46); z-index: 1000;">
			<center>
				<img style = "margin-top:10%;" src="/student/assets/images/728.GIF">
			</center>
		</div>
		<div class="clearfix visible-xs"></div>
		<div class="col-xs-12 col-sm-9 col-md-10 .col-md-offset-1">
			<br>
			<form class = "form-inline" role="form" method="POST">
				<div class="col-md-offset-2 col-md-9 col-xs-9 col-sm-9 col-md-9">
			    	<div class="form-group">
			    	    <label for="hostelName">Select Hostel</label>
			    	    <select class="form-control" id = "hostelName" onchange = "floorLookup()">
			    	    	<option value = "">--Select One--</option>
			    	    	<?php
			    	    		$hostel_detail = $hostel_mess_detail['hostel'];
			    	    		foreach ($hostel_detail as $hostel) {
			    	    			echo "<option value = '" . $hostel['hostelid'] . "'>";
			    	    			echo $hostel['name'];
			    	    			echo "</option>";
			    	    		}
			    	    	?>
			    	    </select>
			    	</div>
			    	<div class="form-group">
			    	    <label for="floor">Select Floor</label>
			    	    <select class="form-control" id = "floor" onchange = "roomLookup()">
			    	    	<option value = "">--Select One--</option>
			    	    </select>
			    	</div>
				</div>
				<div class="row">
				<div class="col-md-offset-2 col-xs-9 col-sm-9 col-md-9">
				<br>
				<center>
					<div id = "noRoomAlert" class="alert alert-danger" style = "display:none;">Sorry! No Rooms Found.</div>
				</center>
			    <table id = "roomListTable">
			    	<thead></thead>
			    	<tbody>
			    	</tbody>
			    </table>
				</div>
				<div class="clearfix"></div>
				<br>
				<div class="col-md-offset-3 col-xs-5 col-sm-5 col-md-5">
			    	<button type="button" class="btn btn-default btn-lg btn-block" onclick = "bookRoom()">Book Room</button>
				</div>
				</div>
				<div class="clearfix visible-xs"></div>
			</form>
		</div>
	</div>
</div>