<?php
App::uses('CmsAppController', 'Cms.Controller');
/**
 * Pages Controller
 *
 * @property Page $Page
 */
class PagesController extends CmsAppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		if (!isset($this->params['prefix'])) {
			$this->Auth->allowedActions[] = 'display';
		}
	}

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function display($type = 'index', $slug = null) {
		if (empty($slug)) {
			$slug = $type;
			$type = null;
			$page = $this->Page->findBySlugAndIsActive($slug, 1);
		} else {
			$page = $this->Page->findByTypeAndSlugAndIsActive($type, $slug, 1);
		}
		
		$method = '_' . Inflector::variable(str_replace('-', '_', $slug));
		if (method_exists($this, $method)) {
			$this->$method();
		}
		
		if (empty($page)) {
			throw new NotFoundException(__('Invalid page'));
		}
		
		$this->_pageClass = $slug;
		
		if ($page['Page']['type']) {
			$this->set('type', $page['Page']['type']);
			$this->set('pages', $this->Page->findAllByTypeAndIsActive($type, 1));
		}
		
		$this->set('title_for_layout', !empty($page['Page']['meta_title']) ? $page['Page']['meta_title'] : $page['Page']['title']);
		$this->set('meta_keywords', $page['Page']['meta_keywords']);
		$this->set('meta_description', $page['Page']['meta_description']);
		$this->set('page', $page);
		
		$renderViews = array();
		if ($page['Page']['type']) {
			$renderViews[] = $page['Page']['type'] . '/' . $slug;
			$renderViews[] = $page['Page']['type'];
		} else {
			$renderViews[] = $slug;
		}
		
		$this->viewClass = 'Cms.Page';
		$this->renderViews = $renderViews;
	}
	
	public function index($type = null) {
		$this->set('type', $type);
		$this->set('pages', $this->Page->findAllByTypeAndIsActive($type, 1));
		
		$renderViews = array();
		if ($type) {
			$renderViews[] = $type . '-index';
		}
		
		$this->viewClass = 'Cms.Page';
		$this->renderViews = $renderViews;
	}
	
/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Page->recursive = 0;
		$this->set('pages', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Page->id = $id;
		if (!$this->Page->exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		$this->set('page', $this->Page->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Page->create();
			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash(__('The page has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page could not be saved. Please, try again.'));
			}
		}
		$editor = Configure::read('Cms.editor');
		$this->helpers['Editor'] = array('className' => $editor);
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Page->id = $id;
		if (!$this->Page->exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash(__('The page has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Page->read(null, $id);
		}
		$editor = Configure::read('Cms.editor');
		$this->helpers['Editor'] = array('className' => $editor);
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Page->id = $id;
		if (!$this->Page->exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		if ($this->Page->delete()) {
			$this->Session->setFlash(__('Page deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Page was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
