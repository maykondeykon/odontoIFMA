<?php
require_once __DIR__ . "/vendor/autoload.php";

use Silex\Application;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;
use Doctrine\Common\Cache\ArrayCache as Cache;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\ClassLoader;


$config = new Configuration();
$cache = new Cache();
$config->setQueryCacheImpl($cache);
$config->setProxyDir('/tmp');
$config->setProxyNamespace('EntityProxy');
$config->setAutoGenerateProxyClasses(true);

AnnotationRegistry::registerFile(__DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'doctrine' . DIRECTORY_SEPARATOR . 'orm' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Doctrine' . DIRECTORY_SEPARATOR . 'ORM' . DIRECTORY_SEPARATOR . 'Mapping' . DIRECTORY_SEPARATOR . 'Driver' . DIRECTORY_SEPARATOR . 'DoctrineAnnotations.php');

$driver = new Doctrine\ORM\Mapping\Driver\AnnotationDriver(
    new AnnotationReader(),
    array(__DIR__ . DIRECTORY_SEPARATOR . 'src')
);
$config->setMetadataDriverImpl($driver);
$config->setMetadataCacheImpl($cache);

$params = array(
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'port' => '3306',
    'user' => 'odontoifma',
    'password' => 'C3at4ASZP7DJg7S',
    'dbname' => 'odontoifma',
    'charset' => 'utf8'
);

Doctrine\DBAL\Types\Type::overrideType("datetime", "Doctrine\\DBAL\\Types\\VarDateTimeType");

$app = new Application();

$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . "/src/odontoIFMA/views",
    'debug'=> true,
));
$app['twig']->addExtension(new Twig_Extension_Debug());
$app['em'] = EntityManager::create(
    $params,
    $config
);
