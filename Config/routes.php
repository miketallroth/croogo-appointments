<?php
// Overrides default route to Nodes controller.
// We do this to utilize our custom views.

$alias = 'appointment';
CroogoRouter::connect('/' . $alias, array(
	'plugin' => 'appointments', 'controller' => 'appointments',
	'action' => 'index', 'type' => $alias
));
CroogoRouter::connect('/' . $alias . '/archives/*', array(
	'plugin' => 'appointments', 'controller' => 'appointments',
	'action' => 'index', 'type' => $alias
));
CroogoRouter::connect('/' . $alias . '/:slug', array(
	'plugin' => 'appointments', 'controller' => 'appointments',
	'action' => 'view', 'type' => $alias
));
CroogoRouter::connect('/' . $alias . '/term/:slug/*', array(
	'plugin' => 'appointments', 'controller' => 'appointments',
	'action' => 'term', 'type' => $alias
));

