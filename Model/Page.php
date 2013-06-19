<?php
App::uses('AwecmsContentAppModel', 'AwecmsContent.Model');
App::uses('String', 'Utility');
/**
 * Page Model
 *
 */
class Page extends AwecmsContentAppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_active' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	public function afterFind($results, $primary = false) {
		if (Router::url('/') != '/') {
			if (isset($results['Page'])) {
				$results['Page']['content'] = $this->_fixRelativeUrls($results['Page']['content']);
				$this->_metaDescription($results['Page']);
			} else if (isset($results[0])) {
				foreach ($results as &$result) {
					if (isset($result['Page']['content'])) {
						$result['Page']['content'] = $this->_fixRelativeUrls($result['Page']['content']);
						$this->_metaDescription($result['Page']);
					}
				}
			}
		}
		return $results;
	}
	
	public function beforeSave($options = array()) {
		if (!empty($this->data['Page']['content'])) {
			$this->data['Page']['content'] = $this->_fixRelativeUrls($this->data['Page']['content'], 'in');
		}
		return true;
	}
	
	protected function _fixRelativeUrls($html, $direction = 'out') {
		$baseUrl = Router::url('/');
		if ($direction == 'in') {
			return preg_replace('/\s(href|src)=(["\'])' . preg_quote($baseUrl, '/') . '(.*?)\2/i', ' $1=$2/$3$2', $html);
		} else {
			return preg_replace('/\s(href|src)=(["\'])\/(.*?)\2/i', ' $1=$2' . $baseUrl . '$3$2', $html);
		}
	}
	
	protected function _metaDescription(&$page) {
		if (array_key_exists('content', $page) && array_key_exists('meta_description', $page) && empty($page['meta_description'])) {
			$page['meta_description'] = String::truncate(strip_tags($page['content']), 160, array('exact' => false, 'ellipsis' => ''));
		}
	}
}
