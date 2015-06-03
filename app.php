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

$app->post('/cadastro/salvar/tipo-operador', function () use($app){
    return $app['cadastro.controller']->salvarOperador();
});


/**
 * Rota para captura de exceções
 */
$app->error(function (\Exception $e)use ($app) {
    $titulo = 'Um erro ocorreu!';
    $tipo = 'alert-danger';
    $icon = 'glyphicon-remove';
    return $app['twig']->render('error/error.twig', array(
        'message' => $e->getMessage(),
        'titulo' => $titulo,
        'tipo' => $tipo,
        'icon' => $icon
    ));
});


/**
 * Executa o sistema
 */
$app->run();