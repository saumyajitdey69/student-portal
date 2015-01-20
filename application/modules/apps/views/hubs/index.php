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
<br>
<table class="table dataTable table-hover table-condensed">
	<thead>
		<tr>
			<th>Hub address (IP)</th>
			<th>Hub name</th>
			<th>Active users</th>
			<th>Uptime</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($hub_list as $tuple) { 
			echo '<tr>';
			foreach($tuple as $attr) {
				echo '<td>'.$attr.'</td>';
			}
			echo '</tr>';
		}
		?>
	</tbody>
</table>