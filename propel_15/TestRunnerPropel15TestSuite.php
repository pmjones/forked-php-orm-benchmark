<?php

  require dirname(__FILE__) . '/Propel15TestSuite.php';
  $time = microtime(true);
  $memory = memory_get_usage(true);
  $test = new Propel15TestSuite();
  $test->initialize();
  $test->run();
  echo sprintf(" %11s | %6.2f |\n", number_format(memory_get_usage(true) - $memory), (microtime(true) - $time));
