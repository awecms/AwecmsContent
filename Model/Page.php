<?php
App::uses('CmsAppModel', 'Cms.Model');
/**
 * Page Model
 *
 */
class Page extends CmsAppModel {
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
			} else if (isset($results[0])) {
				foreach ($results as &$result) {
					if (isset($result['Page'])) {
						$result['Page']['content'] = $this->_fixRelativeUrls($result['Page']['content']);
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
}
