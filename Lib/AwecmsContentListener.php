<?php

App::uses('CakeEventListener', 'Event');

class AwecmsContentListener implements CakeEventListener {

	public function implementedEvents() {
		return array(
			'Menu.beforeRender' => 'addMenuItems',
			'Widget.initialize' => 'registerWidgets',
		);
	}
	
	public function addMenuItems($event) {
		if ($event->data['group'] === 'admin') {
			$Menu = $event->subject();
			$Menu->addItem(
					'Pages',
					array('plugin' => 'awecms_content', 'controller' => 'cms_pages', 'action' => 'index'),
					array('group' => 'admin', 'icon' => 'file-text', 'submenu' => 'admin_pages')
				);
			
			$Menu->addItem(
					'New Page',
					array('plugin' => 'awecms_content', 'controller' => 'cms_pages', 'action' => 'add'),
					array('group' => 'admin_pages', 'icon' => 'plus')
				);
			$Menu->addItem(
					'Page Types',
					array('plugin' => 'awecms_content', 'controller' => 'page_types', 'action' => 'index'),
					array('group' => 'admin_pages', 'icon' => 'sitemap')
				);
			$Menu->addItem(
					'New Page Type',
					array('plugin' => 'awecms_content', 'controller' => 'page_types', 'action' => 'add'),
					array('group' => 'admin_pages', 'icon' => 'plus')
				);
		}
	}
	
	public function registerWidgets($event) {
		$Widget = $event->subject();
		$Widget->registerWidgetClass('AwecmsContent.Page', array('editUrl' => array('plugin' => 'awecms_content', 'controller' => 'page_widget')));
		$Widget->registerWidgetClass('AwecmsContent.PageMenu', array('editUrl' => array('plugin' => 'awecms_content', 'controller' => 'page_menu_widget')));
	}
}