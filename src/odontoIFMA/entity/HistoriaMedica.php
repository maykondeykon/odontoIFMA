<?php

namespace odontoIFMA\entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Class HistoriaMedica
 * @package odontoIFMA\entity
 * @ORM\Entity
 * @ORM\Table(name="historia_medica")
 */
class HistoriaMedica
{
    /**
     * @var integer $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Paciente $doencasPreexistente
     * @ORM\ManyToOne(targetEntity="DoencasPreexistentes")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="doenca_preexistente", referencedColumnName="id")
     * })
     */
    private $doencasPreexistente;

    /**
     * @var boolean $estado
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado;

    /**
     * @var string $obs
     * @ORM\Column(name="obs", type="string", length=255, nullable=true)
     */
    private $obs;

    /**
     * @var Paciente $paciente
     * @ORM\ManyToOne(targetEntity="Paciente")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="paciente", referencedColumnName="id")
     * })
     */
    private $paciente;

    /**
     * @var integer $antFamiliar
     * @ORM\Column(name="ant_familiar", type="integer", nullable=true)
     */
    private $antFamiliar;

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
     * @return Paciente
     */
    public function getDoencasPreexistente()
    {
        return $this->doencasPreexistente;
    }

    /**
     * @param Paciente $doencasPreexistente
     */
    public function setDoencasPreexistente($doencasPreexistente)
    {
        $this->doencasPreexistente = $doencasPreexistente;
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
     * @return string
     */
    public function getObs()
    {
        return $this->obs;
    }

    /**
     * @param string $obs
     */
    public function setObs($obs)
    {
        $this->obs = $obs;
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

    /**
     * @return int
     */
    public function getAntFamiliar()
    {
        return $this->antFamiliar;
    }

    /**
     * @param int $antFamiliar
     */
    public function setAntFamiliar($antFamiliar)
    {
        $this->antFamiliar = $antFamiliar;
    }

}