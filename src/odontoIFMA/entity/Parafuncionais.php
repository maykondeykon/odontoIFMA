<?php
/**
 * Entidade Parafuncionais
 */

namespace odontoIFMA\entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Class Parafuncionais
 * @package odontoIFMA\entity
 * @ORM\Entity
 * @ORM\Table(name="parafuncionais")
 */
class Parafuncionais
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
     * Atributo habito
     * @var TipoHabito $habito
     * @ORM\ManyToOne(targetEntity="TipoHabito")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="habito", referencedColumnName="id")
     * })
     */
    private $habito;

    /**
     * Atributo estado
     * @var boolean $estado
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado;

    /**
     * Atributo paciente
     * @var Paciente $paciente
     * @ORM\ManyToOne(targetEntity="Paciente", inversedBy="parafuncionais")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="paciente", referencedColumnName="id")
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
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Retorna atributo habito
     * @return TipoHabito
     */
    public function getHabito()
    {
        return $this->habito;
    }

    /**
     * Seta atributo habito
     * @param TipoHabito $habito
     */
    public function setHabito($habito)
    {
        $this->habito = $habito;
    }

    /**
     * Retorna atributo estado
     * @return boolean
     */
    public function isEstado()
    {
        return $this->estado;
    }

    /**
     * Seta atributo estado
     * @param boolean $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
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
     */
    public function setPaciente($paciente)
    {
        $this->paciente = $paciente;
    }

}