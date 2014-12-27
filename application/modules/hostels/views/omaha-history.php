hostel and mess history
		<hr>
		<legend id="allotmenthistory">Allotment History</legend>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#hostelhistory" data-toggle="tab">Hostel History</a></li>
			<li><a href="#messhistory" data-toggle="tab">Mess History</a></li>
		</ul>

		Tab panes
		<div class="tab-content">
			<div class="tab-pane fade in active" id="hostelhistory">
				<?php if(!empty($hostelhistory)): ?>

					<?php foreach ($hostelhistory as $key => $item): ?>
						<li class="list-group-item <?php echo $item['status'] == '1' ? 'text-success' : '' ?>">
							<?php echo $item['hostel']  ?>, Floor #: <?php echo $item['floor'] ?>, Room #: <?php echo $item['room'] ?>
							<br>
							Last change: <?php echo $item['timestamp']; ?>

						<?php endforeach ?>

					<?php endif; ?>
				</div>
				<div class="tab-pane fade" id="messhistory">
					<?php if(!empty($messhistory)): ?>
						<ul>
							<?php foreach ($messhistory as $key => $item): ?>
								<li class="list-group-item <?php echo $item['status'] == '1' ? 'text-success' : '' ?>">
									Mess Name: <?php echo $item['mess']  ?>
									<br>
									Last change: <?php echo $item['timestamp']; ?>
								</li>
							<?php endforeach ?>

						</ul>
					<?php endif; ?>
				</div>
			</div> 
			</div>