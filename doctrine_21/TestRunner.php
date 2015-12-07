<?php

passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine21TestSuite.php');
passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine21WithCacheTestSuite.php');

// Optional tests of the alternative abstraction levels of results doctrine provides.
// These are often used in production when data is only needed for presentation (read-only) purposes.

passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine21ArrayHydrateTestSuite.php');
passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine21ScalarHydrateTestSuite.php');
passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine21WithoutProxiesTestSuite.php');
