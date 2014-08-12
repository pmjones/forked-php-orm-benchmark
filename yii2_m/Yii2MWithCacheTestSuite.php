<?php

use yii\caching\ArrayCache;

require_once dirname(__FILE__) . '/Yii2MTestSuite.php';

class Yii2MWithCacheTestSuite extends Yii2MTestSuite
{
    private $cache = null;

	function initialize()
	{
		parent::initialize();
        $this->cache = new ArrayCache();
        $this->db->enableSchemaCache = true;
        $this->db->schemaCache = $this->cache;

        $this->db->getTableSchema('Author');
        $this->db->getTableSchema('Book');
	}

}