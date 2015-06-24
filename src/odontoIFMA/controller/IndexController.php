<?php
/**
 * Classe para manipulação dos métodos iniciais
 */
namespace odontoIFMA\controller;


use odontoIFMA\entity\Acesso;
use odontoIFMA\entity\TipoOperador;
use odontoIFMA\entity\Permissao;

/**
 * Class IndexController
 * @package odontoIFMA\controller
 */
class IndexController extends AbstractController
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
     * Tela de login
     * @return mixed Tela de login
     */
    public function index()
    {
        return $this->app['twig']->render('index/login.twig', array("active_page" => "login"));
    }

    /**
     * Autentica os dados do login
     * @return mixed Direciona para a tela principal
     * @throws \Exception Caso o usuário ou senha sejam inválidos
     */
    public function login()
    {
        $acesso = new Acesso();
        $permissao = new Permissao();
        $this->entity = 'odontoIFMA\entity\Acesso';
        $repoAcesso = $this->em->getRepository($this->entity);

        if ($this->app['request']->getMethod() == 'POST') {
            $request = $this->app['request']->request;
            $dados = $request->all();

            $senhaEnc = $acesso->encryptPassword($dados['senha']);
            $usuario = $repoAcesso->findOneBy(array('login' => $dados['login']));

            if($usuario){
                if($senhaEnc == $usuario->getSenha()){
                    $dadosUser = array(
                        'nome' => $usuario->getOperador()->getNome(),
                        'perfil' => $usuario->getOperador()->getTipo()->getDescricao(),
                        'recursos' => $permissao->getPermissoes($usuario->getOperador()->getTipo()->getDescricao())
                    );
                    $this->app['session']->set('usuario', $dadosUser);

                    return $this->app->redirect("/home");
                }else{
                    throw new \Exception("Usuário ou senha inválidos.", 403);
                }
            }else{
                throw new \Exception("Usuário ou senha inválidos.", 403);
            }

        }
    }

    /**
     * Tela home
     * @return mixed Tela inicial
     */
    public function home()
    {
        $this->getPermissao();
        return $this->app['twig']->render('index/home.twig', array("active_page" => "home"));
    }
}