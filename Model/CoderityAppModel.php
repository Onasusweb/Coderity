<?php
App::uses('AppModel', 'AppModel');

class CoderityAppModel extends AppModel {
	public $actsAs = array('Containable');

/**
* This method generates a slug from a title
*
* @param  string $title The title or name
* @param  string $id The ID of the model
* @return string Slug
*/
	public function generateSlug($title = null, $id = null) {
		if (!$title) {
			throw new NotFoundException(__('Invalid Title'));
		}

		$title = strtolower($title);
		$slug  = Inflector::slug($title, '-');

		$conditions = array();
		$conditions[$this->alias . '.slug'] = $slug;

		if ($id) {
			$conditions[$this->primaryKey. ' NOT'] = $id;
		}

		$total = $this->find('count', array('conditions' => $conditions, 'recursive' => -1));
		if ($total > 0) {
			for ($number = 2; $number > 0; $number ++) {
				$conditions[$this->alias . '.slug'] = $slug . '-' . $number;

				$total = $this->find('count', array('conditions' => $conditions, 'recursive' => -1));
				if ($total == 0) {
					return $slug . '-' . $number;
				}
			}
		}

		return $slug;
	}

/**
* This function matches two fields - a useful extension for Cake Validation
*
* @param string|array $check Value to check
* @param string $compareField The field to compare
* @return boolean Success
*/
	public function matchFields($check = array(), $compareField = null) {
		$value = array_shift($check);

		if (!empty($value) && !empty($this->data[$this->name][$compareField])) {
			if ($value !== $this->data[$this->name][$compareField]) {
				return false;
			}
		}

		return true;
	}
}