<?php
/**
 * Classe para manipulação dos métodos de consulta
 */

namespace odontoIFMA\controller;

/**
 * Class ConsultaController
 * @package odontoIFMA\controller
 */
class ConsultaController extends AbstractController
{
    /**
     * Inicialização da classe
     * @param object $app Instância de app
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->em = $app['em'];
    }

    /**
     * Tela de consultas
     * @return mixed Retorna a tela de consultas
     */
    public function consultas()
    {
        $this->getPermissao();
        return $this->app['twig']->render('consulta/consultas.twig', array("active_page" => "consultas"));
    }

}