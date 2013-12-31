<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('bookstore', 'sqlite');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'dsn' => 'sqlite::memory:',
  'options' =>
  array (
    'ATTR_PERSISTENT' => false,
  ),
  'attributes' =>
  array (
    '\\Propel\\Runtime\\Connection\\ConnectionWrapper::PROPEL_ATTR_CACHE_PREPARES' => true,
  ),
  'settings' =>
  array (
    'charset' => 'utf8',
  ),
));
$manager->setName('bookstore');
$serviceContainer->setConnectionManager('bookstore', $manager);
$serviceContainer->setDefaultDatasource('bookstore');