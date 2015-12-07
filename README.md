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
|                              PDO |    111 |    121 |     15 |     78 |    221 |      774,944 |   0.55 |
|                           LessQL |    313 |    335 |    100 |    220 |    281 |    5,494,704 |   1.42 |
|                                  |        |        |        |        |        |              |        |
|                             YiiM |    683 |    332 |     99 |    195 |    104 |    9,175,040 |   2.18 |
|                    YiiMWithCache |    632 |    360 |    106 |    179 |    116 |    9,175,040 |   1.96 |
|                                  |        |        |        |        |        |              |        |
|                            Yii2M |   1207 |   1198 |    141 |    483 |    302 |   13,369,344 |   4.56 |
|                Yii2MArrayHydrate |   1662 |    872 |    131 |    264 |    217 |   13,631,488 |   3.81 |
|               Yii2MScalarHydrate |   1314 |    964 |    140 |    225 |    239 |   13,631,488 |   3.80 |
|                                  |        |        |        |        |        |              |        |
|                         Propel20 |    568 |    183 |    377 |    747 |    824 |   10,747,904 |   4.19 |
|                Propel20WithCache |    377 |    114 |    389 |    576 |    690 |   10,747,904 |   3.61 |
|           Propel20FormatOnDemand |    393 |    129 |    241 |    629 |    748 |   11,010,048 |   3.42 |
|                                  |        |        |        |        |        |              |        |
|                        DoctrineM |    758 |   1023 |   1087 |    639 |    598 |   16,515,072 |   8.41 |
|               DoctrineMWithCache |    776 |   1096 |   1224 |    879 |    637 |   15,990,784 |   9.18 |
|            DoctrineMArrayHydrate |    800 |   1103 |    857 |    430 |    588 |   15,990,784 |  10.19 |
|           DoctrineMScalarHydrate |    910 |   1285 |   1774 |    336 |    453 |   15,990,784 |  11.83 |
|          DoctrineMWithoutProxies |    805 |   1190 |   1282 |    518 |    751 |   15,990,784 |  12.47 |
|                                  |        |        |        |        |        |              |        |
|                         Eloquent |   1206 |    733 |    188 |    289 |    527 |   11,272,192 |   4.36 |
|             EloquentWithoutEvent |   1051 |    707 |    175 |    308 |    833 |   11,010,048 |   3.92 |

## HHVM CLI 3.10.1 (Corresponding roughly to an up-to-date PHP 5.6)

| Library                          | Insert | findPk | complex| hydrate|  with  | memory usage |  time  |
| --------------------------------:| ------:| ------:| ------:| ------:| ------:| ------------:| ------:|
|                              PDO |     58 |     29 |     10 |     40 |     92 |      763,920 |   0.25 |
|                                  |        |        |        |        |        |              |        |
|                           LessQL |    187 |    211 |     68 |     86 |    152 |   10,328,440 |   0.80 |
|                                  |        |        |        |        |        |              |        |
|                             YiiM |    383 |    201 |    111 |     85 |     46 |    6,325,032 |   1.09 |
|                    YiiMWithCache |    384 |    212 |    111 |     92 |     52 |    6,343,648 |   1.11 |
|                                  |        |        |        |        |        |              |        |
|                            Yii2M |    558 |    397 |     88 |     92 |     56 |    8,711,264 |   1.86 |
|                Yii2MArrayHydrate |    566 |    348 |     90 |     83 |     57 |    8,744,344 |   1.77 |
|               Yii2MScalarHydrate |    561 |    350 |     90 |     68 |     57 |    8,746,528 |   1.76 |
|                                  |        |        |        |        |        |              |        |
|                         Propel20 |    426 |    128 |    639 |    451 |    532 |   10,362,480 |   2.72 |
|                Propel20WithCache |    388 |     92 |    615 |    394 |    455 |   10,422,936 |   2.46 |
|           Propel20FormatOnDemand |    352 |     92 |    605 |    309 |    482 |   10,449,600 |   2.36 |
|                                  |        |        |        |        |        |              |        |
|                        DoctrineM |    642 |    655 |    904 |    436 |    318 |   19,621,456 |   5.55 |
|               DoctrineMWithCache |    658 |    682 |    948 |    452 |    338 |   19,631,944 |   5.72 |
|            DoctrineMArrayHydrate |    627 |    664 |    911 |    224 |    240 |   18,423,328 |   5.27 |
|           DoctrineMScalarHydrate |    636 |    659 |    949 |    159 |    202 |   17,339,720 |   5.17 |
|          DoctrineMWithoutProxies |    663 |    702 |    905 |    282 |    344 |   19,384,088 |   5.46 |
|                                  |        |        |        |        |        |              |        |
|                         Eloquent |    633 |    298 |    110 |    101 |    215 |   13,945,632 |   1.75 |
|             EloquentWithoutEvent |    597 |    318 |    126 |    122 |    242 |   13,865,192 |   1.77 |       

## PHP CLI 7.0.0 GA

| Library                          | Insert | findPk | complex| hydrate|  with  | memory usage |  time  |
| --------------------------------:| ------:| ------:| ------:| ------:| ------:| ------------:| ------:|
|                              PDO |     84 |     75 |      4 |     74 |    187 |    1,720,072 |   0.44 |
|                                  |        |        |        |        |        |              |        |
|                           LessQL |    208 |    205 |     78 |    139 |    160 |   10,108,848 |   1.07 |
|                                  |        |        |        |        |        |              |        |
|                             YiiM |    482 |    224 |     82 |    101 |     77 |    4,194,304 |   2.02 |
|                    YiiMWithCache |    429 |    195 |     85 |    116 |     93 |    4,194,304 |   1.91 |
|                                  |        |        |        |        |        |              |        |
|                            Yii2M |    490 |    511 |     71 |    165 |     96 |    6,291,456 |   2.40 |
|                Yii2MArrayHydrate |    556 |    592 |     89 |    125 |    124 |    8,388,608 |   2.87 |
|               Yii2MScalarHydrate |    515 |    573 |     79 |    174 |    117 |    8,388,608 |   2.70 |
|                                  |        |        |        |        |        |              |        |
|                         Propel20 |    338 |    121 |    316 |    498 |    522 |    6,291,456 |   2.91 |
|                Propel20WithCache |    279 |     45 |    372 |    477 |    414 |    6,291,456 |   3.41 |
|           Propel20FormatOnDemand |    264 |     57 |    407 |    534 |    455 |    6,291,456 |   2.63 |
|                                  |        |        |        |        |        |              |        |
|                        DoctrineM |    649 |   1023 |   1777 |    425 |    449 |   14,680,064 |  13.39 |
|               DoctrineMWithCache |    770 |   1142 |   2492 |    477 |    547 |   14,680,064 |  13.06 |
|            DoctrineMArrayHydrate |    719 |   1023 |   2058 |    226 |    410 |   14,680,064 |  13.75 |
|           DoctrineMScalarHydrate |    643 |   1119 |   2653 |    275 |    457 |   14,680,064 |  14.16 |
|          DoctrineMWithoutProxies |    627 |    576 |   1826 |    319 |    966 |   14,680,064 |  10.83 |
|                                  |        |        |        |        |        |              |        |
|                         Eloquent |   1287 |    353 |    140 |    234 |    376 |    8,388,608 |   3.25 |
|             EloquentWithoutEvent |    818 |    850 |    409 |    330 |    829 |    8,388,608 |   3.84 |
