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

$app->get('/teste/{tipo}', function ($tipo) use ($app) {
    return $app['teste.controller']->$tipo();
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

$app->post('/cadastro/salvar/tipo-operador', function () use($app){
    return $app['cadastro.controller']->salvarTipoOperador();
});

$app->get('/cadastro/paciente', function () use ($app) {
    return $app['cadastro.controller']->tipoPaciente();
})->bind('cadTipoPaciente');

$app->post('/cadastro/salvar/paciente', function () use($app){
    return $app['cadastro.controller']->salvarPaciente(); 
});

$app->get('/cadastro/campus', function () use ($app) {
    return $app['cadastro.controller']->tipoCampus();
})->bind('cadTipoCampus');

$app->post('/cadastro/salvar/campus', function () use($app){
    return $app['cadastro.controller']->salvarCampus(); 
});

// INÍCIO ALTERAÇÃO FEITA POR ROBERTO 07/06/2015 (CRIAÇÃO DAS ROTAS PARA CADASTRO DE OPERADOR)

$app->get('/cadastro/operador', function () use ($app) {
    return $app['cadastro.controller']->Operador();
})->bind('cadOperador');

$app->post('/cadastro/salvar/operador', function () use($app){
    return $app['cadastro.controller']->salvarOperador();
});

// FIM DA ALTERAÇÃO FEITA POR ROBERTO 07/06/2015 (CRIAÇÃO DAS ROTAS PARA CADASTRO DE OPERADOR)

/**
 * Rota para logout do sistema
 */
$app->get('/logout', function () use ($app, $em) {
    return $app->redirect('/');
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