<?php
App::uses('CoderityAppModel', 'Coderity.Model');

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
			throw new NotFoundException('No setting found');
		}

		$name = Inflector::underscore($name);

		$this->contain();
		$setting = $this->findByName($name);

		if (!$setting) {
			throw new NotFoundException('No setting found');
		}

		if ($name == 'site_emails_cc') {
			return $this->explodeAndTrim($setting['Setting']['value'], ',');
		}

		return $setting['Setting']['value'];
	}

/**
 * Explodes an array by a separator and trims each value
 * @param  string $value
 * @param  string $separator
 * @return array()
 */
	public function explodeAndTrim($value = null, $separator = null) {
		if (!$value) {
			return array();
		}

		if (!$separator) {
			throw new NotFoundException(__('Invalid separator'));
		}

		$rows = explode($separator, $value);

		foreach ($rows as $key => $row) {
			$rows[$key] = trim($row);
		}

		return $rows;
	}
}
