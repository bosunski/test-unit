<?php
/**
 * @package	    Joomla.UnitTest
 * @subpackage  Version
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license	    GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * Test class for GetConfigurationCommandTest
 *
 * @package     Joomla.UnitTest
 * @subpackage  Version
 * @since       4.0
 */


use Joomla\CMS\Application\ConsoleApplication;
use Joomla\Input\Cli;
use Joomla\CMS\Factory;
use Joomla\CMS\Console\GetConfigurationCommand;



class GetConfigurationCommandTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * Object under test
	 *
	 * @var    GetConfigurationCommand
	 * @since  4.0
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 *
	 * @since   4.0
	 */
	protected function setUp()
	{
		// This is all I had to do to fix the error and all test case ran fine
		// Is this really worth it?
		$dispatcher = new \Joomla\Event\Dispatcher;
		$conf = Factory::getConfig();
		$app = new ConsoleApplication(new Cli([]), $conf, $dispatcher);
		Factory::$application = $app;

		$this->object = new UpdateCoreCommand;
		$this->object->setApplication($app);
	}

	/**
	 * Overrides the parent tearDown method.
	 *
	 * @return  void
	 *
	 * @see     \PHPUnit\Framework\TestCase::tearDown()
	 * @since   4.0
	 */
	protected function tearDown()
	{
		unset($this->object);
		parent::tearDown();
	}

	public function testFormatConfig()
	{
		$configs = $this->object->getApplication()->getConfig()->toArray();

		$configs = $this->object->formatConfig($configs);

		$this->assertArrayHasKey("cwd", $configs);
		$this->assertArrayHasKey("execution", $configs);
	}

	public function tetsProcessGroupOption()
	{
		$options = $this->object->processSingleOption('db');

		$expectedKeys = ['dbtype', 'host', 'user', 'password', 'db', 'dbprefix'];
		$actualKeys = array_keys($options);

		$this->assertArrayNotHasKey('mailer', $options);
		$this->assertEquals($expectedKeys, $actualKeys);
	}
}
