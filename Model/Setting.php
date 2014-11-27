<?php
App::uses('CoderityAppModel', 'Model');

/**
 * Setting Model
 *
 */
class Setting extends CoderityAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
		)
	);

/**
 * Returns the setting value
 * @param  string $name
 * @return string
 */
	public function get($name = null) {
		if (!$name) {
			throw new NotFoundException('No name found');
		}

		$this->contain();
		$setting = $this->findByName($name);

		if (!$setting) {
			throw new NotFoundException('No name found');
		}

		return $setting['Setting']['value'];
	}
}
