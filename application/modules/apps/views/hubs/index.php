<table class="table dataTable table-hover table-condensed">
	<thead>
		<tr>
			<th>Hub address (IP:Port)</th>
			<th>Hub name</th>
			<th>Active users</th>
			<th>Uptime</th>
			<th><?php echo count($hub_list) ?> hubs online</th>
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