<?php

require_once __DIR__ . "/bootstrap.php";

use odontoIFMA\controller\IndexController;

/**
 * Controllers
 */
$app['index.controller'] = $app->share(function () use($app) {
    return new IndexController($app);
});


/**
 * Rotas
 */
$app->get('/', function () use ($app) {
    return $app['index.controller']->index();
});


/**
 * Executa o sistema
 */
$app->run();