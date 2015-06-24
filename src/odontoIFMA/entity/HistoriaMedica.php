<?php
/**
 * Entidade HistoriaMedica
 */

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
     * Atributo id
     * @var integer $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Atributo doencasPreexistentes
     * @var Paciente $doencasPreexistente
     * @ORM\ManyToOne(targetEntity="DoencasPreexistentes")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="doenca_preexistente", referencedColumnName="id")
     * })
     */
    private $doencasPreexistente;

    /**
     * Atributo estado
     * @var boolean $estado
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado;

    /**
     * Atributo obs
     * @var string $obs
     * @ORM\Column(name="obs", type="string", length=255, nullable=true)
     */
    private $obs;

    /**
     * Atributo paciente
     * @var Paciente $paciente
     * @ORM\ManyToOne(targetEntity="Paciente", inversedBy="historiaMedica")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="paciente", referencedColumnName="id")
     * })
     */
    private $paciente;

    /**
     * Atributo antFamiliar
     * @var integer $antFamiliar
     * @ORM\Column(name="ant_familiar", type="integer", nullable=true)
     */
    private $antFamiliar;

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
     * Retorna atributo doencasPreexistente
     * @return object Paciente
     */
    public function getDoencasPreexistente()
    {
        return $this->doencasPreexistente;
    }

    /**
     * Seta atributo doencasPreexistente
     * @param Paciente $doencasPreexistente
     */
    public function setDoencasPreexistente($doencasPreexistente)
    {
        $this->doencasPreexistente = $doencasPreexistente;
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
     */
    public function setObs($obs)
    {
        $this->obs = $obs;
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
     * Retorna atributo antFamiliar
     * @return int
     */
    public function getAntFamiliar()
    {
        return $this->antFamiliar;
    }

    /**
     * Seta atributo antFamiliar
     * @param int $antFamiliar
     */
    public function setAntFamiliar($antFamiliar)
    {
        $this->antFamiliar = $antFamiliar;
    }

}