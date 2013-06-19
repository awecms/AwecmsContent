<?php

App::uses('InstallTask', 'Awecms.Console/Command/Task');

class AwecmsContentInstallTask extends InstallTask {

	public $pluginName = 'AwecmsContent';

	public function execute() {
		$this->_addToBootstrap(true, true);
		$this->_createSchema();
		$this->Config = ClassRegistry::init('Awecms.Config');
		$this->Config->write('AwecmsContent.Page.preview_truncate', 150);
	}

}