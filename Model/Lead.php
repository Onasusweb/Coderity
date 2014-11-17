<?php
App::uses('AppModel', 'Model');

class Lead extends CoderityAppModel {

	public $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
		),
		'email' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty'
			),
			'email' => array(
				'rule' => 'email',
				'message' => 'The email address is invalid.'
			)
		),
		'phone' => array(
			'rule'    => 'phone',
			'message' => 'The phone number is invalid.',
			'allowEmpty' => true
		),
		'message' => array(
			'rule' => 'notEmpty',
		)
	);

	public function saveLead($data = array(), $type = null) {
		if (!$data || !$type) {
			throw new NotFoundException(__('Invalid data or type'));
		}

		$data['Lead']['type'] = $type;

		$this->create();
		$result = $this->save($data);
		if (!$result) {
			throw new LogicException(__('There was a problem, please review the errors below and try again.'));
		}

		App::uses('CakeEmail', 'Network/Email');

		$email = new CakeEmail();
		$email->from(array($result['Lead']['email'] => $result['Lead']['name']));
		$email->to(Configure::read('Config.email'));
		$email->subject(__('%s - The %s form has been submitted', Configure::read('Config.name'), $result['Lead']['type']));
		$email->template('newLead');
		$email->emailFormat('both');
		$email->viewVars(array('lead' => $result));
		$email->send();

		return true;
	}
}