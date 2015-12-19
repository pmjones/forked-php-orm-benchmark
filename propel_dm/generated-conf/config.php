<?php

if (!isset($configuration) || !($configuration instanceof \Propel\Runtime\Configuration)) {
    $configuration = \Propel\Runtime\Configuration::$globalConfiguration;
    if (null === $configuration) {
        $configuration = new \Propel\Runtime\Configuration();
    }
}

$configuration->checkVersion('2.0.0-dev');
$configuration->setAdapterClass('bookstore', 'sqlite');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle($configuration->getAdapter('bookstore'));
$manager->setConfiguration(array (
  'dsn' => 'sqlite::memory:',
  'settings' =>
  array (
    'charset' => 'utf8',
    'queries' =>
    array (
    ),
  ),
  'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
));
$manager->setName('bookstore');
$configuration->setConnectionManager('bookstore', $manager);
$configuration->setDefaultDatasource('bookstore');
$configuration->registerEntity('bookstore', array (
  0 => 'Book',
  1 => 'Author',
));
return $configuration;