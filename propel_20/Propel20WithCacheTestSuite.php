<?php

require_once dirname(__FILE__) . '/Propel20TestSuite.php';

class Propel20WithCacheTestSuite extends Propel20TestSuite
{
	function initialize()
	{
		$loader = require_once "vendor/autoload.php";

		include realpath(dirname(__FILE__) . '/build/conf/configWithCache.php');

		$loader->add('', __DIR__ . '/build/classes');

		\Propel\Runtime\Propel::disableInstancePooling();
		
		$this->con = \Propel\Runtime\Propel::getConnection('bookstore');
		$this->initTables();
	}
}