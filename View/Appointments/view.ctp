<?php
	$this->Nodes->set($node);
	$dateFormat = Configure::read('Reading.date_time_format');
	$startDate = date($dateFormat, strtotime($this->Nodes->field('AppointmentDetail.start_date')));
	$endDate = date($dateFormat, strtotime($this->Nodes->field('AppointmentDetail.end_date')));
?>
<div class="content">
<div id="node-<?php echo $this->Nodes->field('id'); ?>" class="node node-type-<?php echo $this->Nodes->field('type'); ?>">
	<h2><?php echo $this->Nodes->field('title'); ?></h2>

	<div class="body">
		<h3><?php echo __('Appointment Details'); ?></h3>
		<div>
			<?php echo $this->Nodes->field('body'); ?>
		</div>
		<h3><?php echo __('Where'); ?></h3>
		<div>
			<?php echo $this->Nodes->field('AppointmentDetail.location'); ?>
		</div>
		<h3><?php echo __('When'); ?></h3>
		<div>
			<?php echo "{$startDate} - {$endDate}"; ?>
		</div>
		<?php echo $this->Html->link('Return to Appointments Calendar', '/appointment'); ?>
	</div>
</div>
</div>
