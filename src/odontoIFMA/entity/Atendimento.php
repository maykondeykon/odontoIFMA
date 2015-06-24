<?php
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
     * @var integer $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var datetime $data_agendamento
     * @ORM\Column(name="data_agendamento", type="datetime", nullable=false)
     */
    private $data_agendamento;

     /**
     * @var datetime $data_atendimennto
     * @ORM\Column(name="data_atendimento", type="datetime", nullable=true)
     */
    private $data_atendimento;

    /**
     * @var string $descricao
     * @ORM\Column(name="descricao", type="string", length=100, nullable=false)
     */
    private $descricao;

        /**
     * @var Paciente $paciente
     * @ORM\ManyToOne(targetEntity="Paciente")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="paciente_id", referencedColumnName="id")
     * })
     */
    private $paciente;

    public function __construct(array $data = array())
    {
        (new Hydrator\ClassMethods())->hydrate($data, $this);
    }

    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     * @return $this
     */
    public function setDescricao($descricao)
    {
        $this->descricao = mb_strtoupper(trim($descricao), 'UTF-8');
        return $this;
    }

    /**
     * @return datetime
     */
    public function getDataAgendamento()
    {
        return $this->data_agendamento;
    }

    /**
     * @param datetime $data_agendamento
     * @return $this
     */
    public function setDataAgendamento($data_agendamento)
    {
        $this->data_agendamento = date_create_from_format('d/m/Y', $data_agendamento);
        return $this;
    }

     /**
     * @return datetime
     */
    public function getDataAtendimento()
    {
        return $this->data_atendimento;
    }

    /**
     * @param datetime $data_agendamento
     * @return $this
     */
    public function setDataAtendimento($data_atendimento)
    {
        $this->data_atendimento = date_create_from_format('d/m/Y', $data_atendimento);
        return $this;
    }
    
     /**
     * @return Paciente
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * @param Paciente $paciente
     * @return $this
     */
    public function setPaciente($paciente)
    {
        $this->paciente = $paciente;
        return $this;
    }


    
}