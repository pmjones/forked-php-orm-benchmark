<?php

use yii\caching\ArrayCache;

require_once dirname(__FILE__) . '/YiiMTestSuite.php';

class YiiMWithCacheTestSuite extends YiiMTestSuite
{
    private $cache = null;

	function initialize()
	{
		parent::initialize();
        $this->cache = new CDummyCache();
//        $this->db->schemaCacheID = true;
//        $this->db->schemaCache = $this->cache;
//
//        $this->db->getTableSchema('Author');
//        $this->db->getTableSchema('Book');
	}

}