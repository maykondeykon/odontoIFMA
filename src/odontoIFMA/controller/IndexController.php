<?php
namespace odontoIFMA\controller;


use odontoIFMA\entity\Acesso;
use odontoIFMA\entity\TipoOperador;

class IndexController extends AbstractController
{
    public function __construct($app)
    {
        $this->app = $app;
        $this->em = $app['em'];
    }

    public function index()
    {
        return $this->app['twig']->render('index/login.twig', array());
    }

    public function login()
    {   
        $this->entity = 'odontoIFMA\entity\Acesso'; //Define a entidade que será usada

        $login = 'admin';
        $senha = 'admin';

        if ($this->app['request']->getMethod() == 'POST') {
            $request = $this->app['request']->request;
            $dados = $request->all();

            if ($dados['login'] == $login && $dados['senha'] == $senha) {
                return $this->app->redirect("/cadastro/tipo-operador");
            }else{
                throw new \Exception("Usuário ou senha inválidos!");
            }
           
        }else{
            throw new \Exception("Método inválido.");
        }
    }
}