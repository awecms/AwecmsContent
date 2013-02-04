<?php
App::uses('PageType', 'Cms.Model');

/**
 * PageType Test Case
 *
 */
class PageTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.cms.page_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PageType = ClassRegistry::init('Cms.PageType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PageType);

		parent::tearDown();
	}

}
