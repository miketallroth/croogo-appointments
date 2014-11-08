<?php

	Configure::write('debug', 0);

	$json = array();
	foreach($nodes as $node){
		$json[] = array(
			'id'=>$node['Node']['id'],
			'title'=>$node['Node']['title'],
			'start'=>$node['AppointmentDetail']['start_date'],
			'end'=>$node['AppointmentDetail']['end_date'],
			'url'=>$this->Html->url("/{$node['Node']['type']}/{$node['Node']['slug']}")
		);
	}
	echo json_encode($json);
