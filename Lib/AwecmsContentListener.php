<?php

App::uses('CakeEventListener', 'Event');

class AwecmsContentListener implements CakeEventListener {

	public function implementedEvents() {
		return array(
			'Admin.MainMenu.beforeRender' => 'addMenuItems',
			'Widget.initialize' => 'registerWidgets',
		);
	}
	
	public function addMenuItems($event) {
		$Menu = $event->subject();
		$Menu->addItem('Pages', array('plugin' => 'awecms_content', 'controller' => 'cms_pages', 'action' => 'index'));
	}
	
	public function registerWidgets($event) {
		$Widget = $event->subject();
		$Widget->registerWidgetClass('AwecmsContent.Page', array('editUrl' => array('plugin' => 'awecms_content', 'controller' => 'page_widget')));
		$Widget->registerWidgetClass('AwecmsContent.PageMenu', array('editUrl' => array('plugin' => 'awecms_content', 'controller' => 'page_menu_widget')));
	}
}