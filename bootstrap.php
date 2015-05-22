<?php
require_once __DIR__ . "/vendor/autoload.php";

use Silex\Application;

$app = new Application();

$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(),array(
    'twig.path' => __DIR__."/src/odontoIFMA/views"
));
