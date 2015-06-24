<?php
/**
 * Entidade TipoOperador
 */

namespace odontoIFMA\entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Class TipoOperador
 * @package odontoIFMA\entity
 * @ORM\Entity
 * @ORM\Table(name="tipo_operador")
 */
class TipoOperador
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
     * Atributo descricao
     * @var string $descricao
     * @ORM\Column(name="descricao", type="string", length=255, nullable=false)
     */
    private $descricao;

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
     * @return object $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Retorna atributo descricao
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Seta atributo descricao
     * @param string $descricao
     * @return object $this
     */
    public function setDescricao($descricao)
    {
        $this->descricao = mb_strtoupper(trim($descricao), 'UTF-8');
        return $this;
    }

}