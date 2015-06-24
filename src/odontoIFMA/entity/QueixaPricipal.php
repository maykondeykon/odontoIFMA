<?php
/**
 * Entidade QueixaPricipal
 */

namespace odontoIFMA\entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Class QueixaPricipal
 * @package odontoIFMA\entity
 * @ORM\Entity
 * @ORM\Table(name="queixa_principal")
 */
class QueixaPricipal
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
     * Atributo queixa
     * @var string $queixa
     * @ORM\Column(name="queixa", type="string", length=255, nullable=false)
     */
    private $queixa;

    /**
     * Atributo paciente
     * @var Paciente $paciente
     * @ORM\ManyToOne(targetEntity="Paciente", inversedBy="queixaPrincipal")
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
     * Retorna atributo queixa
     * @return string
     */
    public function getQueixa()
    {
        return $this->queixa;
    }

    /**
     * Seta atributo queixa
     * @param string $queixa
     */
    public function setQueixa($queixa)
    {
        $this->queixa = $queixa;
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