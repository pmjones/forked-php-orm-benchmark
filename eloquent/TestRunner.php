<?php

passthru('php '.dirname(__FILE__).'/TestRunnerEloquentTestSuite.php');
passthru('php '.dirname(__FILE__).'/TestRunnerEloquentWithoutEventTestSuite.php');
