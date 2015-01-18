<?php
App::uses('CoderityAppController', 'Coderity.Controller');
/**
 * Revisions Controller
 *
 * @property Revisions $Revisions
 */
class RevisionsController extends CoderityAppController {

	public function admin_model($model = null, $modelId = null) {
		if (!$model || !$modelId) {
			throw new NotFoundException(__('Invalid Model or Model ID'));
		}

		$conditions = array('Revision.model' => $model, 'Revision.model_id' => $modelId);
		$this->paginate = array('conditions' => $conditions,
							    'limit' => 50,
							    'order' => array('Revision.created' => 'desc'),
							    'contain' => 'User.username',
							    'group' => 'Revision.revision');

		$this->set('revisions', $this->paginate());

		$this->set(compact('model', 'modelId'));
	}

	public function admin_delete($key = null) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		$this->Revision->recursive = -1;
		$revision = $this->Revision->findByRevision($key);

		if (!$revision) {
			throw new NotFoundException(__('Invalid revision'));
		}

		if ($this->Revision->deleteAll(array('Revision.revision' => $key))) {
			$this->Session->setFlash(__('The revision was deleted successfully.'));
		} else {
			$this->Session->setFlash(__('There was a problem deleting this revision.'), 'error');
		}

		$this->redirect($this->referer('/admin'));
	}
}