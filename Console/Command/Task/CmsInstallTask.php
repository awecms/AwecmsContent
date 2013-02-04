<?php

App::uses('InstallTask', 'PieceOCake.Console/Command/Task');

class CmsInstallTask extends InstallTask {

	public $pluginName = 'Cms';

	public function execute() {
		$this->_addToBootstrap(true, true);
		$this->_createSchema();
		$this->Config = ClassRegistry::init('PieceOCake.Config');
		$this->Config->write('Cms.Page.preview_truncate', 150);
	}

}