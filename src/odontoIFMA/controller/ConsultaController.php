<?php

namespace odontoIFMA\controller;


class ConsultaController extends AbstractController
{
    public function __construct($app)
    {
        $this->app = $app;
        $this->em = $app['em'];
    }

    public function consultas()
    {
        $this->getPermissao();
        return $this->app['twig']->render('consulta/consultas.twig', array("active_page" => "consultas"));
    }

}