<?php

namespace odontoIFMA\entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Class DoencasPreexistentes
 * @package odontoIFMA\entity
 * @ORM\Entity
 * @ORM\Table(name="doencas_preexistentes")
 */
class DoencasPreexistentes
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
     * @var integer $familiar
     * @ORM\Column(name="familiar", type="integer", nullable=true)
     */
    private $familiar;

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
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = mb_strtoupper(trim($nome), 'UTF-8');
    }

    /**
     * @return int
     */
    public function getFamiliar()
    {
        return $this->familiar;
    }

    /**
     * @param int $familiar
     */
    public function setFamiliar($familiar)
    {
        $this->familiar = $familiar;
    }

}