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
|                              PDO |     51 |     49 |      5 |     35 |     87 |      774,944 |   0.23 |
|                                  |        |        |        |        |        |              |        |
|                           LessQL |    140 |    143 |     43 |    100 |    113 |    6,543,280 |   0.55 |
|                                  |        |        |        |        |        |              |        |
|                             YiiM |    218 |    144 |     45 |     76 |    208 |    9,961,472 |   0.74 |
|                    YiiMWithCache |    203 |    142 |     48 |     73 |    194 |    9,961,472 |   0.70 |
|                                  |        |        |        |        |        |              |        |
|                            Yii2M |    558 |    331 |     56 |    180 |    242 |   14,155,776 |   1.45 |
|                Yii2MArrayHydrate |    561 |    316 |     56 |    118 |    213 |   14,155,776 |   1.32 |
|               Yii2MScalarHydrate |    584 |    326 |     57 |    104 |    107 |   14,155,776 |   1.23 |
|                                  |        |        |        |        |        |              |        |
|                         Propel20 |    220 |    102 |     87 |    247 |    305 |   10,747,904 |   1.03 |
|                Propel20WithCache |    139 |     58 |     71 |    226 |    270 |   10,747,904 |   0.82 |
|           Propel20FormatOnDemand |    144 |     64 |     73 |    197 |    266 |   11,272,192 |   0.80 |
|                                  |        |        |        |        |        |              |        |
|                        DoctrineM |    240 |    298 |    133 |    264 |    189 |   16,777,216 |   1.53 |
|               DoctrineMWithCache |    248 |    281 |    138 |    254 |    191 |   17,563,648 |   1.52 |
|            DoctrineMArrayHydrate |    241 |    273 |    134 |    141 |    135 |   17,563,648 |   1.33 |
|           DoctrineMScalarHydrate |    243 |    281 |    132 |    114 |    117 |   17,563,648 |   1.30 |
|          DoctrineMWithoutProxies |    245 |    274 |    130 |    176 |    250 |   16,515,072 |   1.47 |
|                                  |        |        |        |        |        |              |        |
|                         Eloquent |    404 |    256 |     91 |    151 |    242 |   11,534,336 |   1.21 |
|             EloquentWithoutEvent |    394 |    253 |     61 |    125 |    210 |   11,534,336 |   1.11 |

## HHVM CLI 3.10.1 (Corresponding roughly to an up-to-date PHP 5.6)

| Library                          | Insert | findPk | complex| hydrate|  with  | memory usage |  time  |
| --------------------------------:| ------:| ------:| ------:| ------:| ------:| ------------:| ------:|
|                              PDO |     49 |     28 |      9 |     36 |     88 |      762,576 |   0.23 |
|                                  |        |        |        |        |        |              |        |
|                           LessQL |    159 |    190 |     76 |     87 |    155 |   10,327,224 |   0.76 |
|                                  |        |        |        |        |        |              |        |
|                             YiiM |    335 |    194 |     97 |     75 |    470 |    7,356,824 |   1.41 |
|                    YiiMWithCache |    324 |    189 |    102 |     76 |    464 |    7,375,440 |   1.38 |
|                                  |        |        |        |        |        |              |        |
|                            Yii2M |    705 |    270 |     91 |     85 |    169 |    9,119,472 |   1.93 |
|                Yii2MArrayHydrate |    674 |    260 |     87 |     71 |    155 |    9,140,592 |   1.86 |
|               Yii2MScalarHydrate |    673 |    269 |     86 |     65 |     55 |    9,110,072 |   1.74 |
|                                  |        |        |        |        |        |              |        |
|                         Propel20 |    517 |    157 |    577 |    383 |    478 |   10,387,384 |   2.42 |
|                Propel20WithCache |    506 |    135 |    564 |    386 |    451 |   10,434,536 |   2.34 |
|           Propel20FormatOnDemand |    469 |    118 |    559 |    310 |    450 |   10,451,680 |   2.21 |
|                                  |        |        |        |        |        |              |        |
|                        DoctrineM |    622 |    667 |    876 |    404 |    309 |   19,932,200 |   5.33 |
|               DoctrineMWithCache |    613 |    663 |    880 |    398 |    298 |   19,937,880 |   5.24 |
|            DoctrineMArrayHydrate |    642 |    711 |    887 |    224 |    230 |   18,744,192 |   5.12 |
|           DoctrineMScalarHydrate |    629 |    625 |    862 |    153 |    180 |   18,712,360 |   4.81 |
|          DoctrineMWithoutProxies |    620 |    642 |    887 |    264 |    362 |   19,711,400 |   5.15 |
|                                  |        |        |        |        |        |              |        |
|                         Eloquent |    609 |    279 |    109 |    106 |    208 |   14,935,368 |   1.67 |
|             EloquentWithoutEvent |    592 |    287 |    106 |    105 |    209 |   14,854,992 |   1.64 |      

## PHP CLI 7.0.0 GA

| Library                          | Insert | findPk | complex| hydrate|  with  | memory usage |  time  |
| --------------------------------:| ------:| ------:| ------:| ------:| ------:| ------------:| ------:|
|                              PDO |     40 |     40 |      5 |     35 |     99 |    1,720,072 |   0.22 |
|                                  |        |        |        |        |        |              |        |
|                           LessQL |     79 |     78 |     38 |     87 |     86 |   10,108,848 |   0.38 |
|                                  |        |        |        |        |        |              |        |
|                             YiiM |    131 |     87 |     46 |     55 |    172 |    6,291,456 |   0.54 |
|                    YiiMWithCache |    126 |     82 |     44 |     55 |    155 |    6,291,456 |   0.50 |
|                                  |        |        |        |        |        |              |        |
|                            Yii2M |    266 |    133 |     43 |     85 |    128 |    8,388,608 |   0.73 |
|                Yii2MArrayHydrate |    243 |    131 |     45 |     59 |    117 |    8,388,608 |   0.65 |
|               Yii2MScalarHydrate |    233 |    119 |     37 |     50 |     48 |    8,388,608 |   0.55 |
|                                  |        |        |        |        |        |              |        |
|                         Propel20 |    140 |     74 |     63 |    155 |    182 |    6,291,456 |   0.68 |
|                Propel20WithCache |     82 |     43 |     54 |    132 |    152 |    6,291,456 |   0.52 |
|           Propel20FormatOnDemand |     83 |     40 |     56 |    121 |    146 |    6,291,456 |   0.50 |
|                                  |        |        |        |        |        |              |        |
|                        DoctrineM |    121 |    158 |    125 |    138 |    121 |   16,777,216 |   1.06 |
|               DoctrineMWithCache |    131 |    155 |    127 |    127 |    115 |   16,777,216 |   1.06 |
|            DoctrineMArrayHydrate |    127 |    155 |    120 |     77 |     85 |   16,777,216 |   0.96 |
|           DoctrineMScalarHydrate |    120 |    151 |    122 |     69 |     77 |   16,777,216 |   0.94 |
|          DoctrineMWithoutProxies |    120 |    146 |    125 |     99 |    172 |   16,777,216 |   1.08 |
|                                  |        |        |        |        |        |              |        |
|                         Eloquent |    210 |    132 |     50 |     78 |    132 |    8,388,608 |   0.66 |
|             EloquentWithoutEvent |    202 |    138 |     50 |     83 |    125 |    8,388,608 |   0.66 |

## HHVM 3.11.x (Corresponding roughly to an up-to-date PHP 7.0)

TODO

Running benchmarks using the Docker shell
-----------------------------------------

See [.docker-stack/README.md](./.docker-stack/README.md)
