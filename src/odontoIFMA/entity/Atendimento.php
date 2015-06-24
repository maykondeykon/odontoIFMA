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
     * Atributo data
     * @var datetime $data
     * @ORM\Column(name="data", type="datetime", nullable=false)
     */
    private $data;

    /**
     * Atributo descricao
     * @var string $descricao
     * @ORM\Column(name="descricao", type="string", length=100, nullable=false)
     */
    private $descricao;

     /**
      * Atributo campus
     * @var Campus $campus
     * @ORM\ManyToOne(targetEntity="Campus")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="paciente_campus_id", referencedColumnName="id")
     * })
     */
    private $campus;

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
     * @return object $this
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
     * Retorna atributo data
     * @return datetime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Seta atributo data
     * @param datetime $data
     * @return object $this
     */
    public function setData($data)
    {
        $this->data = date_create_from_format('d/m/Y', $data);
        return $this;
    }

     /**
      * Retorna atributo campus
     * @return object Campus
     */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * Seta atributo campus
     * @param Campus $campus
     * @return $this
     */
    public function setCampus($campus)
    {
        $this->campus = $campus;
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
     * @return $this
     */
    public function setPaciente($paciente)
    {
        $this->paciente = $paciente;
        return $this;
    }


    
}