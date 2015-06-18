<?php

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
     * @var integer $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var TipoHabito $habito
     * @ORM\ManyToOne(targetEntity="TipoHabito")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="habito", referencedColumnName="id")
     * })
     */
    private $habito;

    /**
     * @var boolean $estado
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado;

    /**
     * @var Paciente $paciente
     * @ORM\ManyToOne(targetEntity="Paciente", inversedBy="parafuncionais")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="paciente", referencedColumnName="id")
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
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return TipoHabito
     */
    public function getHabito()
    {
        return $this->habito;
    }

    /**
     * @param TipoHabito $habito
     */
    public function setHabito($habito)
    {
        $this->habito = $habito;
    }

    /**
     * @return boolean
     */
    public function isEstado()
    {
        return $this->estado;
    }

    /**
     * @param boolean $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
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
     */
    public function setPaciente($paciente)
    {
        $this->paciente = $paciente;
    }

}