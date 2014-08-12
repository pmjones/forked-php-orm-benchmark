Requirements
------------

* linux or bsd system
* PHP 5.3 or greater
* pdo_sqlite

Running All The Benchmarks
--------------------------

    > cd /path/to/php-orm-benchmark
    > php TestRunner.php

Running One Of The Benchmarks
-----------------------------

    > cd /path/to/php-orm-benchmark
    > cd propel_20
    > php TestRunner.php

Test Scenarios
--------------

1. Mass insertion: Tests model objects and save() operations.

2. Retrieve By Pk: Tests basic hydration

3. Complex Query an OR but no hydration: Tests Query parsing

4. Basic Query with 5 results: Tests hydration and collections

5. Query with join: Tests join hydration


Results
-------

 (updated 12.08.2014)
 
| Library                          | Insert | findPk | complex| hydrate|  with  | memory usage |  time  |
| --------------------------------:| ------:| ------:| ------:| ------:| ------:| ------------:| ------:|
                               PDO |    112 |    117 |     68 |     84 |     78 |      359,592 |   0.46 |
                              YiiM |    795 |    424 |    109 |    283 |    159 |    5,767,168 |   1.79 |
                     YiiMWithCache |    802 |    426 |    110 |    289 |    164 |    5,767,168 |   1.81 |
                             Yii2M |   1537 |    780 |    134 |    531 |    300 |    8,388,608 |   3.30 |
                    Yii2MWithCache |   1591 |    787 |    136 |    531 |    303 |    8,650,752 |   3.37 |
                 Yii2MArrayHydrate |   1561 |    791 |    132 |    268 |    254 |    8,650,752 |   3.03 |
                Yii2MScalarHydrate |   1574 |    798 |    134 |    255 |    248 |    8,650,752 |   3.03 |
                          Propel20 |    474 |    243 |    170 |    532 |    518 |    8,650,752 |   1.95 |
                 Propel20WithCache |    380 |    186 |    168 |    514 |    463 |    7,602,176 |   1.72 |
            Propel20FormatOnDemand |    384 |    183 |    162 |    470 |    469 |    4,194,304 |   1.68 |
                        Doctrine24 |    937 |    610 |    131 |    696 |    500 |   11,010,048 |   2.93 |
               Doctrine24WithCache |    940 |    600 |    132 |    683 |    493 |   10,485,760 |   2.90 |
            Doctrine24ArrayHydrate |    935 |    606 |    133 |    372 |    306 |   10,485,760 |   2.41 |
           Doctrine24ScalarHydrate |    973 |    621 |    133 |    310 |    267 |   10,485,760 |   2.36 |
          Doctrine24WithoutProxies |    908 |    599 |    132 |    510 |    594 |   10,485,760 |   2.80 |
                         DoctrineM |    936 |    650 |    140 |    724 |    501 |   10,747,904 |   3.01 |
                DoctrineMWithCache |    941 |    652 |    137 |    728 |    503 |   11,010,048 |   3.02 |
             DoctrineMArrayHydrate |    950 |    645 |    140 |    405 |    315 |   11,272,192 |   2.51 |
            DoctrineMScalarHydrate |    958 |    648 |    137 |    347 |    289 |   11,010,048 |   2.44 |
           DoctrineMWithoutProxies |    947 |    653 |    136 |    545 |    606 |   11,010,048 |   2.94 |
