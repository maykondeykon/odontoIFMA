<?php
/**
 * Entidade Higiene
 */

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
     * Atributo id
     * @var integer $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Atributo paciente
     * @var Paciente $paciente
     * @ORM\OneToOne(targetEntity="Paciente", inversedBy="higiene")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="paciente", referencedColumnName="id")
     * })
     */
    private $paciente;

    /**
     * Atributo escovacao
     * @var integer $escovacao ;
     * @ORM\Column(name="escovacao", type="integer", nullable=true)
     */
    private $escovacao;

    /**
     * Atributo fioDental
     * @var boolean $fioDental
     * @ORM\Column(name="fio_dental", type="boolean", nullable=false)
     */
    private $fioDental;

    /**
     * Atributo bochecho
     * @var boolean $bochecho
     * @ORM\Column(name="bochecho", type="boolean", nullable=false)
     */
    private $bochecho;

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
     * Retorna atributo paciente
     * @return Paciente
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

    /**
     * Retorna atributo escovacao
     * @return int
     */
    public function getEscovacao()
    {
        return $this->escovacao;
    }

    /**
     * Seta atributo escovacao
     * @param int $escovacao
     */
    public function setEscovacao($escovacao)
    {
        $this->escovacao = $escovacao;
    }

    /**
     * Retorna atributo fioDental
     * @return boolean
     */
    public function isFioDental()
    {
        return $this->fioDental;
    }

    /**
     * Seta atributo fioDental
     * @param boolean $fioDental
     */
    public function setFioDental($fioDental)
    {
        $this->fioDental = $fioDental;
    }

    /**
     * Retorna atributo bochecho
     * @return boolean
     */
    public function isBochecho()
    {
        return $this->bochecho;
    }

    /**
     * Seta atributo bochecho
     * @param boolean $bochecho
     */
    public function setBochecho($bochecho)
    {
        $this->bochecho = $bochecho;
    }
}