<?php

namespace odontoIFMA\entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Class Higiene
 * @package odontoIFMA\entity
 * @ORM\Entity
 * @ORM\Table(name="higiene")
 */
class Higiene
{
    /**
     * @var integer $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Paciente $paciente
     * @ORM\ManyToOne(targetEntity="Paciente")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="paciente", referencedColumnName="id")
     * })
     */
    private $paciente;

    /**
     * @var integer $escovacao ;
     * @ORM\Column(name="escovacao", type="integer", nullable=true)
     */
    private $escovacao;

    /**
     * @var boolean $fioDental
     * @ORM\Column(name="fio_dental", type="boolean", nullable=false)
     */
    private $fioDental;

    /**
     * @var boolean $bochecho
     * @ORM\Column(name="bochecho", type="boolean", nullable=false)
     */
    private $bochecho;

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
    public function getEscovacao()
    {
        return $this->escovacao;
    }

    /**
     * @param int $escovacao
     */
    public function setEscovacao($escovacao)
    {
        $this->escovacao = $escovacao;
    }

    /**
     * @return boolean
     */
    public function isFioDental()
    {
        return $this->fioDental;
    }

    /**
     * @param boolean $fioDental
     */
    public function setFioDental($fioDental)
    {
        $this->fioDental = $fioDental;
    }

    /**
     * @return boolean
     */
    public function isBochecho()
    {
        return $this->bochecho;
    }

    /**
     * @param boolean $bochecho
     */
    public function setBochecho($bochecho)
    {
        $this->bochecho = $bochecho;
    }
}