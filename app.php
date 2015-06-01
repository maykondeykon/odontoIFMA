<?php

require_once __DIR__ . "/bootstrap.php";

use odontoIFMA\controller\IndexController;
use odontoIFMA\controller\CadastroController;

/**
 * Controllers
 */
$app['index.controller'] = $app->share(function () use($app) {
    return new IndexController($app);
});

$app['cadastro.controller'] = $app->share(function () use($app) {
    return new CadastroController($app);
});

/**
 * Rotas
 */
$app->get('/', function () use ($app) {
    return $app['index.controller']->index();
})->bind('home');

$app->get('/cadastro/tipo-operador', function () use ($app) {
    return $app['cadastro.controller']->tipoOperador();
})->bind('cadTipoOperador');


/**
 * Executa o sistema
 */
$app->run();