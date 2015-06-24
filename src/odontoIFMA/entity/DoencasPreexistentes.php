<?php
/**
 * Entidade DoencasPreexistentes
 */

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
     * Atributo familiar
     * @var integer $familiar
     * @ORM\Column(name="familiar", type="integer", nullable=true)
     */
    private $familiar;

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
     */
    public function setNome($nome)
    {
        $this->nome = mb_strtoupper(trim($nome), 'UTF-8');
    }

    /**
     * Retorna atributo familiar
     * @return int
     */
    public function getFamiliar()
    {
        return $this->familiar;
    }

    /**
     * Seta atributo familiar
     * @param int $familiar
     */
    public function setFamiliar($familiar)
    {
        $this->familiar = $familiar;
    }

}