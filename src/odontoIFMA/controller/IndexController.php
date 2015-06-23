<?php
namespace odontoIFMA\controller;


use odontoIFMA\entity\Acesso;
use odontoIFMA\entity\TipoOperador;
use odontoIFMA\entity\Permissao;

class IndexController extends AbstractController
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
                    throw new \Exception("Usuário ou senha inválidos.");
                }
            }else{
                throw new \Exception("Usuário ou senha inválidos.");
            }

        }
    }

    public function home()
    {
//        if($this->getPermissao()){
//            echo "Permitido";
//        }else{
//            echo "Não permitido";
//        }
//        die();
        $this->getPermissao();
        return $this->app['twig']->render('index/home.twig', array("active_page" => "home"));
    }
}