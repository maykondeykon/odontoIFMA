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

            $repoTipoOperador = $this->em->getRepository('odontoIFMA\entity\TipoOperador');
            $tipo_operador = $repoTipoOperador->find($dados['tipo_operador_id']); // Recupera o objeto a partir do ID
            $dados['tipo_operador'] = $tipo_operador; // Cria uma nova entrada no array com o nome do atributo da entidade

            $this->insert($dados);

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

    public function Anamnese()
    {
        $repoDoencas = $this->em->getRepository('odontoIFMA\entity\DoencasPreexistentes'); // Obtêm o repositório da entidade
        $listaDoencas = $repoDoencas->findAll(); // Recupera a lista de todos os itens da entidade

        $repoTipoHabito = $this->em->getRepository('odontoIFMA\entity\TipoHabito'); // Obtêm o repositório da entidade
        $listaHabitos = $repoTipoHabito->findAll(); // Recupera a lista de todos os itens da entidade

        return $this->app['twig']->render('cadastro/anamnese.twig', array(
            "active_page" => "cadAnamnese",
            'listaDoencas' => $listaDoencas,
            'listaHabitos' => $listaHabitos
        ));
    }

    public function salvarAnamnese()
    {
        $this->entity = 'odontoIFMA\entity\Campus'; //Define a entidade que será usada

        $repoTipoHabito = $this->em->getRepository('odontoIFMA\entity\TipoHabito');
        $repoPaciente = $this->em->getRepository('odontoIFMA\entity\Paciente');

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

            $paciente = $repoPaciente->find($dados['pacienteId']);

//            var_dump($dados);

            $habitos = array();
            $i = 1;
            foreach($dados as $dado){

                if(isset($dados["estado-{$i}"])){
                    echo "estado {$i} = ".$dados["estado-{$i}"]."<br>";
                }

                if(isset($dados["familiar-{$i}"])){
                    echo "familiar {$i} = ".$dados["familiar-{$i}"]."<br>";
                }

                if(isset($dados["obs-{$i}"])){
                    echo "Obs {$i} = ".$dados["obs-{$i}"]."<br>";
                }

                if(isset($dados["habito-{$i}"])){
                    $habitos[$i] = $dados["habito-{$i}"];
                    echo "Habito {$i} = ".$dados["habito-{$i}"]."<br>";
                }
            $i++;
            }

            foreach($habitos as $key => $value){
                $habitos['habito'] = $repoTipoHabito->find($key);
                $habitos['estado'] = $value;
                $habitos['paciente'] = $paciente;

                //insert($habitos)
            }
            var_dump($habitos);


            die();
//            $this->insert($dados);

            return $this->msgSuccess($params);
        } else {
            throw new \Exception("Método inválido.");
        }
    }

    public function getPacientesJson()
    {
        $request = $this->app['request']->request;
        $dados = $request->all();

        $sql = "SELECT paciente.*,paciente.nome as value FROM paciente WHERE nome LIKE :param";
        $pacientes = $this->findLike($sql, $dados['param']);

        return $this->app->json($pacientes);

    }
}
