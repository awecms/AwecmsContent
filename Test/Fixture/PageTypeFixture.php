<?php
/**
 * PageTypeFixture
 *
 */
class PageTypeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
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

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'slug' => 'Lorem ipsum dolor sit amet',
			'order' => 1,
			'is_active' => 1
		),
	);

}
