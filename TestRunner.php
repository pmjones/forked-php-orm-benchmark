<?php

$hhvm = substr_count(phpversion(), 'hhvm');

$separator = "|----------------------------------| -------| -------| -------| -------| -------| -------------| -------|\n";

echo "|-------------------------------------------------------------------------------------------------------|\n";
echo "| Library                          | Insert | findPk | complex| hydrate|  with  | memory usage |  time  |\n";
echo $separator;

passthru( ($hhvm ? 'hhvm': 'php') . ' raw_pdo/TestRunner.php');
echo $separator;
//passthru( ($hhvm ? 'hhvm': 'php') . 'propel_14/TestRunner.php');
//echo $separator;
//passthru( ($hhvm ? 'hhvm': 'php') . 'propel_15/TestRunner.php');
//echo $separator;
//passthru( ($hhvm ? 'hhvm': 'php') . 'propel_15_with_cache/TestRunner.php');
//echo $separator;
//passthru( ($hhvm ? 'hhvm': 'php') . 'propel_16/TestRunner.php');
//echo $separator;
//passthru( ($hhvm ? 'hhvm': 'php') . 'propel_16_with_cache/TestRunner.php');
//echo $separator;
//passthru( ($hhvm ? 'hhvm': 'php') . 'propel_17/TestRunner.php');
//echo $separator;
//passthru( ($hhvm ? 'hhvm': 'php') . 'propel_17_with_cache/TestRunner.php');
passthru( ($hhvm ? 'hhvm': 'php') . ' propel_20/TestRunner.php');
echo $separator;
passthru( ($hhvm ? 'hhvm': 'php') . ' propel_dm/TestRunner.php');
echo $separator;
//passthru( ($hhvm ? 'hhvm': 'php') . 'doctrine_12/TestRunner.php');
//echo $separator;
//passthru( ($hhvm ? 'hhvm': 'php') . 'doctrine_2/TestRunner.php');
//echo $separator;
//passthru( ($hhvm ? 'hhvm': 'php') . 'doctrine_21/TestRunner.php');
//echo $separator;
//passthru( ($hhvm ? 'hhvm': 'php') . 'doctrine_22/TestRunner.php');
//echo $separator;
//passthru( ($hhvm ? 'hhvm': 'php') . 'doctrine_23/TestRunner.php');
//echo $separator;
//passthru( ($hhvm ? 'hhvm': 'php') . 'doctrine_24/TestRunner.php');
//echo $separator;
passthru( ($hhvm ? 'hhvm': 'php') . ' doctrine_m/TestRunner.php');
echo $separator;
passthru( ($hhvm ? 'hhvm': 'php') . ' eloquent/TestRunner.php');
echo "|-------------------------------------------------------------------------------------------------------|\n";