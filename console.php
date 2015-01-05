#!/usr/bin/env php
<?php

use Symfony\Component\Console\Application;
use Doctrine\Common\Cache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Configuration;

$filename = dirname(__FILE__) . '/conf.d/config.php';
if (file_exists($filename) == false) {
    echo "$filename not found!";
    exit;
}

$conf = require_once $filename;
// Database connection information
$connectionOptions = $conf['db.bssupervisor'];

$loaderPath = __DIR__ . '/vendor/autoload.php';
if (!is_readable($loaderPath)) {
    throw new LogicException('Run php composer.phar install at first');
}
$loader = include $loaderPath;

// Set up class loading.
$loader->add('Bssupervisor\Entity', __DIR__ . '/app/Entity/');

$debug = true;
$config = new Configuration();

// Set up Metadata Drivers
$driverImpl = $config->newDefaultAnnotationDriver(array(__DIR__ . "/app/Entity"), false);
$config->setMetadataDriverImpl($driverImpl);

// Set up caches, depending on $debug variable.
// You can use another variable to define which one of the cache systems you gonna use.
$cache = $debug ? new Cache\ArrayCache : new Cache\ApcCache();
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);

// Proxy configuration
$config->setProxyDir(__DIR__ . '/tmp/Proxies');
$config->setProxyNamespace('Proxies');

$em = EntityManager::create($connectionOptions, $config);
$conn = $em->getConnection();

// See : http://wildlyinaccurate.com/doctrine-2-resolving-unknown-database-type-enum-requested
$conn->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

$console = new Application();
$console->setHelperSet(ConsoleRunner::createHelperSet($em));
ConsoleRunner::addCommands($console);

$console->run();
