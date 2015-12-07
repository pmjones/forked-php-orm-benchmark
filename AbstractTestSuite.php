<?php

require_once dirname(__FILE__) . '/sfTimer.php';

abstract class AbstractTestSuite
{
	protected $books = array();
	protected $authors = array();
	
	const NB_TEST = 1000;
	
	abstract function initialize();
	abstract function clearCache();
	abstract function beginTransaction();
	abstract function commit();
	abstract function runAuthorInsertion($i);
	abstract function runBookInsertion($i);
	abstract function runPKSearch($i);
	abstract function runComplexQuery($i);
	abstract function runHydrate($i);
	abstract function runJoinSearch($i);
	
	public function initTables()
	{
		try {
			$this->con->exec('DROP TABLE [book]');
			$this->con->exec('DROP TABLE [author]');
		} catch (PDOException $e) {
			// do nothing - the tables probably don't exist yet
		}
		$this->con->exec('CREATE TABLE [book]
		(
			[id] INTEGER  NOT NULL PRIMARY KEY,
			[title] VARCHAR(255)  NOT NULL,
			[isbn] VARCHAR(24)  NOT NULL,
			[price] FLOAT,
			[author_id] INTEGER
		)');
		$this->con->exec('CREATE TABLE [author]
		(
			[id] INTEGER  NOT NULL PRIMARY KEY,
			[first_name] VARCHAR(128)  NOT NULL,
			[last_name] VARCHAR(128)  NOT NULL,
			[email] VARCHAR(128)
		)');
	}
	
	public function run()
	{
		$t1 =  $this->runTest('runAuthorInsertion', 1700);
		$t1 += $this->runTest('runBookInsertion', 1700);
		$t2 = $this->runTest('runPKSearch', 1900);
		$t3 = $this->runTest('runComplexQuery', 190);
		$t4 = $this->runTest('runHydrate', 750);
		$t5 = $this->runTest('runJoinSearch', 700);
		echo sprintf("| %32s | %6d | %6d | %6d | %6d | %6d | ", str_replace('TestSuite', '', get_class($this)), $t1, $t2, $t3, $t4, $t5);
	}
	
	public function runTest($methodName, $nbTest = self::NB_TEST)
	{
        // start profiling
        xhprof_enable();

		$this->clearCache();

		$timer = new sfTimer();
        $this->beginTransaction();
		for($i=0; $i<$nbTest; $i++) {
			$this->$methodName($i);
		}
        $this->commit();
		$t = $timer->getElapsedTime();

         // stop profiler
        $xhprof_data = xhprof_disable();
        // display raw xhprof data for the profiler run
//        print_r($xhprof_data);
        $XHPROF_ROOT = '/home/cebe/dev/xhprof';
        include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_lib.php";
        include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_runs.php";
        // save raw data for this profiler run using default
        // implementation of iXHProfRuns.
        $xhprof_runs = new XHProfRuns_Default('/tmp');
        // save the run under a namespace "xhprof_foo"
        $run_id = $xhprof_runs->save_run($xhprof_data, "xhprof_foo", time() . get_class($this) . "_$methodName");
//        echo "---------------\n".
//        "Assuming you have set up the http based UI for \n".
//        "XHProf at some address, you can view run at \n".
//        "http://localhost/dev/xhprof/xhprof_html/index.php?run=$run_id&source=xhprof_foo\n".
//        "---------------\n";

		return $t * 1000;
	}
	
	
}