<?php
namespace odontoIFMA\entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Class Paciente
 * @package odontoIFMA\entity
 * @ORM\Entity
 * @ORM\Table(name="paciente")
 */
class Paciente
{

    /**
     * @var integer $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $nome
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @var datetime $dtNascimento
     * @ORM\Column(name="data_nasc", type="datetime", nullable=false)
     */
    private $dtNascimento;

    /**
     * @var string $turma
     * @ORM\Column(name="turma", type="string", length=255, nullable=false)
     */
    private $turma;

    /**
     * @var string $naturalidade
     * @ORM\Column(name="naturalidade", type="string", length=255, nullable=false)
     */
    private $naturalidade;

    /**
     * @var string $telefone
     * @ORM\Column(name="telefone", type="string", length=255, nullable=false)
     */
    private $telefone;

    /**
     * @var string $sexo
     * @ORM\Column(name="sexo", type="string", length=255, nullable=false)
     */
    private $sexo;

    /**
     * @var string $raca
     * @ORM\Column(name="raca", type="string", length=255, nullable=false)
     */
    private $raca;

    /**
     * @var string $matricula
     * @ORM\Column(name="matricula", type="string", length=255, nullable=true)
     */
    private $matricula;

    /**
     * @var Campus $campus
     * @ORM\ManyToOne(targetEntity="Campus")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="campus_id", referencedColumnName="id")
     * })
     */
    private $campus;

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
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return $this
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return datetime
     */
    public function getDtNascimento()
    {
        return $this->dtNascimento;
    }

    /**
     * @param datetime $dtNascimento
     * @return $this
     */
    public function setDtNascimento($dtNascimento)
    {
        $this->dtNascimento = (new \DateTime($dtNascimento));
        return $this;
    }

    /**
     * @return string
     */
    public function getTurma()
    {
        return $this->turma;
    }

    /**
     * @param string $turma
     * @return $this
     */
    public function setTurma($turma)
    {
        $this->turma = $turma;
        return $this;
    }

    /**
     * @return string
     */
    public function getNaturalidade()
    {
        return $this->naturalidade;
    }

    /**
     * @param string $naturalidade
     * @return $this
     */
    public function setNaturalidade($naturalidade)
    {
        $this->naturalidade = $naturalidade;
        return $this;
    }

    /**
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param string $telefone
     * @return $this
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
        return $this;
    }

    /**
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param string $sexo
     * @return $this
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
        return $this;
    }

    /**
     * @return string
     */
    public function getRaca()
    {
        return $this->raca;
    }

    /**
     * @param string $raca
     * @return $this
     */
    public function setRaca($raca)
    {
        $this->raca = $raca;
        return $this;
    }

    /**
     * @return string
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * @param string $matricula
     * @return $this
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
        return $this;
    }

    /**
     * @return Campus
     */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * @param Campus $campus
     * @return $this
     */
    public function setCampus($campus)
    {
        $this->campus = $campus;
        return $this;
    }

}