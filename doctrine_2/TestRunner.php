<?php

$hhvm = substr_count(phpversion(), 'hhvm');

passthru( ($hhvm ? 'hhvm': 'php') . ' '.dirname(__FILE__).'/TestRunnerDoctrine2TestSuite.php');
passthru( ($hhvm ? 'hhvm': 'php') . ' '.dirname(__FILE__).'/TestRunnerDoctrine2WithCacheTestSuite.php');

// Optional tests of the alternative abstraction levels of results doctrine provides.
// These are often used in production when data is only needed for presentation (read-only) purposes.

passthru( ($hhvm ? 'hhvm': 'php') . ' '.dirname(__FILE__).'/TestRunnerDoctrine2ArrayHydrateTestSuite.php');
passthru( ($hhvm ? 'hhvm': 'php') . ' '.dirname(__FILE__).'/TestRunnerDoctrine2ScalarHydrateTestSuite.php');
passthru( ($hhvm ? 'hhvm': 'php') . ' '.dirname(__FILE__).'/TestRunnerDoctrine2WithoutProxiesTestSuite.php');
