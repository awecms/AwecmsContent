<?php

App::uses('WidgetsAppController', 'PieceOCake.Controller');

class PageMenuWidgetController extends WidgetsAppController {

	public $uses = array('PieceOCake.Widget', 'Cms.PageType');

	public function admin_edit($id = null) {
		$data = $this->_read($id);
		$defaults = array('type' => null, 'element' => null);
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Widget']['data'] = array_merge($defaults, $data['Widget']['data'], $this->data['Widget']['data']);
			$this->_save();
		} else {
			$data['Widget']['data'] = array_merge($defaults, $data['Widget']['data']);
			$this->request->data = $data;
		}
		
		$this->helpers[] = 'JsonEditor.JsonEditor';
		
		$types = $this->PageType->find('list', array('fields' => array('PageType.slug', 'PageType.name'), 'conditions' => array('PageType.is_active' => 1)));
		$this->set('types', $types);
	}

}