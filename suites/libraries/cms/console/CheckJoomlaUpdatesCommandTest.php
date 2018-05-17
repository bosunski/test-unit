<?php
/**
 * @package	    Joomla.UnitTest
 * @subpackage  Version
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license	    GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * Test class for JVersion.
 *
 * @package     Joomla.UnitTest
 * @subpackage  Version
 * @since       3.0
 */

use Joomla\CMS\Console\CheckUpdatesCommand;
class CheckJoomlaUpdatesCommandTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * Object under test
	 *
	 * @var    JVersion
	 * @since  3.0
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	protected function setUp()
	{
		$this->object = new CheckJoomlaUpdatesCommand;
	}

	/**
	 * Overrides the parent tearDown method.
	 *
	 * @return  void
	 *
	 * @see     \PHPUnit\Framework\TestCase::tearDown()
	 * @since   3.6
	 */
	protected function tearDown()
	{
		unset($this->object);
		parent::tearDown();
	}

	public function testGetUpdateInformation()
	{
		$updateInfo = $this->object->getUpdateInformation();
		$this->assertArrayHasKey('installed', $updateInfo, 'The current version is not defined.');
		$this->assertArrayHasKey('latest', $updateInfo, 'The latest Version must be defined.');
		$this->assertArrayHasKey('object', $updateInfo, 'Update details information should be set.');
		$this->assertArrayHasKey('hasUpdate', $updateInfo);

		$this->assertEquals(\JVERSION, $updateInfo['installed']);
	}
}
