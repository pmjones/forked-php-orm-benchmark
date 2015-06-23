<?php

$hhvm = substr_count(phpversion(), 'hhvm');

passthru( ($hhvm ? 'hhvm': 'php') . ' '.dirname(__FILE__).'/TestRunnerPropel15aLa14TestSuite.php');
passthru( ($hhvm ? 'hhvm': 'php') . ' '.dirname(__FILE__).'/TestRunnerPropel15TestSuite.php');
