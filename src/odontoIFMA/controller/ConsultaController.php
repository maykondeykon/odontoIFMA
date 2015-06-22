<?php

namespace odontoIFMA\controller;


class ConsultaController extends AbstractController
{
    public function __construct($app)
    {
        $this->app = $app;
        $this->em = $app['em'];
    }

    public function index()
    {
        return $this->app['twig']->render('consulta/index.twig', array("active_page" => "consultas"));
    }

}