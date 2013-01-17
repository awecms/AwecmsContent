<?php

App::uses('View', 'View');

class PageView extends View {
	
	public function __construct(Controller $controller = null) {
		$this->_passedVars[] = 'renderViews';
		parent::__construct($controller);
	}

	protected function _getViewFileName($name = null) {
		list($plugin, ) = $this->pluginSplit($name);
		$paths = $this->_paths($plugin);
		$exts = $this->_getExtensions();
		foreach ($exts as $ext) {
			foreach ($paths as $path) {
				foreach ($this->renderViews as $view) {
					$view = str_replace('/', DS, $view);
					if (file_exists($path . $this->viewPath . DS . $view . $ext)) {
						return $path . $this->viewPath . DS . $view . $ext;
					}
				}
			}
		}
		
		return parent::_getViewFileName($name);
	}
}