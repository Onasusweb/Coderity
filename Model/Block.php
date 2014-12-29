<?php
App::uses('CoderityAppModel', 'Coderity.Model');

class Block extends CoderityAppModel {

	public $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'Name is required'
		),
		'slug' => array(
			'regex' => array(
				'rule' => '/^[a-zA-Z0-9-_]+$/',
				'message' => 'The page format must be only characters, numbers and dashes.',
				'allowEmpty' => true
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This page already exists.',
				'allowEmpty' => true
			)
		)
	);

/**
 * Override parent before save for slug generation
 * Also handles ordering of the page
 *
 * @return boolean Always true
 */
	public function beforeSave($options = array()) {
		// Generating slug from page name
		if (!empty($this->data['Block']['name']) && empty($this->data['Block']['slug']) && isset($this->data['Block']['slug'])) {
			if (!empty($this->data['Block']['id'])) {
				$this->data['Block']['slug'] = $this->generateSlug($this->data['Block']['name'], $this->data['Block']['id'], '_');
			} else {
				$this->data['Block']['slug'] = $this->generateSlug($this->data['Block']['name'], null, '_');
			}
		}

		return true;
	}

/**
 * Checks if a slug exists and returns the content if it does
 * @param  string $slug
 * @param  bool   $returnErrors If set to true, an error will be thrown if no page exists, otherwise false is returned
 * @return string
 */
	public function get($slug = null, $returnErrors = false) {
		if (!$slug) {
			throw new NotFoundException(__('Invalid content block'));
		}

		$this->contain();
		$block = $this->findBySlug($slug);

		if (!$block) {
			if (!$returnErrors) {
				return array();
			}

			throw new NotFoundException(__('Invalid content block'));
		}

		return $block['Block']['content'];
	}
}