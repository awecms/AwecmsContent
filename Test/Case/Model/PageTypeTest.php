<?php
App::uses('PageType', 'AwecmsContent.Model');

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
		'plugin.awecms_content.page_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PageType = ClassRegistry::init('AwecmsContent.PageType');
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
