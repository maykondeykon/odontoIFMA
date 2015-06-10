<?php

namespace odontoIFMA\entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Class QueixaPricipal
 * @package odontoIFMA\entity
 * @ORM\Entity
 * @ORM\Table(name="queixa_pricipal")
 */
class QueixaPricipal
{
    /**
     * @var integer $id
     * @ORM\Column(name="idqueixa_principal", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $queixa
     * @ORM\Column(name="queixa", type="string", length=255, nullable=false)
     */
    private $queixa;

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
     * @return string
     */
    public function getQueixa()
    {
        return $this->queixa;
    }

    /**
     * @param string $queixa
     */
    public function setQueixa($queixa)
    {
        $this->queixa = $queixa;
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