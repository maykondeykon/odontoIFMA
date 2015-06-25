<?php
/**
 * Entidade Agendamento
 */

namespace odontoIFMA\entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Class Agendamento
 * @package odontoIFMA\entity
 * @ORM\Entity
 * @ORM\Table(name="agendamento")
 */
class Agendamento
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
     * Atributo dtAgendamento
     * @var datetime $dtAgendamento
     * @ORM\Column(name="data_agendamento", type="datetime", nullable=false)
     */
    private $dtAgendamento;

    /**
     * Atributo dtAtendimento
     * @var datetime $dtAgendamento
     * @ORM\Column(name="data_atendimento", type="datetime", nullable=true)
     */
    private $dtAtendimento;

    /**
     * Atributo paciente
     * @var Paciente $paciente
     * @ORM\ManyToOne(targetEntity="Paciente")
     * @ORM\JoinColumn(name="paciente", referencedColumnName="id")
     */
    private $paciente;

    /**
     * Atributo dentista
     * @var Operador $paciente
     * @ORM\ManyToOne(targetEntity="Operador")
     * @ORM\JoinColumn(name="dentista", referencedColumnName="id")
     */
    private $dentista;

    /**
     * Atributo obs
     * @var string $obs
     * @ORM\Column(name="obs", type="string", length=255, nullable=true)
     */
    private $obs;

    /**
     * Atributo status
     * @var StatusAgendamento $status
     * @ORM\OneToOne(targetEntity="StatusAgendamento")
     * @ORM\JoinColumn(name="status", referencedColumnName="id")
     */
    private $status;

    /**
     * Atributo criadoEm
     * @var datetime $criadoEm
     * @ORM\Column(name="criado_em", type="datetime", nullable=false)
     */
    private $criadoEm;

    /**
     * Atributo atualizadoEm
     * @var datetime $atualizadoEm
     * @ORM\Column(name="alterado_em", type="datetime", nullable=true)
     */
    private $atualizadoEm;

    /**
     * Inicializa entidade
     * @param array $data Dados para popular entidade
     */
    public function __construct(array $data = array())
    {
        if($this->getDtAgendamento() != null){
            $data['dtAgendamento'] = $this->getDtAgendamento()->format('d/m/Y H:i');
        }
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
     * @return object $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Retorna atributo dtAgendamento
     * @return datetime
     */
    public function getDtAgendamento()
    {
        return $this->dtAgendamento;
    }

    /**
     * Seta atributo dtAgendamento
     * @param datetime $dtAgendamento
     * @return object $this
     */
    public function setDtAgendamento($dtAgendamento)
    {
        $this->dtAgendamento = date_create_from_format('d/m/Y H:i', $dtAgendamento);
        return $this;
    }

    /**
     * Retorna atributo dtAtendimento
     * @return datetime
     */
    public function getDtAtendimento()
    {
        return $this->dtAtendimento;
    }

    /**
     * Seta atributo dtAtendimento
     * @param datetime $dtAtendimento
     * @return object $this
     */
    public function setDtAtendimento($dtAtendimento)
    {
        $this->dtAtendimento = date_create_from_format('d/m/Y H:i', $dtAtendimento);
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

    /**
     * Retorna atributo dentista
     * @return object Operador
     */
    public function getDentista()
    {
        return $this->dentista;
    }

    /**
     * Seta atributo dentista
     * @param Operador $dentista
     * @return object $this
     */
    public function setDentista($dentista)
    {
        $this->dentista = $dentista;
        return $this;
    }

    /**
     * Retorna atributo obs
     * @return string
     */
    public function getObs()
    {
        return $this->obs;
    }

    /**
     * Seta atributo obs
     * @param string $obs
     * @return object $this
     */
    public function setObs($obs)
    {
        $this->obs = $obs;
        return $this;
    }

    /**
     * Retorna atributo status
     * @return object StatusAgendamento
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Seta atributo status
     * @param StatusAgendamento $status
     * @return object $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Retorna atributo criadoEm
     * @return datetime
     */
    public function getCriadoEm()
    {
        return $this->criadoEm;
    }

    /**
     * Seta atributo criadoEm
     * @param datetime $criadoEm
     * @return object $this
     */
    public function setCriadoEm($criadoEm)
    {
        $this->criadoEm = $criadoEm;
        return $this;
    }

    /**
     * Retorna atributo atualizadoEm
     * @return datetime
     */
    public function getAtualizadoEm()
    {
        return $this->atualizadoEm;
    }

    /**
     * Seta atributo atualizadoEm
     * @param datetime $atualizadoEm
     * @return object $this
     */
    public function setAtualizadoEm($atualizadoEm)
    {
        $this->atualizadoEm = $atualizadoEm;
        return $this;
    }


}