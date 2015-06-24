<?php
/**
 * Entidade Atendimento
 */
namespace odontoIFMA\entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Class Atendimento
 * @package odontoIFMA\entity
 * @ORM\Entity
 * @ORM\Table(name="atendimentos")
 */
class Atendimento
{
    /**
     * Atributo id
     * @var integer $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Atributo data_agendamento
     * @var datetime $data_agendamento
     * @ORM\Column(name="data_agendamento", type="datetime", nullable=false)
     */
    private $data_agendamento;

    /**
     * Atributo data_atendimento
     * @var datetime $data_atendimennto
     * @ORM\Column(name="data_atendimento", type="datetime", nullable=true)
     */
    private $data_atendimento;

    /**
     * Atributo descricao
     * @var string $descricao
     * @ORM\Column(name="descricao", type="string", length=100, nullable=false)
     */
    private $descricao;

    /**
     * Atributo paciente
     * @var Paciente $paciente
     * @ORM\ManyToOne(targetEntity="Paciente")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="paciente_id", referencedColumnName="id")
     * })
     */
    private $paciente;

    /**
     * Inicializa entidade
     * @param array $data Dados para popular entidade
     */
    public function __construct(array $data = array())
    {
        (new Hydrator\ClassMethods())->hydrate($data, $this);
    }

    /**
     * Converte a entidade em array
     * @return array
     */
    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }

    /**
     * Retorna atributo id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Seta atributo id
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Retorna atributo descricao
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Seta atributo descricao
     * @param string $descricao
     * @return object $this
     */
    public function setDescricao($descricao)
    {
        $this->descricao = mb_strtoupper(trim($descricao), 'UTF-8');
        return $this;
    }

    /**
     * Retorna atributo data_agendamento
     * @return datetime
     */
    public function getDataAgendamento()
    {
        return $this->data_agendamento;
    }

    /**
     * Seta atributo data_agendamento
     * @param datetime $data_agendamento
     * @return $this
     */
    public function setDataAgendamento($data_agendamento)
    {
        $this->data_agendamento = date_create_from_format('d/m/Y', $data_agendamento);
        return $this;
    }

    /**
     * Retorna atributo data_atendimento
     * @return datetime
     */
    public function getDataAtendimento()
    {
        return $this->data_atendimento;
    }

    /**
     * Seta atributo data_atendimento
     * @param $data_atendimento
     * @return object $this
     */
    public function setDataAtendimento($data_atendimento)
    {
        $this->data_atendimento = date_create_from_format('d/m/Y', $data_atendimento);
        return $this;
    }

    /**
     * Retorna atributo paciente
     * @return object Paciente
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Seta atributo paciente
     * @param Paciente $paciente
     * @return object $this
     */
    public function setPaciente($paciente)
    {
        $this->paciente = $paciente;
        return $this;
    }


}