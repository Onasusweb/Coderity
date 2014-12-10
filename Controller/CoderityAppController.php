<?php
App::uses('AppController', 'Controller');
/**
 * CoderityApp Controller
 *
 * @property CoderityApp $CoderityApp
 */
class CoderityAppController extends AppController {

	public $components = array('Cookie', 'RequestHandler', 'Session', 'Paginator',
								'Auth' => array(
									'authorize'     => array('Controller'),
									'loginRedirect' => array('plugin' => false, 'controller' => 'users', 'action' =>'home', 'admin' => true),
									'loginAction'   => array('plugin' => false, 'controller' => 'users', 'action' =>'login', 'admin' => true),
									'authenticate' => array('Form' => array('passwordHasher' => 'Blowfish'))
								));

	public function beforeFilter() {
		parent::beforeFilter();

		// Change the layout to admin if the prefix is admin
		if (!empty($this->params['prefix']) && $this->params['prefix'] == 'admin') {
			if (Configure::read('Config.adminTheme')) {
				$this->theme = Configure::read('Config.adminTheme');
			}

			$this->layout = 'admin';
		} elseif (Configure::read('Config.theme')) { // lets see if we are using a theme
			$this->theme = Configure::read('Config.theme');
		}
	}

	public function beforeRender() {
		parent::beforeRender();

		// a work around for flash messages
		// success by default
		if (!empty($this->params['prefix']) && $this->params['prefix'] == 'admin') {
			if ($this->Session->check('Message.flash')) {
				$flash = $this->Session->read('Message.flash');

				if ($flash['element'] == 'default') {
					$flash['element'] = 'success';
					$this->Session->write('Message.flash', $flash);
				}
			}
		}

		// lets load the menu for the front end
		if (empty($this->params['prefix'])) {
			$this->loadModel('Coderity.Page');
			$topMenu    = $this->Page->menu(null, 'top');
			$bottomMenu = $this->Page->menu(null, 'bottom');
			$this->set(compact('topMenu', 'bottomMenu'));
		}

	}

	public function isAuthorized($user) {
		if (!empty($this->params['prefix']) && $this->params['prefix'] == 'admin' && !$user) {
			return false;
		}

		return true;
	}
}