<?php

passthru('php '.dirname(__FILE__).'/TestRunnerDoctrineMTestSuite.php');
passthru('php '.dirname(__FILE__).'/TestRunnerDoctrineMWithCacheTestSuite.php');

// Optional tests of the alternative abstraction levels of results doctrine provides.
// These are often used in production when data is only needed for presentation (read-only) purposes.

passthru('php '.dirname(__FILE__).'/TestRunnerDoctrineMArrayHydrateTestSuite.php');
passthru('php '.dirname(__FILE__).'/TestRunnerDoctrineMScalarHydrateTestSuite.php');
passthru('php '.dirname(__FILE__).'/TestRunnerDoctrineMWithoutProxiesTestSuite.php');

