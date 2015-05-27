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
        $dados = [
            'descricao' => 'servidor2',
            'id' => '5'
        ];

        $this->entity = 'odontoIFMA\entity\TipoOperador';

//        $entity = $this->insert($dados);

//        $entity = $this->update($dados);

//        print_r($this->delete(5));

        return $this->app['twig']->render('index/index.twig', array());
    }
}