<?php
// This file generated by Propel 1.6.9 convert-conf target
// from XML runtime conf file /home/michal/projekty/forked-php-orm-benchmark/propel_16/runtime-conf.xml
$conf = array (
  'datasources' => 
  array (
    'bookstore' => 
    array (
      'adapter' => 'sqlite',
      'connection' => 
      array (
        'classname' => 'PropelPDO',
        'dsn' => 'sqlite::memory:',
        'options' => 
        array (
          'ATTR_PERSISTENT' => 
          array (
            'value' => false,
          ),
        ),
        'settings' => 
        array (
          'charset' => 
          array (
            'value' => 'utf8',
          ),
        ),
      ),
    ),
    'default' => 'bookstore',
  ),
  'generator_version' => '1.7.1',
);
$conf['classmap'] = include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'classmap-bookstore-conf.php');
return $conf;