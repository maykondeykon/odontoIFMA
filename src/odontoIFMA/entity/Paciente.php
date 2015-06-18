<?php
namespace odontoIFMA\entity;

use Doctrine\Common\Collections\ArrayCollection;
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

    /**
     * @var Parafuncionais $parafuncionais
     * @ORM\OneToMany(targetEntity="Parafuncionais", mappedBy="paciente" ,cascade={"persist", "remove"})
     **/
    private $parafuncionais;

    /**
     * @var QueixaPricipal $queixaPrincipal
     * @ORM\OneToMany(targetEntity="QueixaPricipal", mappedBy="paciente" ,cascade={"persist", "remove"})
     **/
    private $queixaPrincipal;

    /**
     * @var Higiene $higiene
     * @ORM\OneToOne(targetEntity="Higiene", mappedBy="paciente" ,cascade={"persist", "remove"})
     */
    private $higiene;

    /**
     * @var HistoriaMedica $historiaMedica
     * @ORM\OneToMany(targetEntity="HistoriaMedica", mappedBy="paciente" ,cascade={"persist", "remove"})
     **/
    private $historiaMedica;

    public function __construct(array $data = array())
    {
        (new Hydrator\ClassMethods())->hydrate($data, $this);

        $this->parafuncionais = new ArrayCollection();
        $this->queixaPrincipal = new ArrayCollection();
        $this->historiaMedica = new ArrayCollection();
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
        $this->nome = ucwords(mb_strtolower(trim($nome), 'UTF-8'));
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
        $this->dtNascimento = date_create_from_format('d/m/Y', $dtNascimento);
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
        $this->naturalidade = mb_strtoupper(trim($naturalidade), 'UTF-8');
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
        $this->sexo = mb_strtoupper(trim($sexo), 'UTF-8');
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
        $this->raca = mb_strtoupper(trim($raca), 'UTF-8');
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
        $this->matricula = mb_strtoupper(trim($matricula), 'UTF-8');
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

    /**
     * @return Parafuncionais
     */
    public function getParafuncionais()
    {
        return $this->parafuncionais;
    }

    /**
     * @param Parafuncionais $parafuncionais
     * @return $this
     */
    public function setParafuncionais(Parafuncionais $parafuncionais)
    {
        $this->parafuncionais[] = $parafuncionais;
        return $this;
    }

    /**
     * @return QueixaPricipal
     */
    public function getQueixaPrincipal()
    {
        return $this->queixaPrincipal;
    }

    /**
     * @param QueixaPricipal $queixaPrincipal
     * @return $this
     */
    public function setQueixaPrincipal(QueixaPricipal $queixaPrincipal)
    {
        $this->queixaPrincipal[] = $queixaPrincipal;
        return $this;
    }

    /**
     * @return Higiene
     */
    public function getHigiene()
    {
        return $this->higiene;
    }

    /**
     * @param Higiene $higiene
     * @return $this
     */
    public function setHigiene(Higiene $higiene)
    {
        $this->higiene = $higiene;
        return $this;
    }

    /**
     * @return HistoriaMedica
     */
    public function getHistoriaMedica()
    {
        return $this->historiaMedica;
    }

    /**
     * @param HistoriaMedica $historiaMedica
     * @return $this
     */
    public function setHistoriaMedica(HistoriaMedica $historiaMedica)
    {
        $this->historiaMedica[] = $historiaMedica;
        return $this;
    }

}