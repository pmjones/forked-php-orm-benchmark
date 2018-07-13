<?php

passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine26TestSuite.php');
passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine26WithCacheTestSuite.php');

// Optional tests of the alternative abstraction levels of results doctrine provides.
// These are often used in production when data is only needed for presentation (read-only) purposes.

passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine26ArrayHydrateTestSuite.php');
passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine26ScalarHydrateTestSuite.php');
passthru('php '.dirname(__FILE__).'/TestRunnerDoctrine26WithoutProxiesTestSuite.php');

