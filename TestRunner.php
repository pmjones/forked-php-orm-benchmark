<?php
echo "| Library                          | Insert | findPk | complex| hydrate|  with  | memory usage |  time  |\n";
echo "| --------------------------------:| ------:| ------:| ------:| ------:| ------:| ------------:| ------:|\n";

passthru('php raw_pdo/TestRunner.php');
passthru('php propel_16/TestRunner.php');
passthru('php propel_16_with_cache/TestRunner.php');
passthru('php propel_17/TestRunner.php');
passthru('php propel_17_with_cache/TestRunner.php');
passthru('php propel_20/TestRunner.php');
passthru('php propel_20_with_cache/TestRunner.php');
passthru('php doctrine_24/TestRunner.php');
