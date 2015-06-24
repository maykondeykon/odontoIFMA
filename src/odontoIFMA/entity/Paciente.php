<?php
/**
 * Entidade Paciente
 */
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
     * Atributo id
     * @var integer $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Atributo nome
     * @var string $nome
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * Atributo dtNascimento
     * @var datetime $dtNascimento
     * @ORM\Column(name="data_nasc", type="datetime", nullable=false)
     */
    private $dtNascimento;

    /**
     * Atributo turma
     * @var string $turma
     * @ORM\Column(name="turma", type="string", length=255, nullable=false)
     */
    private $turma;

    /**
     * Atributo naturalidade
     * @var string $naturalidade
     * @ORM\Column(name="naturalidade", type="string", length=255, nullable=false)
     */
    private $naturalidade;

    /**
     * Atributo telefone
     * @var string $telefone
     * @ORM\Column(name="telefone", type="string", length=255, nullable=false)
     */
    private $telefone;

    /**
     * Atributo sexo
     * @var string $sexo
     * @ORM\Column(name="sexo", type="string", length=255, nullable=false)
     */
    private $sexo;

    /**
     * Atributo raca
     * @var string $raca
     * @ORM\Column(name="raca", type="string", length=255, nullable=false)
     */
    private $raca;

    /**
     * Atributo matricula
     * @var string $matricula
     * @ORM\Column(name="matricula", type="string", length=255, nullable=true)
     */
    private $matricula;

    /**
     * Atributo campus
     * @var Campus $campus
     * @ORM\ManyToOne(targetEntity="Campus")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="campus_id", referencedColumnName="id")
     * })
     */
    private $campus;

    /**
     * Atributo parafuncionais
     * @var Parafuncionais $parafuncionais
     * @ORM\OneToMany(targetEntity="Parafuncionais", mappedBy="paciente" ,cascade={"persist", "remove"})
     **/
    private $parafuncionais;

    /**
     * Atributo queixaPrincipal
     * @var QueixaPricipal $queixaPrincipal
     * @ORM\OneToMany(targetEntity="QueixaPricipal", mappedBy="paciente" ,cascade={"persist", "remove"})
     **/
    private $queixaPrincipal;

    /**
     * Atributo higiene
     * @var Higiene $higiene
     * @ORM\OneToOne(targetEntity="Higiene", mappedBy="paciente" ,cascade={"persist", "remove"})
     */
    private $higiene;

    /**
     * Atributo historiaMedica
     * @var HistoriaMedica $historiaMedica
     * @ORM\OneToMany(targetEntity="HistoriaMedica", mappedBy="paciente" ,cascade={"persist", "remove"})
     **/
    private $historiaMedica;

    /**
     * Inicializa entidade
     * @param array $data Dados para popular entidade
     */
    public function __construct(array $data = array())
    {
        (new Hydrator\ClassMethods())->hydrate($data, $this);

        $this->parafuncionais = new ArrayCollection();
        $this->queixaPrincipal = new ArrayCollection();
        $this->historiaMedica = new ArrayCollection();
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
     * @return object $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Retorna atributo nome
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Seta atributo nome
     * @param string $nome
     * @return object $this
     */
    public function setNome($nome)
    {
        $this->nome = ucwords(mb_strtolower(trim($nome), 'UTF-8'));
        return $this;
    }

    /**
     * Retorna atributo dtaNascimento
     * @return datetime
     */
    public function getDtNascimento()
    {
        return $this->dtNascimento;
    }

    /**
     * Seta atributo dtNascimento
     * @param datetime $dtNascimento
     * @return object $this
     */
    public function setDtNascimento($dtNascimento)
    {
        $this->dtNascimento = date_create_from_format('d/m/Y', $dtNascimento);
        return $this;
    }

    /**
     * Retorna atributo turma
     * @return string
     */
    public function getTurma()
    {
        return $this->turma;
    }

    /**
     * Seta atributo turma
     * @param string $turma
     * @return object $this
     */
    public function setTurma($turma)
    {
        $this->turma = $turma;
        return $this;
    }

    /**
     * Retorna atributo naturalidade
     * @return string
     */
    public function getNaturalidade()
    {
        return $this->naturalidade;
    }

    /**
     * Seta atributo naturalidade
     * @param string $naturalidade
     * @return object $this
     */
    public function setNaturalidade($naturalidade)
    {
        $this->naturalidade = mb_strtoupper(trim($naturalidade), 'UTF-8');
        return $this;
    }

    /**
     * Retorna atributo telefone
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Seta atributo telefone
     * @param string $telefone
     * @return object $this
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
        return $this;
    }

    /**
     * Retorna atributo sexo
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Seta atributo sexo
     * @param string $sexo
     * @return object $this
     */
    public function setSexo($sexo)
    {
        $this->sexo = mb_strtoupper(trim($sexo), 'UTF-8');
        return $this;
    }

    /**
     * Retorna atributo raca
     * @return string
     */
    public function getRaca()
    {
        return $this->raca;
    }

    /**
     * Seta atributo raca
     * @param string $raca
     * @return object $this
     */
    public function setRaca($raca)
    {
        $this->raca = mb_strtoupper(trim($raca), 'UTF-8');
        return $this;
    }

    /**
     * Retorna atributo matricula
     * @return string
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Seta atributo matricula
     * @param string $matricula
     * @return object $this
     */
    public function setMatricula($matricula)
    {
        $this->matricula = mb_strtoupper(trim($matricula), 'UTF-8');
        return $this;
    }

    /**
     * Retorna atributo campus
     * @return object Campus
     */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * Seta atributo campus
     * @param Campus $campus
     * @return object $this
     */
    public function setCampus($campus)
    {
        $this->campus = $campus;
        return $this;
    }

    /**
     * Retorna atributo parafuncionais
     * @return object Parafuncionais
     */
    public function getParafuncionais()
    {
        return $this->parafuncionais;
    }

    /**
     * Seta atributo parafuncionais
     * @param Parafuncionais $parafuncionais
     * @return object $this
     */
    public function setParafuncionais(Parafuncionais $parafuncionais)
    {
        $this->parafuncionais[] = $parafuncionais;
        return $this;
    }

    /**
     * Retorna atributo queixaPrincipal
     * @return object QueixaPricipal
     */
    public function getQueixaPrincipal()
    {
        return $this->queixaPrincipal;
    }

    /**
     * Seta atributo queixaPricipal
     * @param QueixaPricipal $queixaPrincipal
     * @return object $this
     */
    public function setQueixaPrincipal(QueixaPricipal $queixaPrincipal)
    {
        $this->queixaPrincipal[] = $queixaPrincipal;
        return $this;
    }

    /**
     * Retorna atributo higiene
     * @return object Higiene
     */
    public function getHigiene()
    {
        return $this->higiene;
    }

    /**
     * Seta atributo higiene
     * @param Higiene $higiene
     * @return object $this
     */
    public function setHigiene(Higiene $higiene)
    {
        $this->higiene = $higiene;
        return $this;
    }

    /**
     * Retorna atributo historiaMedica
     * @return object HistoriaMedica
     */
    public function getHistoriaMedica()
    {
        return $this->historiaMedica;
    }

    /**
     * Seta atributo historiaMedica
     * @param HistoriaMedica $historiaMedica
     * @return object $this
     */
    public function setHistoriaMedica(HistoriaMedica $historiaMedica)
    {
        $this->historiaMedica[] = $historiaMedica;
        return $this;
    }

}