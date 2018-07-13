<?php

require_once dirname(__FILE__) . '/Doctrine26TestSuite.php';

class Doctrine26WithCacheTestSuite extends Doctrine26TestSuite
{
    private $cache = null;

	function initialize()
	{
		parent::initialize();
		$this->cache = new Doctrine\Common\Cache\ArrayCache();
		$this->em->getConfiguration()->setMetadataCacheImpl($this->cache);
        $this->em->getConfiguration()->setQueryCacheImpl($this->cache);
        $this->em->getConfiguration()->setResultCacheImpl($this->cache);
	}

}