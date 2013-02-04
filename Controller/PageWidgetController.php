<?php

App::uses('WidgetsAppController', 'PieceOCake.Controller');

class PageWidgetController extends WidgetsAppController {

	public $uses = array('PieceOCake.Widget', 'Cms.Page');

	public function admin_edit($id = null) {
		$data = $this->_read($id);
		$defaults = array('truncate' => 100, 'ellipsis' => '...', 'html' => false, 'exact' => false, 'escape' => true, 'use_page_title' => true, 'page_id' => null, 'element' => null, 'read_more_text' => 'Read More');
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Widget']['data'] = array_merge($defaults, $data['Widget']['data'], $this->data['Widget']['data']);
			$this->_save();
		} else {
			$data['Widget']['data'] = array_merge($defaults, $data['Widget']['data']);
			$this->request->data = $data;
		}
		
		$this->helpers[] = 'JsonEditor.JsonEditor';
		
		$pages = $this->Page->find('list');
		$this->set('pages', $pages);
	}

}