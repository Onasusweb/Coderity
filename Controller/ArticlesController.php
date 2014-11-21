<?php
App::uses('Controller', 'CoderityAppController');
/**
 * Articles Controller
 *
 * @property Article $Article
 */
class ArticlesController extends CoderityAppController {

	public function beforeFilter(){
		parent::beforeFilter();

		if (!empty($this->Auth)) {
			$this->Auth->allow('index', 'view');
		}
	}

	public $helpers = array('Coderity.Ck');

	public $order = array('Article.date' => 'desc', 'Article.id' => 'desc');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->paginate = array('limit' => 10, 'order' => $this->order, 'contain' => false);
		$this->set('articles', $this->paginate());

		$this->loadModel('Coderity.Page');
		$page = $this->Page->findBySlug('blog');

		if ($page) {
			$this->set('page', $page);

			$this->set('title_for_layout', $page['Page']['meta_title']);
			if (!empty($page['Page']['meta_description'])) {
				$this->set('meta_description', $page['Page']['meta_description']);
			}
			if (!empty($page['Page']['meta_keywords'])) {
				$this->set('meta_keywords', $page['Page']['meta_keywords']);
			}
		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $slug
 * @return void
 */
	public function view($slug = null) {
		if (!$slug) {
			throw new NotFoundException(__('Invalid Article'));
		}

		$this->Article->contain();
		$article = $this->Article->findBySlug($slug);

		if (!$article) {
			throw new NotFoundException(__('Invalid Article'));
		}

		$this->set(compact('article'));

		$this->set('title_for_layout', $article['Article']['title']);
		if (!empty($article['Article']['meta_description'])) {
			$this->set('meta_description', $article['Article']['meta_description']);
		}
		if (!empty($article['Article']['meta_keywords'])) {
			$this->set('meta_keywords', $article['Article']['meta_keywords']);
		}
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index($search = null) {
		$conditions = array();

		if ($this->request->is('post')) {
			$this->redirect(array('action' => 'index', $this->request->data['Article']['search']));
		} elseif (!empty($search)) {
			$conditions['or'] = array('Article.title LIKE' => '%' . $search . '%', 'Article.brief LIKE' => '%' . $search . '%', 'Article.content LIKE' => '%' . $search . '%');
		}

		$this->paginate = array('conditions' => $conditions, 'limit' => 50, 'order' => $this->order, 'contain' => false);
		$this->set('articles', $this->paginate());

		$this->set('search', $search);
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Article->create();
			if ($this->Article->save($this->request->data)) {
				$this->Session->setFlash(__('The article has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article could not be saved. Please, try again.'), 'error');
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Article->exists($id)) {
			throw new NotFoundException(__('Invalid article'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Article->save($this->request->data)) {
				$this->Session->setFlash(__('The article has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article could not be saved. Please, try again.'), 'error');
			}
		} else {
			$options = array('conditions' => array('Article.' . $this->Article->primaryKey => $id));
			$this->request->data = $this->Article->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Article->id = $id;
		if (!$this->Article->exists()) {
			throw new NotFoundException(__('Invalid article'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Article->delete()) {
			$this->Session->setFlash(__('The article has been deleted.'));
		} else {
			$this->Session->setFlash(__('The article could not be deleted. Please, try again.'), 'error');
		}
		return $this->redirect(array('action' => 'index'));
	}
}