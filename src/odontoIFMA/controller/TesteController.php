<?php
namespace odontoIFMA\controller;


use odontoIFMA\entity\Acesso;
use odontoIFMA\entity\TipoOperador;
use odontoIFMA\entity\Operador;

class TesteController extends AbstractController
{
    public function __construct($app)
    {
        $this->app = $app;
        $this->em = $app['em'];
    }

    public function index()
    {
        return $this->app['twig']->render('index/login.twig', array("active_page" => "login"));
    }

    public function testeAcesso()
    {
        $this->entity = 'odontoIFMA\entity\Operador'; //Define a entidade que será usada

        $acesso = new Acesso();
        $acesso->setLogin('maykon');
        $acesso->setSenha('123');


        $repoTpOperador = $this->em->getRepository('odontoIFMA\entity\TipoOperador');
        $tpOperador = $repoTpOperador->find(2); // Recupera o objeto a partir do ID

        $dados = array(
            'nome' => 'Maykon Deykon',
            'documento' => '64314731320',
            'tipo' => $tpOperador,
            'acesso' => $acesso
        );

        $operador = new $this->entity($dados);
        $acesso->setOperador($operador);

        $this->persist($operador);

        return "testeAcesso";
    }

    public function doencasPreexistentes()
    {
        $this->entity = 'odontoIFMA\entity\DoencasPreexistentes';

        $repoDoencas = $this->em->getRepository($this->entity);

        $doencas = $repoDoencas->findAll();

        var_dump($doencas);

        return "doencasPreexistentes";
    }

    public function testeGetPaciente()
    {
        $sql = "SELECT * FROM paciente WHERE nome LIKE :param";

        $pacientes = $this->findLike($sql,'maykon');

        var_dump($this->app->json($pacientes));

        return "Pacientes";
    }

}