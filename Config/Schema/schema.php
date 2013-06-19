<?php 
class AwecmsContentSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $page_types = array(
		'id' => array('type' => 'integer', 'null' => false, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false),
		'slug' => array('type' => 'string', 'null' => true),
		'order' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'name', 'unique' => 1)
		),
		'tableParameters' => array()
	);
	public $pages = array(
		'id' => array('type' => 'integer', 'null' => false, 'length' => 11, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'content' => array('type' => 'text', 'null' => true),
		'featured_image' => array('type' => 'string', 'null' => true),
		'meta_keywords' => array('type' => 'text', 'null' => true),
		'meta_description' => array('type' => 'text', 'null' => true),
		'meta_title' => array('type' => 'string', 'null' => true),
		'type' => array('type' => 'string', 'null' => true, 'length' => 31),
		'slug' => array('type' => 'string', 'null' => true, 'length' => 127),
		'is_locked' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'indexes' => array(
			
		),
		'tableParameters' => array()
	);
}
