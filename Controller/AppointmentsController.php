<?php
App::uses('NodesController','Nodes.Controller');
/**
 * Appointments Controller
 *
 * PHP version 5
 *
 * @package  Appointments
 * @author   Mike Tallroth <mike.tallroth@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://github.com/miketallroth/croogo-example-appointments
 */
class AppointmentsController extends NodesController {

	public $name = 'Appointments';

	public function index() {
		$this->Node->type = 'appointment';
		parent::index();
	}

	public function view($id = null) {
		// Set the Node type so that DetailBehavior properly 'contains'
		// the details when using a numeric id.
		$this->Node->type = 'appointment';
		parent::view($id);
	}

	public function term() {
		$this->Node->type = 'appointment';
		parent::term();
	}

	public function upcoming() {
		$appointments = $this->Node->find('all', array(
			'conditions'=>array(
				'Node.status'=>1,
				'Node.type'=>'appointment',
				'AppointmentDetail.start_date >'=>date('Y-m-d H:i'),
			)
		));

		$this->autoLayout = false;
		$this->autoRender = false;
		return($appointments);
	}

}
