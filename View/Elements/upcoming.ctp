<?php

	$appointments = $this->requestAction(array('plugin'=>'appointments', 'controller'=>'appointments', 'action'=>'upcoming'), array('return'));

	if (!empty($appointments)) {
		echo '<ul>';
		foreach($appointments as $appointment){
			echo $this->Html->tag('li', $this->Html->link($appointment['Node']['title'], $appointment['Node']['path']));
		}
		echo '</ul>';
	} else {
		echo 'There are no future appointments';
	}

