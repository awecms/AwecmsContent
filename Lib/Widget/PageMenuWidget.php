<?php

App::uses('BaseWidget', 'PieceOCake.Widget');

class PageMenuWidget extends BaseWidget {

	protected $_page = null;

	public function __construct($widget) {
		parent::__construct($widget);
		$this->Page = ClassRegistry::init('Cms.Page');
		//$this->PageType = ClassRegistry::init('Cms.PageType');
		$this->settings = $widget['data'];
		if (empty($this->settings['element'])) {
			$this->settings['element'] = 'Cms.page_menu_widget';
		}
		if (empty($this->settings['type'])) {
			$this->settings['type'] = null;
		}
	}

	public function getContent() {
		$pages = $this->Page->findAllByTypeAndIsActive($this->settings['type'], 1);
		foreach ($pages as &$page) {
			$page['Page']['url'] = array('plugin' => 'cms', 'controller' => 'cms_pages', 'action' => 'view');
			if (!empty($page['Page']['type'])) {
				$page['Page']['url'][] = $page['Page']['type'];
			}
			$page['Page']['url'][] = $page['Page']['slug'];
		}
		return $this->_View->element($this->settings['element'], array('pages' => $pages));
	}

}