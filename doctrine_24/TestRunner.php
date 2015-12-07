<?php

passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine24TestSuite.php');
passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine24WithCacheTestSuite.php');

// Optional tests of the alternative abstraction levels of results doctrine provides.
// These are often used in production when data is only needed for presentation (read-only) purposes.

passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine24ArrayHydrateTestSuite.php');
passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine24ScalarHydrateTestSuite.php');
passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine24WithoutProxiesTestSuite.php');

