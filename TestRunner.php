<?php
echo "|-------------------------------------------------------------------------------------------------------|\n";
echo "| Library                          | Insert | findPk | complex| hydrate|  with  | memory usage |  time  |\n";
echo "| --------------------------------:| ------:| ------:| ------:| ------:| ------:| ------------:| ------:|\n";

$separator = "|                                  |        |        |        |        |        |              |        |\n";

passthru('php raw_pdo/TestRunner.php');
echo $separator;

passthru('php lessql/TestRunner.php');
echo $separator;

// passthru('php yii1_m/TestRunner.php');
// echo $separator;

## Cannot use 'Object' as class name as it is reserved in /yii2_m/vendor/yiisoft/yii2/base/Object.php on line 77
// passthru('php yii2_m/TestRunner.php');
// echo $separator;

## Uncaught Error: Call to undefined method Error::shutdown_handler() in /fuel_173/fuel/core/bootstrap.php:77
// passthru('php fuel_173/TestRunner.php');
// echo $separator;

## Fatal error: Uncaught exception 'PHPixie\ORM\Exception\Plan' with message 'Result used as update source must contain a single item.' in /phpixie/orm/src/PHPixie/ORM/Steps/Step/Update/Map.php:21"
// passthru('php phpixie/TestRunner.php');
// echo $separator;

// passthru('php propel_14/TestRunner.php');
// echo $separator;

// passthru('php propel_15/TestRunner.php');
// passthru('php propel_15_with_cache/TestRunner.php');
// echo $separator;

// passthru('php propel_16/TestRunner.php');
// passthru('php propel_16_with_cache/TestRunner.php');
// echo $separator;

// passthru('php propel_17/TestRunner.php');
// passthru('php propel_17_with_cache/TestRunner.php');
// echo $separator;

## Fatal error:  Declaration of Propel\Runtime\Collection\OnDemandCollection::offsetGet($offset) must be compatible with & Propel\Runtime\Collection\Collection::offsetGet($offset) in /propel_20/vendor/propel/propel/src/Propel/Runtime/Collection/OnDemandCollection.php on line 216
// passthru('php propel_20/TestRunner.php');
// echo $separator;

// Propel dm is broken - "Fatal error: Class undefined: Propel\Runtime\Configuration in /repo/propel_dm/generated-conf/config.php on line 4"
//passthru('php propel_dm/TestRunner.php');
//echo $separator;

// passthru('php doctrine_12/TestRunner.php');
// echo $separator;

// passthru('php doctrine_2/TestRunner.php');
// echo $separator;

// passthru('php doctrine_21/TestRunner.php');
// echo $separator;

// passthru('php doctrine_22/TestRunner.php');
// echo $separator;

// passthru('php doctrine_23/TestRunner.php');
// echo $separator;

// passthru('php doctrine_24/TestRunner.php');
// echo $separator;

// passthru('php doctrine_26/TestRunner.php');
// echo $separator;

// passthru('php atlas_2/TestRunner.php');
// echo $separator;

passthru('php atlas_3/TestRunner.php');
echo $separator;

passthru('php eloquent/TestRunner.php');
echo $separator;

// passthru('php phalcon/TestRunner.php');
// echo $separator;
echo "|-------------------------------------------------------------------------------------------------------|\n";
