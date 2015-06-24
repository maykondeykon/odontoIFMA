<?php
/**
 * Entidade Operador
 */
namespace odontoIFMA\entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;


/**
 * Class Operador
 * @package odontoIFMA\entity
 * @ORM\Entity
 * @ORM\Table(name="operador")
 */
class Operador
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
     * Atributo documento
     * @var string $documento
     * @ORM\Column(name="documento", type="string", length=255, nullable=true)
     */
    private $documento;

    /**
     * Atributo tipo
     * @var TipoOperador $tipo
     * @ORM\ManyToOne(targetEntity="TipoOperador")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="tipo_operador", referencedColumnName="id")
     * })
     */
    private $tipo;

    /**
     * Atributo acesso
     * @var Acesso $acesso
     * @ORM\OneToOne(targetEntity="Acesso", mappedBy="operador" ,cascade={"persist", "remove"})
     */
    private $acesso;

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
     * @return $this
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
     * @return $this
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * Retorna atributo documento
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Seta atributo documento
     * @param string $documento
     * @return $this
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
        return $this;
    }

    /**
     * Retorna atributo tipo
     * @return object TipoOperador
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Seta atributo tipo
     * @param TipoOperador $tipo
     * @return object $this
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     * Retorna atributo acesso
     * @return object Acesso
     */
    public function getAcesso()
    {
        return $this->acesso;
    }

    /**
     * Seta atributo acesso
     * @param Acesso $acesso
     */
    public function setAcesso($acesso)
    {
        $this->acesso = $acesso;
    }

}