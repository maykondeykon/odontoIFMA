<?php

namespace odontoIFMA\entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Class TipoHabito
 * @package odontoIFMA\entity
 * @ORM\Entity
 * @ORM\Table(name="tipo_habito")
 *
 */
class TipoHabito
{
    /**
     * @var integer $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $descricao
     * @ORM\Column(name="descricao", type="string", length=255, nullable=false)
     */
    private $descricao;

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
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = mb_strtoupper(trim($descricao), 'UTF-8');
    }
}