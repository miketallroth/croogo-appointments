<?php
/**
 * Appointments Helper
 *
 * Helper for adding Appointment data onto pages.
 *
 * @package  Appointments
 * @author   Mike Tallroth <mike.tallroth@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://github.com/miketallroth/croogo-example-appointments
 */
class AppointmentHelper extends AppHelper {
/**
 * Other helpers used by this helper
 *
 * @var array
 * @access public
 */
	public $helpers = array(
		'Html',
		'Layout',
	);

/**
 * Called before LayoutHelper::nodeBody()
 *
 * @return string
 */
	public function beforeNodeBody() {
		return;
		if(count($this->Layout->node['AppointmentDetail']) > 0 && !empty($this->Layout->node['AppointmentDetail']['start_date']) && !empty($this->Layout->node['AppointmentDetail']['end_date'])){
			return '<div class="appointment-data">
				From: '.date(Configure::read('Reading.date_time_format'), strtotime($this->Layout->node['Appointment']['start_date'])).'<br />
				To: '.date(Configure::read('Reading.date_time_format'), strtotime($this->Layout->node['Appointment']['end_date'])).'
			</div>';
		}
	}
}
