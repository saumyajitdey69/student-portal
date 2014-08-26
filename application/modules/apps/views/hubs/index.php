<legend>Active DC++ hubs</legend>
<table class="table table-hover table-condensed">
	<thead>
		<tr>
			<th>Hub Address</th>
			<th>Hub Name</th>
			<th>Number of Users</th>
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