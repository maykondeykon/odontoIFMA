<?php
/**
 * Classe para realização de testes
 */
namespace odontoIFMA\controller;


use odontoIFMA\entity\Acesso;
use odontoIFMA\entity\TipoOperador;
use odontoIFMA\entity\Operador;
use odontoIFMA\entity\Permissao;

/**
 * Class TesteController
 * @package odontoIFMA\controller
 */
class TesteController extends AbstractController
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
     * Teste da tela de login
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        $this->getPermissao();
        return $this->app['twig']->render('index/login.twig', array("active_page" => "login"));
    }

    /**
     * Teste do acesso
     * @return string
     * @throws \Exception
     */
    public function testeAcesso()
    {
        $this->getPermissao();
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

    /**
     * Teste de recuperação de doenças preexistentes
     * @return string
     * @throws \Exception
     */
    public function doencasPreexistentes()
    {
        $this->getPermissao();
        $this->entity = 'odontoIFMA\entity\DoencasPreexistentes';

        $repoDoencas = $this->em->getRepository($this->entity);

        $doencas = $repoDoencas->findAll();

        var_dump($doencas);

        return "doencasPreexistentes";
    }

    /**
     * Teste de recuperação de pacientes
     * @return string
     * @throws \Exception
     */
    public function testeGetPaciente()
    {
        $this->getPermissao();
        $sql = "SELECT * FROM paciente WHERE nome LIKE :param";

        $pacientes = $this->findLike($sql,'maykon');

        var_dump($this->app->json($pacientes));

        return "Pacientes";
    }

    /**
     * Teste de permissão
     * @return string
     * @throws \Exception
     */
    public function testePermissao()
    {
        $this->getPermissao();
        $permissao = new Permissao();
//        print_r($this->app['session']->get('usuario')['recursos']);
        print_r($this->app['session']->get('usuario')['perfil']);
//        print_r($permissao->getPermissoes('ADMINISTRADOR'));

        $request = $this->app['request'];

//        print_r($request->getRequestUri());

        $metodo =  substr(__METHOD__, strpos(__METHOD__, "::") + 2);
        $perfil = $this->app['session']->get('usuario')['perfil'];

        if($permissao->isValid($metodo,$perfil)){
            echo "Permitido";
        }else{
            echo "Não permitido";
        }

        return "";
    }

    /**
     * Teste de login
     * @return string
     * @throws \Exception
     */
    public function testeLogin()
    {
        $this->getPermissao();
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

    /**
     * Teste de agendamento
     * @return string
     * @throws \Exception
     */
    public function testeAgendamento()
    {
        // $this->getPermissao();
        $sql = "SELECT * FROM getAgendamentos WHERE data_agendamento BETWEEN :dateIni AND :dateFim";



        $today = new \DateTime('now');

        $agenda = $this->findDateInterval($sql, $today->format('d/m/Y'), $today->format('d/m/Y'));
        print_r($agenda);

        return "";
    }

}