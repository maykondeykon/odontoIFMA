<?php
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
     * @var string $documento
     * @ORM\Column(name="documento", type="string", length=255, nullable=true)
     */
    private $documento;

    /**
     * @var TipoOperador $tipo
     * @ORM\ManyToOne(targetEntity="TipoOperador")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="tipo_operador", referencedColumnName="id")
     * })
     */
    private $tipo;

    /**
     * @var Acesso $acesso
     * @ORM\OneToOne(targetEntity="Acesso", mappedBy="operador" ,cascade={"persist", "remove"})
     */
    private $acesso;

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
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * @param string $documento
     * @return $this
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
        return $this;
    }

    /**
     * @return TipoOperador
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param TipoOperador $tipo
     * @return $this
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     * @return Acesso
     */
    public function getAcesso()
    {
        return $this->acesso;
    }

    /**
     * @param Acesso $acesso
     */
    public function setAcesso($acesso)
    {
        $this->acesso = $acesso;
    }

}