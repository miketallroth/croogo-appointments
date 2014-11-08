<?php
/**
 * Appointments Activation
 *
 * Activation class for Appointments plugin.
 *
 * @package  Appointments
 * @author   Mike Tallroth <mike.tallroth@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://github.com/miketallroth/croogo-example-appointments
 */
class AppointmentsActivation {

	public function beforeActivation(Controller $controller) {
		return true;
	}

	public function onActivation(Controller $controller) {

		// ACL: set ACOs with permissions
		/*
		$controller->Croogo->addAco('Appointments');
		$controller->Croogo->addAco('Appointments/appointments/admin_index');
		$controller->Croogo->addAco('Appointments/appointments/index', array('registered', 'public'));
		$controller->Croogo->addAco('Appointments/appointments/view', array('registered', 'public'));
		$controller->Croogo->addAco('Appointments/appointments/calendar', array('registered', 'public'));
		 */

		// check for existing table and type
		$Type = ClassRegistry::init('Taxonomy.Type');
		$tableExists = $Type->query(
			"show tables like 'appointment_details'"
		);
		$typeExists = $Type->find('first', array(
			'conditions' => array(
				'Type.alias' => 'appointment',
			),
		));

		// create appointment_details table with fields;
		// id, node_id, start_date, end_date, location
		if (empty($tableExists)) {
			$Type->query(
				"create table appointment_details (".
				"`id` int(10) not null auto_increment, ".
				"`node_id` int(10) default null, ".
				"`start_date` datetime null default null, ".
				"`end_date` datetime null default null, ".
				"`location` varchar(255) null default null, ".
				"primary key (`id`))"
			);
		}

		// create Appointment content type
		// include routes=true, detail=true, nodes_per_page=1000, plugin=Appointments
		if (empty($typeExists)) {
			$Vocab = ClassRegistry::init('Taxonomy.Vocabulary');
			$tagVocab = $Vocab->find('first', array(
				'conditions' => array(
					'Vocabulary.alias' => 'tags',
				),
			));
			$Type->create();
			$data = array('Type' => array(
				'title' => 'Appointment',
				'alias' => 'appointment',
				'description' => 'An appointment / meeting with start/end datetimes and a location',
				'params' => 'detail=true',
			));
			if (!empty($tagVocab)) {
				$data['Vocabulary'] = array(
					'id' => $tagVocab['Vocabulary']['id'],
				);
			}
			$Type->save($data);
		}

		// create upcoming appointment block
		// direct it to Appointments.upcoming element
		$Block = ClassRegistry::init('Blocks.Block');
		$block = $Block->find('first', array(
			'conditions' => array(
				'Block.alias' => 'upcoming-appointments',
			),
		));
		if (empty($block)) {
			$Region = ClassRegistry::init('Blocks.Region');
			$region = $Region->find('first', array(
				'conditions' => array(
					'Region.alias' => 'right',
				),
			));
			$Block->create();
			$Block->save(array(
				'region_id' => $region['Region']['id'],
				'title' => 'Upcoming Appointments',
				'alias' => 'upcoming-appointments',
				'show_title' => 1,
				'status' => 1,
				'weight' => 2,
				'element' => 'Appointments.upcoming',
			));
		}

		// add appointment to Configure::write('Details.hookTypes');
		$ht = Configure::read('Details.hookTypes');
		$ht = explode(',',$ht);
		if (!in_array('appointment',$ht)) {
			$ht[] = 'appointment';
			$ht = implode(',',$ht);
			Configure::write('Details.hookTypes',$ht);
		}

	}

	public function beforeDeactivation(Controller $controller) {
		return true;
	}

	public function onDeactivation(Controller $controller) {
		/*
		$controller->Croogo->removeAco('Appointments');
		 */
	}

 }
