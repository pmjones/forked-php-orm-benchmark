<?php

if (!extension_loaded('phalcon')) {
    die("Phalcon module not loaded");
}

require dirname(__FILE__) . '/PhalconOrmTestSuite.php';

$time = microtime(true);
$memory = memory_get_usage();
$test = new PhalconOrmTestSuite();
$test->initialize();
$test->run();
echo sprintf(" %11s | %6.2f |\n", number_format(memory_get_usage(true) - $memory), (microtime(true) - $time));
