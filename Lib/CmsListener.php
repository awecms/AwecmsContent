<?php

App::uses('CakeEventListener', 'Event');

class CmsListener implements CakeEventListener {

	public function implementedEvents() {
		return array(
			'Admin.MainMenu.beforeRender' => 'addMenuItems',
			'Widget.initialize' => 'registerWidgets',
		);
	}
	
	public function addMenuItems($event) {
		$Menu = $event->subject();
		$Menu->addItem('Pages', array('plugin' => 'cms', 'controller' => 'cms_pages', 'action' => 'index'));
	}
	
	public function registerWidgets($event) {
		$Widget = $event->subject();
		$Widget->registerWidgetClass('Cms.Page', array('editUrl' => array('plugin' => 'cms', 'controller' => 'page_widget')));
		$Widget->registerWidgetClass('Cms.PageMenu', array('editUrl' => array('plugin' => 'cms', 'controller' => 'page_menu_widget')));
	}
}