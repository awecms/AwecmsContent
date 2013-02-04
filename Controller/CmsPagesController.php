<?php
App::uses('CmsAppController', 'Cms.Controller');
App::uses('String', 'Utility');
/**
 * Pages Controller
 *
 * @property Page $Page
 */
class CmsPagesController extends CmsAppController {

	public $uses = array('Page', 'PageType');
	
	public function view($type = 'index', $slug = null) {
		$this->Page->recursive = -1;
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
		
		$overrideViews = array();
		if ($page['Page']['type']) {
			$overrideViews[] = $page['Page']['type'] . '/' . $slug;
			$overrideViews[] = $page['Page']['type'];
		} else {
			$overrideViews[] = $slug;
		}
		
		$this->viewClass = 'PieceOCake.Override';
		$this->overrideViews = $overrideViews;
	}
	
	public function index($type = null) {
		$this->Page->recursive = -1;
		$this->PageType->recursive = -1;
		
		$pageType = $this->PageType->findBySlug($type);
		if (empty($pageType)) {
			throw new NotFoundException(__('Invalid page type'));
		}
		
		$pages = $this->Page->findAllByTypeAndIsActive($type, 1);
		foreach ($pages as &$page) {
			if (empty($page['Page']['preview'])) {
				$page['Page']['preview'] = String::truncate(strip_tags($page['Page']['content']), Configure::read('Cms.Page.preview_truncate'));
			}
			if (empty($page['Page']['preview_image'])) {
				$page['Page']['preview_image'] = $page['Page']['featured_image'];
			}
			$page['Page']['url'] = array('action' => 'view', $page['Page']['type'], $page['Page']['slug']);
		}
		
		
		$this->set('title_for_layout', $pageType['PageType']['name']);
		$this->set('type', $type);
		$this->set('pages', $pages);
		
		$overrideViews = array();
		if ($type) {
			$overrideViews[] = $type . '-index';
		}
		
		$this->viewClass = 'PieceOCake.Override';
		$this->overrideViews = $overrideViews;
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
		$types = $this->PageType->find('list', array('fields' => array('PageType.slug', 'PageType.name'), 'conditions' => array('PageType.is_active' => 1)));
		$this->set('types', $types);
		
		$this->helpers[] = 'PieceOCake.Editor';
		$this->helpers[] = 'PieceOCake.FileManager';
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
		$types = $this->PageType->find('list', array('fields' => array('PageType.slug', 'PageType.name'), 'conditions' => array('PageType.is_active' => 1)));
		$this->set('types', $types);
		
		$this->helpers[] = 'PieceOCake.Editor';
		$this->helpers[] = 'PieceOCake.FileManager';
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
