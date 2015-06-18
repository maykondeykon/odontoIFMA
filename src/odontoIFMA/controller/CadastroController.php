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

    public function Operador()
    {
      $repoTipoOperador = $this->em->getRepository('odontoIFMA\entity\TipoOperador'); // Obtêm o repositório da entidade
      $listaTipoOperador = $repoTipoOperador->findAll(); // Recupera a lista de todos os itens da entidade
        return $this->app['twig']->render('cadastro/operador.twig', array(
          "active_page" => "cadOperador",
          'listaTipoOperador' => $listaTipoOperador
        ));
    }


    public function salvarOperador()
    {
        $this->entity = 'odontoIFMA\entity\Operador';
        $acesso = new Acesso();

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

            $repoTipoOperador = $this->em->getRepository('odontoIFMA\entity\TipoOperador');
            $tipo_operador = $repoTipoOperador->find($dados['tipo_operador']); // Recupera o objeto a partir do ID
            $dados['tipo'] = $tipo_operador; // Cria uma nova entrada no array com o nome do atributo da entidade

            $operador = new $this->entity($dados);
            $operador->setTipo($tipo_operador);

            $acesso->setLogin($dados['login']);
            $acesso->setSenha($dados['senha']);
            $acesso->setOperador($dados['tipo']);

            $this->persist($operador);

            return $this->msgSuccess($params);
        } else {
            throw new \Exception("Método inválido.");
        }
    }

    public function salvarTipoOperador()
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
        } else {
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

            $repoCampus = $this->em->getRepository('odontoIFMA\entity\Campus');
            $campus = $repoCampus->find($dados['campus_id']); // Recupera o objeto a partir do ID
            $dados['campus'] = $campus; // Cria uma nova entrada no array com o nome do atributo da entidade

            $this->insert($dados);

            return $this->msgSuccess($params);
        } else {
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

            $this->insert($dados);

            return $this->msgSuccess($params);
        } else {
            throw new \Exception("Método inválido.");
        }
    }
}
