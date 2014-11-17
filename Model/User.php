<?php
App::uses('AppModel', 'Model');
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
			'oldPass' => array(
        		'rule' => 'oldPass',
           		'message' => 'The old password you entered is incorrect.'
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
 * Function to reset user password. User will be emailed a password reset link
 *
 * @param array $data Data containing user information which will be verified
 * @param $tokenLength
 * @return mixed User and email parameter array if success, false otherwise
 */
    public function reset($data, $tokenLength = 16) {
        if (!$data) {
            throw new NotFoundException(__('There was a problem, please try again.'));
        }

        // lets validate the data
        $this->set($this->data);
        if (!$this->validates()) {
            return false;
        }

        // Get the user
        $user = $this->find('first', array('conditions' => array('User.email' => $data['User']['reminder_email']), 'contain' => false));

        if (!$user) {
            // now we should find by username
            $user = $this->find('first', array('conditions' => array('User.username' => $data['User']['reminder_email']), 'contain' => false));
        }

        if (!$user) {
            return false;
        }

        // Formating the data for email sending
        // Put the reset link inside the user array
        $user['reset_key'] = substr(sha1(uniqid(rand(), true)), 0, $tokenLength);
        $user['to']        = $user['User']['email'];
        $user['subject']   = __('Account Reset - %s', $this->appConfigurations['name']);
        $user['template']  = 'users/reset';;

		$this->id = $user['User']['id'];

        // Save the user info
        if (!$this->saveField('reset_key', $user['reset_key'])) {
        	return false;
        }

        return $this->_sendEmail($user);
    }

/**
 * Function to check the users old password is correct
 *
 * @param array $data The users data
 * @return booleen true is it's right, false otherwise
 */
    function oldPass($check) {
        $value = array_shift($check);

        if (strlen($value) == 0) {
            return true;
        }

        $this->contain();
        $user = $this->findById($this->data['User']['id'], 'password');
        $oldPass = Security::hash(Configure::read('Security.salt') . $value);

        if ($user['User']['password'] == $oldPass) {
            return true;
        }

        return false;
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