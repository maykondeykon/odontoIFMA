<?php
namespace odontoIFMA\controller;


class IndexController extends AbstractController
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function index()
    {
        return $this->app['twig']->render('index/index.twig', array());
    }
}