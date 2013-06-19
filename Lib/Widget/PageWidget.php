<?php

App::uses('BaseWidget', 'Awecms.Widget');

class PageWidget extends BaseWidget {

	protected $_page = null;

	public function __construct($widget) {
		parent::__construct($widget);
		$this->Page = ClassRegistry::init('AwecmsContent.Page');
		$this->settings = $widget['data'];
		if (empty($this->settings['element'])) {
			$this->settings['element'] = 'AwecmsContent.page_widget';
		}
		if (empty($this->settings['truncate']) && $this->settings['truncate'] !== 0) {
			$this->settings['truncate'] = 100;
		}
		if ($this->settings['ellipsis'] === null) {
			$this->settings['ellipsis'] = '...';
		}
		if (empty($this->settings['read_more_text'])) {
			$this->settings['read_more_text'] = 'Read More';
		}
		$this->settings['html'] = !empty($this->settings['html']);
		$this->settings['exact'] = !empty($this->settings['exact']);
		$this->settings['escape'] = !empty($this->settings['escape']) || $this->settings['escape'] === null;
		$this->settings['use_page_title'] = !empty($this->settings['use_page_title']) || $this->settings['use_page_title'] === null;
	}
	
	public function getName() {
		$page = $this->getPage();
		return $this->settings['use_page_title'] ? $page['title'] : parent::getName();
	}
	
	public function getPage() {
		if ($this->_page === null) {
			$page = $this->Page->findById($this->settings['page_id']);
			$this->_page = $page['Page'];
		}
		return $this->_page;
	}

	public function getContent() {
		extract($this->settings);
		$page = $this->getPage();
		$content = $page['content'];
		if (!$html) {
			$content = html_entity_decode(strip_tags($content), ENT_QUOTES);
			if ($escape) {
				$content = h($content);
			}
		}
		if ($truncate !== 0) {
			App::uses('String', 'Utility');
			$content = String::truncate($content, $this->settings['truncate'], compact('exact', 'html', 'ellipsis'));
		}
		return $this->_View->element($this->settings['element'], array('content' => $content, 'widget' => $this, 'read_more_text' => $read_more_text));
	}

}