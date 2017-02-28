This project is looking for a new maintainer.
---------------------------------------------

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

The reference is the PDOTestSuite (the number of tests is adjusted to make raw PDO score about 100 to each test). For the ORMs, the smaller score is the better (i. e. the faster).

(updated 2015-Dec-07)

## PHP CLI 5.6.4 with opcode cache

| Library                          | Insert | findPk | complex| hydrate|  with  | memory usage |  time  |
| --------------------------------:| ------:| ------:| ------:| ------:| ------:| ------------:| ------:|
|                              PDO |     49 |     45 |      0 |     33 |     92 |      775,264 |   0.22 |
|                                  |        |        |        |        |        |              |        |
|                           LessQL |    153 |    154 |      0 |    114 |    135 |    5,232,880 |   0.57 |
|                                  |        |        |        |        |        |              |        |
|                             YiiM |    211 |    138 |      0 |     79 |    201 |    9,961,472 |   0.67 |
|                    YiiMWithCache |    217 |    148 |      0 |     88 |    222 |    9,961,472 |   0.71 |
|                                  |        |        |        |        |        |              |        |
|                            Yii2M |    603 |    338 |      0 |    187 |    252 |   14,155,776 |   1.46 |
|                Yii2MArrayHydrate |    585 |    327 |      0 |    120 |    220 |   14,155,776 |   1.31 |
|               Yii2MScalarHydrate |    571 |    321 |      0 |    105 |    102 |   14,155,776 |   1.17 |
|                                  |        |        |        |        |        |              |        |
|                         Propel20 |    218 |    105 |      0 |    263 |    323 |   10,747,904 |   0.98 |
|                Propel20WithCache |    156 |     68 |      0 |    228 |    261 |   10,747,904 |   0.77 |
|           Propel20FormatOnDemand |    151 |     67 |      0 |    221 |    264 |   11,010,048 |   0.76 |
|                                  |        |        |        |        |        |              |        |
|                        DoctrineM |    252 |    280 |      0 |    342 |    193 |   17,301,504 |   1.55 |
|               DoctrineMWithCache |    266 |    272 |      0 |    332 |    189 |   17,039,360 |   1.54 |
|            DoctrineMArrayHydrate |    263 |    282 |      0 |    226 |    141 |   17,825,792 |   1.35 |
|           DoctrineMScalarHydrate |    242 |    292 |      0 |    192 |    123 |   17,825,792 |   1.25 |
|          DoctrineMWithoutProxies |    243 |    266 |      0 |    253 |    251 |   16,777,216 |   1.43 |
|                                  |        |        |        |        |        |              |        |
|                         Eloquent |    419 |    254 |      0 |    126 |    218 |   11,534,336 |   1.09 |
|             EloquentWithoutEvent |    380 |    260 |      0 |    124 |    232 |   11,534,336 |   1.06 |

## HHVM CLI 3.10.1 (Corresponding roughly to an up-to-date PHP 5.6)

