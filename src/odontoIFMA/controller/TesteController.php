<?php
namespace odontoIFMA\controller;


use odontoIFMA\entity\Acesso;
use odontoIFMA\entity\TipoOperador;
use odontoIFMA\entity\Operador;
use odontoIFMA\entity\Permissao;

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

    public function testePermissao()
    {
        $permissao = new Permissao();
        print_r($this->app['session']->get('usuario')['recursos']);
//        print_r($permissao->getPermissoes('ATENDENTE'));

        if($permissao->isValid('cadTipoCampus','ADMINISTRADOR')){
            echo "Permitido";
        }else{
            echo "Não permitido";
        }

        return "";
    }

    public function testeLogin()
    {
        $acesso = new Acesso();
        $this->entity = 'odontoIFMA\entity\Acesso';
        $repoAcesso = $this->em->getRepository($this->entity);

        $user = 'maykon';
        $senha = '123';
        $senhaEnc = $acesso->encryptPassword($senha);
        $usuario = $repoAcesso->findOneBy(array('login' => $user));

        if($usuario){
            if($senhaEnc == $usuario->getSenha()){
                $dadosUser = array(
                    'nome' => $usuario->getOperador()->getNome(),
                    'perfil' => $usuario->getOperador()->getTipo()->getDescricao()
                );
                print_r($dadosUser);
                echo "acesso";
            }else{
                echo "não permitido";
            }
        }else{
            throw new \Exception("Usuário ou senha inválidos.");
        }

        return "";
    }

}