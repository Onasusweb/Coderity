<?php
App::uses('CoderityAppModel', 'Coderity.Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends CoderityAppModel {

	public $virtualFields = array('name' => 'CONCAT(User.first_name, " ", User.last_name)');

	public $validate = array(
		'username' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'A username is required.'
			),
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'message' => 'The username can contain letters and numbers only.'
			),
			'between' => array(
				'rule' => array('between', 3, 20),
				'message' => 'Username must be between 3 and 20 characters long.'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'The username is already taken.'
			)
		),
		'old_password' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter in your old password.'
			),
			'checkPassword' => array(
				'rule' => 'checkPassword',
				'message' => 'The password you entered is incorrect.'
			)
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Password is a required field.'
			),
			'between' => array(
				'rule' => array('between', 6, 20),
				'message' => 'Password must be between 6 and 20 characters long.'
			)
		),
		'retype_password' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Retype Password is a required field.'
			),
			'matchFields' => array(
				'rule' => array('matchFields', 'password'),
				'message' => 'Password and Retype Password do not match.'
			)
		),
		'first_name' => array(
			'rule' => 'notEmpty',
			'message' => 'First name is required.'
		),
		'last_name' => array(
			'rule' => 'notEmpty',
			'message' => 'Last name is required.'

		),
		'email' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Email address is required.'
			),
			'email' => array(
				'rule' => 'email',
				'message' => 'The email address you entered is not valid.'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'The email was already used by another user.'
			)
		)
	);

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}
		return true;
	}

/**
 * Function to reset user password. User will get a new password by email.
 *
 * @param array $data Data containing user information which will be verified
 * @return mixed User and email parameter array if success, false otherwise
 */
	public function reset($data = array(), $newPasswordLength = 8) {
		if (!$data || empty($data['User'])) {
			throw new NotFoundException(__('Invalid Data'));
		}

		// Loop through given data array and put it as condition to check
		$conditions = array();

		foreach ($data['User'] as $key => $datum) {
			if ($this->hasField($key)){
				$conditions[$key] = $datum;
			}
		}

		// Find the user
		$user = $this->find('first', array('conditions' => $conditions, 'contain' => false));

		if (!$user) {
			throw new NotFoundException(__('The email address you entered was not found.  Please try a different email address.'));
		}

		// Formating the data for email sending
		// Put the reset link inside the user array
		$user['User']['password'] = $this->generateRandomPassword($newPasswordLength);
		$user['to']               = $user['User']['email'];
		$user['subject']          = __('Account Reset - %s', Configure::read('Config.name'));
		$user['template']         = 'reset';

		// Save the user info
		$this->id = $user['User']['id'];
		$this->saveField('password', $user['User']['password']);

		App::uses('CakeEmail', 'Network/Email');

		$email = new CakeEmail();
		$email->from(array(Configure::read('Config.email') => Configure::read('Config.name')));
		$email->to($user['to']);
		$email->subject($user['subject']);
		$email->template($user['template']);
		$email->emailFormat('both');
		$email->viewVars(array('data' => $user));

		if (!$email->send()) {
			throw new LogicException(__('There was a problem sending the forgotten password email. Please try again or contact us if this problem persists.'));
		}

		return true;
	}

/**
 * Function to check the users old password is correct
 *
 * @param array $data The users data
 * @return booleen true is it matches, false otherwise
 */
	public function checkPassword($check) {
		$value = array_shift($check);

		if (strlen($value) == 0) {
			return true;
		}

		// if no userId is set
		if (empty($this->data['User']['id'])) {
			return false;
		}

		$this->contain();
		$user = $this->findById($this->data['User']['id'], 'password');

		if (!$user) {
			return false;
		}

		$passwordHasher = new BlowfishPasswordHasher();
		return $passwordHasher->check($value, $user['User']['password']);
	}

/**
 * This function generates random password for user
 *
 * @param int $length How long the new password will be
 * @param string $random_string The string to be used when generate the password
 * @return string New generated password
 */
	public function generateRandomPassword($length = 8, $randomString = null) {
		if (empty($randomString)) {
			$randomString = 'pqowieurytlaksjdhfgmznxbcv1029384756';
		}
		$newPassword = '';

		for ($i = 0; $i < $length; $i++) {
			$newPassword .= substr($randomString, mt_rand(0, strlen($randomString) - 1), 1);
		}

		return $newPassword;
	}
}