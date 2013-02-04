<?php
App::uses('CmsAppController', 'Cms.Controller');
/**
 * PageTypes Controller
 *
 * @property PageType $PageType
 */
class PageTypesController extends CmsAppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->PageType->recursive = 0;
		$this->set('pageTypes', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->PageType->id = $id;
		if (!$this->PageType->exists()) {
			throw new NotFoundException(__('Invalid page type'));
		}
		$this->set('pageType', $this->PageType->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->PageType->create();
			if ($this->PageType->save($this->request->data)) {
				$this->Session->setFlash(__('The page type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page type could not be saved. Please, try again.'));
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
		$this->PageType->id = $id;
		if (!$this->PageType->exists()) {
			throw new NotFoundException(__('Invalid page type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PageType->save($this->request->data)) {
				$this->Session->setFlash(__('The page type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page type could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PageType->read(null, $id);
		}
	}

/**
 * admin_delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->PageType->id = $id;
		if (!$this->PageType->exists()) {
			throw new NotFoundException(__('Invalid page type'));
		}
		if ($this->PageType->delete()) {
			$this->Session->setFlash(__('Page type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Page type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
