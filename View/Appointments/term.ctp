<div class="nodes">
	<h2><?php echo $title_for_layout; ?></h2>

	<?php
		if (count($nodes) == 0) {
			echo __d('croogo', 'No items found.');
		}
	?>

	<?php
		foreach ($nodes as $node):
			$this->Nodes->set($node);
			$dateFormat = Configure::read('Reading.date_time_format');
			$startDate = date($dateFormat, strtotime($this->Nodes->field('AppointmentDetail.start_date')));
			$endDate = date($dateFormat, strtotime($this->Nodes->field('AppointmentDetail.end_date')));
	?>
	<div id="node-<?php echo $this->Nodes->field('id'); ?>" class="node node-type-<?php echo $this->Nodes->field('type'); ?>">
		<h2><?php echo $this->Html->link($this->Nodes->field('title'), $this->Nodes->field('url')); ?></h2>
		<?php
			echo $this->Nodes->info();
			echo $this->Nodes->body();
			echo "<div class=\"detail\">{$startDate} - {$endDate}</div>";
			echo $this->Nodes->moreInfo();
		?>
	</div>
	<?php
		endforeach;
	?>

	<div class="paging"><?php echo $this->Paginator->numbers(); ?></div>
</div>