| Library                          | Insert | findPk | complex| hydrate|  with  | memory usage |  time  |
| --------------------------------:| ------:| ------:| ------:| ------:| ------:| ------------:| ------:|
|                              PDO |     54 |     30 |      0 |     37 |     92 |      783,680 |   0.23 |
|                                  |        |        |        |        |        |              |        |
|                           LessQL |    165 |    194 |      0 |     78 |    135 |   10,316,584 |   0.66 |
|                                  |        |        |        |        |        |              |        |
|                             YiiM |    333 |    194 |      0 |     81 |    494 |    7,267,424 |   1.33 |
|                    YiiMWithCache |    337 |    191 |      0 |     81 |    465 |    7,286,040 |   1.30 |
|                                  |        |        |        |        |        |              |        |
|                            Yii2M |    722 |    272 |      0 |    103 |    175 |    9,025,400 |   1.90 |
|                Yii2MArrayHydrate |    702 |    273 |      0 |    100 |    165 |    9,033,272 |   1.83 |
|               Yii2MScalarHydrate |    700 |    291 |      0 |     90 |     70 |    8,997,160 |   1.74 |
|                                  |        |        |        |        |        |              |        |
|                         Propel20 |    545 |    169 |      0 |    771 |    512 |    9,740,696 |   2.30 |
|                Propel20WithCache |    481 |    135 |      0 |    736 |    485 |    9,807,688 |   2.14 |
|           Propel20FormatOnDemand |    479 |    128 |      0 |    675 |    463 |    9,822,696 |   2.05 |
|                                  |        |        |        |        |        |              |        |
|                        DoctrineM |    634 |    647 |      0 |   1009 |    342 |   19,639,560 |   5.11 |
|               DoctrineMWithCache |    624 |    674 |      0 |   1047 |    339 |   19,635,128 |   5.07 |
|            DoctrineMArrayHydrate |    629 |    642 |      0 |    804 |    249 |   18,447,232 |   4.73 |
|           DoctrineMScalarHydrate |    618 |    634 |      0 |    747 |    203 |   17,366,336 |   4.55 |
|          DoctrineMWithoutProxies |    620 |    629 |      0 |    849 |    357 |   19,402,032 |   4.85 |
|                                  |        |        |        |        |        |              |        |
|                         Eloquent |    589 |    273 |      0 |     98 |    203 |   14,652,488 |   1.53 |
|             EloquentWithoutEvent |    547 |    264 |      0 |     99 |    206 |   14,572,112 |   1.45 |   

## PHP CLI 7.0.0 GA

| Library                          | Insert | findPk | complex| hydrate|  with  | memory usage |  time  |
| --------------------------------:| ------:| ------:| ------:| ------:| ------:| ------------:| ------:|
|                              PDO |     38 |     36 |      0 |     33 |     86 |    1,720,432 |   0.20 |
|                                  |        |        |        |        |        |              |        |
|                           LessQL |     80 |     80 |      0 |     64 |     80 |   10,109,208 |   0.32 |
|                                  |        |        |        |        |        |              |        |
|                             YiiM |    128 |     76 |      0 |     53 |    147 |    6,291,456 |   0.45 |
|                    YiiMWithCache |    109 |     73 |      0 |     50 |    150 |    6,291,456 |   0.42 |
|                                  |        |        |        |        |        |              |        |
|                            Yii2M |    246 |    125 |      0 |     75 |    113 |    8,388,608 |   0.64 |
|                Yii2MArrayHydrate |    233 |    128 |      0 |     63 |    104 |    8,388,608 |   0.60 |
|               Yii2MScalarHydrate |    235 |    119 |      0 |     50 |     50 |    8,388,608 |   0.51 |
|                                  |        |        |        |        |        |              |        |
|                         Propel20 |    142 |     74 |      0 |    163 |    190 |    6,291,456 |   0.63 |
|                Propel20WithCache |     86 |     41 |      0 |    124 |    141 |    6,291,456 |   0.44 |
|           Propel20FormatOnDemand |     85 |     43 |      0 |    118 |    138 |    6,291,456 |   0.44 |
|                                  |        |        |        |        |        |              |        |
|                        DoctrineM |    120 |    150 |      0 |    189 |    122 |   16,777,216 |   0.97 |
|               DoctrineMWithCache |    118 |    146 |      0 |    194 |    112 |   16,777,216 |   0.96 |
|            DoctrineMArrayHydrate |    121 |    144 |      0 |    146 |     85 |   16,777,216 |   0.90 |
|           DoctrineMScalarHydrate |    118 |    235 |      0 |    183 |     91 |   16,777,216 |   1.01 |
|          DoctrineMWithoutProxies |    120 |    151 |      0 |    170 |    190 |   16,777,216 |   1.06 |
|                                  |        |        |        |        |        |              |        |
|                         Eloquent |    209 |    137 |      0 |     84 |    137 |    8,388,608 |   0.65 |
|             EloquentWithoutEvent |    221 |    148 |      0 |     85 |    144 |    8,388,608 |   0.66 |

## HHVM 3.11.x (Corresponding roughly to an up-to-date PHP 7.0)

TODO

Running benchmarks using the Docker shell
-----------------------------------------

See [.docker-stack/README.md](./.docker-stack/README.md)
