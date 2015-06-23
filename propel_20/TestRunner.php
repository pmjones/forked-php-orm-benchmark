<?php

$hhvm = substr_count(phpversion(), 'hhvm');

passthru( ($hhvm ? 'hhvm': 'php') . ' ' . __DIR__ . '/TestRunnerPropel20TestSuite.php');
passthru( ($hhvm ? 'hhvm': 'php') . ' ' . __DIR__ . '/TestRunnerPropel20WithCacheTestSuite.php');
passthru( ($hhvm ? 'hhvm': 'php') . ' ' . __DIR__ . '/TestRunnerPropel20FormatOnDemandTestSuite.php');