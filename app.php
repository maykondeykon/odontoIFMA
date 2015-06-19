<?php

require_once __DIR__ . "/bootstrap.php";

use odontoIFMA\controller\IndexController;
use odontoIFMA\controller\CadastroController;
use odontoIFMA\controller\TesteController;

/**
 * Controllers
 */
$app['index.controller'] = $app->share(function () use($app) {
    return new IndexController($app);
});

$app['cadastro.controller'] = $app->share(function () use($app) {
    return new CadastroController($app);
});

$app['teste.controller'] = $app->share(function () use($app) {
    return new TesteController($app);
});

/**
 * Rotas
 */
$app->get('/', function () use ($app) {
    return $app['index.controller']->index();
});

$app->post('/login', function () use($app){
    return $app['index.controller']->login();
});

$app->get('/home', function () use ($app) {
    return $app['index.controller']->home();
})->bind('home');

$app->get('/cadastro/tipo-operador', function () use ($app) {
    return $app['cadastro.controller']->tipoOperador();
})->bind('cadTipoOperador');

$app->get('/cadastro/paciente', function () use ($app) {
    return $app['cadastro.controller']->tipoPaciente();
})->bind('cadTipoPaciente');

$app->get('/cadastro/campus', function () use ($app) {
    return $app['cadastro.controller']->tipoCampus();
})->bind('cadTipoCampus');

$app->get('/cadastro/operador', function () use ($app) {
    return $app['cadastro.controller']->Operador();
})->bind('cadOperador');


$app->get('/cadastro/anamnese', function () use ($app) {
    return $app['cadastro.controller']->Anamnese();
})->bind('cadAnamnese');

/**
 * Rota dinâmica para ser usada em métodos que retornam Json.
 */
$app->post('/get-json/{tipo}', function ($tipo) use($app){
    return $app['cadastro.controller']->$tipo();
});

/**
 * Rota dinâmica para testes.
 * Substituir o campo "{tipo}" pelo método em TesteController
 */
$app->get('/teste/{tipo}', function ($tipo) use ($app) {
    return $app['teste.controller']->$tipo();
});

/**
 * Rota dinâmica para salvamento de cadastros.
 * Substituir na action do formulário o campo "{tipo}" pelo método em CadastroController
 */
$app->post('/cadastro/salvar/{tipo}', function ($tipo) use($app){
    return $app['cadastro.controller']->$tipo();
});

/**
 * Rota para logout do sistema
 */
$app->get('/logout', function () use ($app) {
    $app['session']->clear();
    return $app->redirect('/');
});

/**
 * Método para captura de exceções
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
