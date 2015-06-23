<?php

$hhvm = substr_count(phpversion(), 'hhvm');

passthru( ($hhvm ? 'hhvm': 'php') . ' '.dirname(__FILE__).'/TestRunnerEloquentTestSuite.php');
passthru( ($hhvm ? 'hhvm': 'php') . ' '.dirname(__FILE__).'/TestRunnerEloquentWithoutEventTestSuite.php');
