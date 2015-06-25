<?php
/**
 * Classe para manipulação dos métodos de cadastro
 */
namespace odontoIFMA\controller;


use odontoIFMA\entity\Acesso;
use odontoIFMA\entity\Paciente;
use odontoIFMA\entity\TipoOperador;
use odontoIFMA\entity\HistoriaMedica;
use odontoIFMA\entity\Parafuncionais;
use odontoIFMA\entity\QueixaPricipal;
use odontoIFMA\entity\Higiene;

/**
 * Class CadastroController
 * @package odontoIFMA\controller
 */
class CadastroController extends AbstractController
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
     * Tela tipo operador
     * @return mixed Retorna tela de cadastro de tipo de operador
     */
    public function tipoOperador()
    {
        $this->getPermissao();
        return $this->app['twig']->render('cadastro/tipoOperador.twig', array("active_page" => "cadTipoOperador"));
    }

    /**
     * Tela paciente
     * @return mixed Retorna tela de cadastro de pacientes
     */
    public function paciente()
    {
        $this->getPermissao();
        $repoCampus = $this->em->getRepository('odontoIFMA\entity\Campus'); // Obtêm o repositório da entidade
        $listaCampus = $repoCampus->findAll(); // Recupera a lista de todos os itens da entidade

        return $this->app['twig']->render('cadastro/paciente.twig', array(
            "active_page" => "cadPaciente",
            'listaCampus' => $listaCampus // Passa a lista para a view
        ));
    }

    /**
     * Tela tipo campus
     * @return mixed Retorna tela de cadastro de campus
     */
    public function tipoCampus()
    {
        $this->getPermissao();
        return $this->app['twig']->render('cadastro/campus.twig', array("active_page" => "cadTipoCampus"));
    }

    /**
     * Tela atendimento
     * @return mixed Retorna tela de cadastro de atendimento
     */
    public function atendimento()
    {
        $this->getPermissao();

        $repoPaciente = $this->em->getRepository('odontoIFMA\entity\Paciente'); // Obtêm o repositório da entidade
        $listaPaciente = $repoPaciente->findAll(); // Recupera a lista de todos os itens da entidade        

        return $this->app['twig']->render('cadastro/atendimento.twig', array(
            "active_page" => "cadAtendimento",
            'listaPaciente' => $listaPaciente // Passa a lista para a view           
        ));
    }

    /**
     * Tela operador
     * @return mixed Retorna tela de cadastro de operador
     */
    public function operador()
    {
        $this->getPermissao();
        $repoTipoOperador = $this->em->getRepository('odontoIFMA\entity\TipoOperador'); // Obtêm o repositório da entidade
        $listaTipoOperador = $repoTipoOperador->findAll(); // Recupera a lista de todos os itens da entidade
        return $this->app['twig']->render('cadastro/operador.twig', array(
            "active_page" => "cadOperador",
            'listaTipoOperador' => $listaTipoOperador
        ));
    }

    /**
     * Salva o operador no Banco de dados
     * @return mixed Retorna confirmação de cadastro
     * @throws \Exception Se o método não for POST
     */
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

            $acesso->setLogin($dados['login']);
            $acesso->setSenha($dados['senha']);

            $dados['acesso'] = $acesso;

            $operador = new $this->entity($dados);
            $acesso->setOperador($operador);

            $this->persist($operador);

            return $this->msgSuccess($params);
        } else {
            throw new \Exception("Método inválido.");
        }
    }

    /**
     * Salva o tipo de operador no Banco de dados
     * @return mixed Retorna confirmação de cadastro
     * @throws \Exception Se o método não for POST
     */
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

    /**
     * Salva o paciente no Banco de dados
     * @return mixed Retorna confirmação de cadastro
     * @throws \Exception Se o método não for POST
     */
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

    /**
     * Salva o atendimento no Banco de dados
     * @return mixed Retorna confirmação de cadastro
     * @throws \Exception Se o método não for POST
     */
    public function salvarAtendimento()
    {
        $this->entity = 'odontoIFMA\entity\Atendimento'; //Define a entidade que será usada
        //Define os parâmetros que serão usados na renderização da tela com retorno da operação
        $params = array(
            'message' => 'Atendimento agendado com sucesso.', //Mensagem a ser exibida
            'titulo' => 'Sucesso!', // Título da mensagem
            'tipo' => 'alert-success', // Define o tipo da mensagem, erro ou sucesso
            'icon' => 'glyphicon-ok', // Ícone do título da mensagem
            'active_page' => 'cadAtendimento', // Define a página ativa no menu e breadcrumb
            'btVoltar' => '/cadastro/atendimento' // Define a rota do botão voltar
        );

        if ($this->app['request']->getMethod() == 'POST') {
            $request = $this->app['request']->request;
            $dados = $request->all();

            $repoPaciente = $this->em->getRepository('odontoIFMA\entity\Paciente');
            $paciente = $repoPaciente->find($dados['paciente_id']); // Recupera o objeto a partir do ID            
            $dados['paciente'] = $paciente; // Cria uma nova entrada no array com o nome do atributo da entidade

            $this->insert($dados);

            return $this->msgSuccess($params);
        } else {
            throw new \Exception("Método inválido.");
        }
    }

    /**
     * Salva o campus no Banco de dados
     * @return mixed Retorna confirmação de cadastro
     * @throws \Exception Se o método não for POST
     */
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

    /**
     * Tela anamnese
     * @return mixed Retorna tela de cadastro da anamnese
     */
    public function anamnese()
    {
        $this->getPermissao();
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

    /**
     * Salva a anamnese no Banco de dados
     * @return mixed Retorna confirmação de cadastro
     * @throws \Exception Se o Id do paciente não informado
     * @throws \Exception Se o Paciente não for localizado
     * @throws \Exception Se o método não for POST
     */
    public function salvarAnamnese()
    {
        $repoTipoHabito = $this->em->getRepository('odontoIFMA\entity\TipoHabito');
        $repoPaciente = $this->em->getRepository('odontoIFMA\entity\Paciente');
        $repoDoencas = $this->em->getRepository('odontoIFMA\entity\DoencasPreexistentes');

        $params = array(
            'message' => 'Anamnese cadastrada com sucesso.', //Mensagem a ser exibida
            'titulo' => 'Sucesso!', // Título da mensagem
            'tipo' => 'alert-success', // Define o tipo da mensagem, erro ou sucesso
            'icon' => 'glyphicon-ok', // Ícone do título da mensagem
            'active_page' => 'cadAnamnese', // Define a página ativa no menu e breadcrumb
            'btVoltar' => '/cadastro/anamnese' // Define a rota do botão voltar
        );

        if ($this->app['request']->getMethod() == 'POST') {
            $request = $this->app['request']->request;
            $dados = $request->all();

            if (isset($dados['pacienteId'])) {
                $paciente = $repoPaciente->find($dados['pacienteId']); // Recupera o objeto Paciente
            } else {
                throw new \Exception("Id do paciente não informado.");
            }

//          ---- Filtragem dos dados ----
            $dadosHigiene = array(
                'paciente' => $paciente,
                'escovacao' => $dados['escovacao'],
                'fioDental' => $dados['fio_dental'],
                'bochecho' => $dados['bochecho'],
            );

            $dadosQueixa = array(
                'queixa' => $dados['queixa'],
                'paciente' => $paciente,
            );

            $dadosParafuncionais = array();
            $dadosHistoria = array();
            $i = 1;
            foreach ($dados as $dado) {

                if (isset($dados["estado-{$i}"])) {
                    $dadosHistoria[$i] = array(
                        'doencasPreexistente' => $repoDoencas->find($i),
                        'paciente' => $paciente,
                        'estado' => $dados["estado-{$i}"],
                        'antFamiliar' => $dados["familiar-{$i}"],
                        'obs' => $dados["obs-{$i}"]
                    );
                }

                if (isset($dados["habito-{$i}"])) {
                    $dadosParafuncionais[$i] = array(
                        'habito' => $repoTipoHabito->find($i),
                        'estado' => $dados["habito-{$i}"],
                        'paciente' => $paciente
                    );
                }
                $i++;
            }
//          ---- /Filtragem dos dados ----

//          ---- Inserção dos dados ----
            if ($paciente) {
                foreach ($dadosParafuncionais as $p) {
                    $parafunional = new Parafuncionais($p);
                    $paciente->setParafuncionais($parafunional);
                }

                foreach ($dadosHistoria as $h) {
                    $historia = new HistoriaMedica($h);
                    $paciente->setHistoriaMedica($historia);
                }

                $queixa = new QueixaPricipal($dadosQueixa);
                $paciente->setQueixaPrincipal($queixa);

                $higiene = new Higiene($dadosHigiene);
                $paciente->setHigiene($higiene);

                $this->persist($paciente);
            } else {
                throw new \Exception("Paciente não localizado.");
            }
//          ---- /Inserção dos dados ----
            return $this->msgSuccess($params);
        } else {
            throw new \Exception("Método inválido.");
        }
    }

    public function agendamento()
    {
        return $this->app['twig']->render('cadastro/agendamento.twig', array(
            "active_page" => "cadAgendamento",
        ));
    }

    public function salvarAgendamento()
    {
        $this->entity = 'odontoIFMA\entity\Agendamento'; //Define a entidade que será usada
        $repoPaciente = $this->em->getRepository('odontoIFMA\entity\Paciente');
        $repoDentista = $this->em->getRepository('odontoIFMA\entity\Operador');
        //Define os parâmetros que serão usados na renderização da tela com retorno da operação
        $params = array(
            'message' => 'Agendamento cadastrado com sucesso.', //Mensagem a ser exibida
            'titulo' => 'Sucesso!', // Título da mensagem
            'tipo' => 'alert-success', // Define o tipo da mensagem, erro ou sucesso
            'icon' => 'glyphicon-ok', // Ícone do título da mensagem
            'active_page' => 'cadAgendamento', // Define a página ativa no menu e breadcrumb
            'btVoltar' => '/cadastro/agendamento' // Define a rota do botão voltar
        );

        if ($this->app['request']->getMethod() == 'POST') {
            $request = $this->app['request']->request;
            $dados = $request->all();

            if (isset($dados['pacienteId'])) {
                $paciente = $repoPaciente->find($dados['pacienteId']); // Recupera o objeto Paciente
                if ($paciente) {
                    $dados['paciente'] = $paciente;
                } else {
                    throw new \Exception("Paciente não encontrado.");
                }
            } else {
                throw new \Exception("Id do paciente não informado.");
            }

            if (isset($dados['dentistaId'])) {
                $dentista = $repoDentista->find($dados['dentistaId']); // Recupera o objeto Operador/Dentista
                if ($dentista) {
                    $dados['dentista'] = $dentista;
                } else {
                    throw new \Exception("Dentista não encontrado.");
                }
            } else {
                throw new \Exception("Id do dentista não informado.");
            }

            $dados['criadoEm'] = new \DateTime('now');


//            print_r($dados);die();
            $this->insert($dados);

            return $this->msgSuccess($params);
        } else {
            throw new \Exception("Método inválido.");
        }

    }

    /**
     * Recupera lista de pacientes
     * @param string param - parte do nome do paciente
     * @return mixed Retorna lista de pacientes no formato Json
     */
    public function getPacientesJson()
    {
        $request = $this->app['request']->request;
        $dados = $request->all();

        $sql = "SELECT paciente.*,campus.nome AS campus,DATE_FORMAT(data_nasc,'%d/%m/%Y') AS data_nasc, paciente.nome as value FROM paciente JOIN campus ON campus.id = paciente.campus_id WHERE paciente.nome LIKE :param";
        $pacientes = $this->findLike($sql, $dados['param']);

        return $this->app->json($pacientes);

    }

    /**
     * Recupera lista de dentistas
     * @param string param - parte do nome do dentista
     * @return mixed Retorna lista de dentistas no formato Json
     */
    public function getDentistasJson()
    {
        $request = $this->app['request']->request;
        $dados = $request->all();

        $sql = "SELECT *, odontoifma.operador.nome AS value FROM odontoifma.operador WHERE tipo_operador = 3 AND operador.nome LIKE :param";
        $pacientes = $this->findLike($sql, $dados['param']);

        return $this->app->json($pacientes);

    }

    /**
     * Recupera agendamentos
     * @param array $dados com o intervalo de datas ou informa que é do dia
     * @return array
     */
    public function getAgendamentos(array $dados)
    {
        $today = new \DateTime('now');
        if (isset($dados['doDia'])) {
            $dtInicial = $dtFinal = $today->format('d/m/Y');
        }else{
            $dtInicial = $dados['dtInicial'];
            $dtFinal = $dados['dtFinal'];
        }

        $sql = "SELECT * FROM getAgendamentos WHERE data_agendamento BETWEEN :dateIni AND :dateFim";

        return $this->findDateInterval($sql, $dtInicial, $dtFinal);
    }
}
