<?php

passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine23TestSuite.php');
passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine23WithCacheTestSuite.php');

// Optional tests of the alternative abstraction levels of results doctrine provides.
// These are often used in production when data is only needed for presentation (read-only) purposes.

passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine23ArrayHydrateTestSuite.php');
passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine23ScalarHydrateTestSuite.php');
passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine23WithoutProxiesTestSuite.php');

