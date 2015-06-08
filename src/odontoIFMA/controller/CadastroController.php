<?php
namespace odontoIFMA\controller;


use odontoIFMA\entity\Acesso;
use odontoIFMA\entity\TipoOperador;

class CadastroController extends AbstractController
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

    public function tipoOperador()
    {
        return $this->app['twig']->render('cadastro/tipoOperador.twig', array("active_page" => "cadTipoOperador"));
    }

    public function tipoPaciente()
    {
        $repoCampus = $this->em->getRepository('odontoIFMA\entity\Campus'); // Obtêm o repositório da entidade
        $listaCampus = $repoCampus->findAll(); // Recupera a lista de todos os itens da entidade

        return $this->app['twig']->render('cadastro/paciente.twig', array(
            "active_page" => "cadTipoPaciente",
            'listaCampus' => $listaCampus // Passa a lista para a view
        ));
    }

    public function tipoCampus()
    {
        return $this->app['twig']->render('cadastro/campus.twig', array("active_page" => "cadTipoCampus"));
    }

// INÍCIO ALTERAÇÃO FEITA POR ROBERTO 07/06/2015 (CRIAÇÃO FUNÇÃO Operador E salvarCadastroOperador)

     public function Operador()
    {
        return $this->app['twig']->render('cadastro/operador.twig', array("active_page" => "cadOperador"));
    }


    public function salvarCadastroOperador()
    {
        $this->entity = 'odontoIFMA\entity\Operador'; //Define a entidade que será usada
        //Define os parâmetros que serão usados na renderização da tela com retorno da operação
        $params = array(
            'message' => 'Operador cadastrado com sucesso.', //Mensagem a ser exibida
            'titulo' => 'Sucesso!', // Título da mensagem
            'tipo' => 'alert-success', // Define o tipo da mensagem, erro ou sucesso
            'icon' => 'glyphicon-ok', // Ícone do título da mensagem
            'active_page' => 'cadOperador', // Define a página ativa no menu e breadcrumb
            'btVoltar' => '/cadastro/operador' // Define a rota do botão voltar
        );

        if ($this->app['request']->getMethod() == 'POST') {
            $request = $this->app['request']->request;
            $dados = $request->all();

            $this->insert($dados);

            return $this->msgSuccess($params);
        }else{
            throw new \Exception("Método inválido.");
        }

    }

// FIM ALTERAÇÃO FEITA POR ROBERTO 07/06/2015 (CRIAÇÃO FUNÇÃO Operador E salvarCadastroOperador)

    public function salvarOperador()
    {
        $this->entity = 'odontoIFMA\entity\TipoOperador'; //Define a entidade que será usada
        //Define os parâmetros que serão usados na renderização da tela com retorno da operação
        $params = array(
            'message' => 'Tipo operador cadastrado com sucesso.', //Mensagem a ser exibida
            'titulo' => 'Sucesso!', // Título da mensagem
            'tipo' => 'alert-success', // Define o tipo da mensagem, erro ou sucesso
            'icon' => 'glyphicon-ok', // Ícone do título da mensagem
            'active_page' => 'cadTipoOperador', // Define a página ativa no menu e breadcrumb
            'btVoltar' => '/cadastro/tipo-operador' // Define a rota do botão voltar
        );

        if ($this->app['request']->getMethod() == 'POST') {
            $request = $this->app['request']->request;
            $dados = $request->all();

            $this->insert($dados);

            return $this->msgSuccess($params);
        }else{
            throw new \Exception("Método inválido.");
        }

    }

    public function salvarPaciente()
    {
         $this->entity = 'odontoIFMA\entity\Paciente'; //Define a entidade que será usada
        //Define os parâmetros que serão usados na renderização da tela com retorno da operação
        $params = array(
            'message' => 'Paciente cadastrado com sucesso.', //Mensagem a ser exibida
            'titulo' => 'Sucesso!', // Título da mensagem
            'tipo' => 'alert-success', // Define o tipo da mensagem, erro ou sucesso
            'icon' => 'glyphicon-ok', // Ícone do título da mensagem
            'active_page' => 'cadTipoPaciente', // Define a página ativa no menu e breadcrumb
            'btVoltar' => '/cadastro/paciente' // Define a rota do botão voltar
        );

        if ($this->app['request']->getMethod() == 'POST') {
            $request = $this->app['request']->request;
            $dados = $request->all();
            print_r($dados);

            $this->insert($dados);            

            return $this->msgSuccess($params);
        }else{
            throw new \Exception("Método inválido.");
        }
    }

    public function salvarCampus()
    {
         $this->entity = 'odontoIFMA\entity\Campus'; //Define a entidade que será usada
        //Define os parâmetros que serão usados na renderização da tela com retorno da operação
        $params = array(
            'message' => 'Campus cadastrado com sucesso.', //Mensagem a ser exibida
            'titulo' => 'Sucesso!', // Título da mensagem
            'tipo' => 'alert-success', // Define o tipo da mensagem, erro ou sucesso
            'icon' => 'glyphicon-ok', // Ícone do título da mensagem
            'active_page' => 'cadTipoCampus', // Define a página ativa no menu e breadcrumb
            'btVoltar' => '/cadastro/campus' // Define a rota do botão voltar
        );

        if ($this->app['request']->getMethod() == 'POST') {
            $request = $this->app['request']->request;
            $dados = $request->all();
            print_r($dados);

            $this->insert($dados);            

            return $this->msgSuccess($params);
        }else{
            throw new \Exception("Método inválido.");
        }

        

    }
}