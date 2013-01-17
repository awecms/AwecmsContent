<?php

App::uses('CakeEventListener', 'Event');

class CmsListener implements CakeEventListener {

	public function implementedEvents() {
		return array(
			'Admin.MainMenu.beforeRender' => 'addMenuItems',
		);
	}
	
	public function addMenuItems($event) {
		$Menu = $event->subject();
		$Menu->addItem('Pages', array('plugin' => 'cms', 'controller' => 'pages', 'action' => 'index'));
	}
}