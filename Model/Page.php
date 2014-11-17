<?php
App::uses('AppModel', 'Model');

class Page extends CoderityAppModel {

	public $actsAs = array('Tree');

	public $virtualFields = array('children' => 'SELECT COUNT(id) FROM pages WHERE parent_id = Page.id');

	public $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'Name is required'
		),
		'title' => array(
			'rule' => 'notEmpty',
			'message' => 'Title is required'
		),
		'slug' => array(
			'regex' => array(
				'rule' => '/^[a-zA-Z0-9-]+$/',
				'message' => 'The page format must be only characters, numbers and dashes.',
				'allowEmpty' => true
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This page already exists.',
				'allowEmpty' => true
			)
		),
		'email' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Email address is required.'
			),
			'email' => array(
				'rule' => 'email',
				'message' => 'The email address you entered is not valid.'
			)
		),
		'message' => array(
			'rule' => 'notEmpty',
			'message' => 'Enquiry is required'
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
		if (!empty($this->data['Page']['name']) && empty($this->data['Page']['slug']) && isset($this->data['Page']['slug'])) {
			if (!empty($this->data['Page']['id'])) {
				$this->data['Page']['slug'] = $this->makeSlug($this->data['Page']['name'], $this->data['Page']['id']);
			} else {
				$this->data['Page']['slug'] = $this->makeSlug($this->data['Page']['name']);
			}
		}

		// the page ordering
		if (empty($this->data['Page']['id'])) {
			if(!empty($this->data['Page']['top_show'])) {
				$this->data['Page']['top_order']  = $this->getLastOrderNumber('top');
			}
			if (!empty($this->data['Page']['bottom_show'])) {
				$this->data['Page']['bottom_order']  = $this->getLastOrderNumber('bottom');
			}
		}

		if (!empty($this->data['Page']['make_homepage'])) {
			$this->updateAll(array('Page.route' => null));

			$this->data['Page']['route'] = '/';
		} else {
			$this->data['Page']['route'] = null;
		}

		return true;
	}

	public function afterFind($results, $primary = false) {
		if (!$results) {
			return array();
		}

		foreach ($results as $key => $result) {
			if (!empty($result[$this->alias]['route']) && $result[$this->alias]['route'] == '/') {
				$results[$key][$this->alias]['make_homepage'] = true;
			}
		}

		return $results;
	}

/**
 * Function to get last order number
 *
 * @param string $position The page position - usually top or bottom
 *
 * @return int Return last order number
 */
	public function getLastOrderNumber($position = null) {
		$this->recursive = -1;
		$lastItem = $this->find('first', array('conditions' => array($position.'_show' => 1), 'order' => array($position.'_order' => 'desc')));
		if (!empty($lastItem)) {
			return $lastItem['Page'][$position.'_order'] + 1;
		} else {
			return 0;
		}
	}

	public function getPages($parent_id = null, $position = 'top') {
		return $this->find('all', array('conditions' => array('Page.'.$position.'_show' => true, 'Page.parent_id' => $parent_id), 'order' => 'Page.'.$position.'_order', 'contain' => false));
	}

/**
* This function builds the menu from our model to tie into the MenuBuilderHelper
*
* @param string $parent_id The parent_id which we are building from
* @param string $position Which menu we are building, usually the 'top'
* @return array The menu
*/
	public function menu($parent_id = null, $position = 'top') {
		$menus = array();

		$fields = array('id', 'name', 'slug', 'parent_id', 'route', 'class');
		$pages = $this->find('all', array('conditions' => array('Page.'.$position.'_show' => true, 'Page.parent_id' => $parent_id), 'order' => 'Page.'.$position.'_order', 'contain' => false, 'fields' => $fields));

		if (!empty($pages)) {
			foreach ($pages as $key => $page) {
				$menu = array();
				$menu['title'] = $page['Page']['name'];
				if (!empty($page['Page']['route'])) {
					$menu['url'] = $page['Page']['route'];
				} else {
					$menu['url'] = '/'.$page['Page']['slug'];
				}

				if (Configure::read('Content.dropdowns')) {
					// lets get the children
					$menu['children'] = $this->menu($page['Page']['id'], $position);
				}

				$menus[] = $menu;
			}
		}

		return $menus;
	}
}