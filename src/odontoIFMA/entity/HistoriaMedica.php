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
     * @ORM\ManyToOne(targetEntity="DoencasPreexistente")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="doencas_preexistente", referencedColumnName="id")
     * })
     */
    private $doencasPreexistente;

    /**
     * @var boolean $estado
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado;

    /**
     * @var string $qual
     * @ORM\Column(name="qual", type="string", length=255, nullable=true)
     */
    private $qual;

    /**
     * @var Paciente $paciente
     * @ORM\ManyToOne(targetEntity="Paciente")
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
    public function getQual()
    {
        return $this->qual;
    }

    /**
     * @param string $qual
     */
    public function setQual($qual)
    {
        $this->qual = $qual;
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