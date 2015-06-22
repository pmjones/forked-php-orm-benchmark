<?php
echo "| Library                          | Insert | findPk | complex| hydrate|  with  | memory usage |  time  |\n";
echo "| --------------------------------:| ------:| ------:| ------:| ------:| ------:| ------------:| ------:|\n";

passthru('php raw_pdo/TestRunner.php');
passthru('php propel_14/TestRunner.php');
passthru('php propel_15/TestRunner.php');
passthru('php propel_15_with_cache/TestRunner.php');
passthru('php propel_16/TestRunner.php');
passthru('php propel_16_with_cache/TestRunner.php');
passthru('php propel_17/TestRunner.php');
passthru('php propel_17_with_cache/TestRunner.php');
passthru('php propel_20/TestRunner.php');
passthru('php propel_20_with_cache/TestRunner.php');
passthru('php doctrine_12/TestRunner.php');
passthru('php doctrine_2/TestRunner.php');
passthru('php doctrine_21/TestRunner.php');
passthru('php doctrine_22/TestRunner.php');
passthru('php doctrine_23/TestRunner.php');
passthru('php doctrine_24/TestRunner.php');
passthru('php doctrine_m/TestRunner.php');
passthru('php eloquent/TestRunner.php');