<?php

namespace odontoIFMA\entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Class Acesso
 * @package odontoIFMA\entity
 * @ORM\Entity
 * @ORM\Table(name="acesso")
 */
class Acesso
{
    /**
     * @var integer $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $login
     * @ORM\Column(name="login", type="string", length=255, nullable=false)
     */
    private $login;

    /**
     * @var string $senha
     * @ORM\Column(name="senha", type="string", length=255, nullable=false)
     */
    private $senha;

    /**
     * @var Operador $operador
     * @ORM\OneToOne(targetEntity="Operador", inversedBy="acesso")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="operador_id", referencedColumnName="id")
     * })
     */
    private $operador;

    private $salt;

    public function __construct(array $data = array())
    {
        (new Hydrator\ClassMethods())->hydrate($data, $this);
        $this->salt = base64_encode(hash("SHA256", '19|20)\d\d([- /.])(0[1-9]|1[012])\2([012][0-9]|3[01]', true));
    }

    public function encryptPassword($password)
    {
        return md5($this->salt . $password . $this->salt);
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
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return $this
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     * @return $this
     */
    public function setSenha($senha)
    {
        $this->senha = $this->encryptPassword(trim($senha));
        return $this;
    }

    /**
     * @return Operador
     */
    public function getOperador()
    {
        return $this->operador;
    }

    /**
     * @param Operador $operador
     * @return $this
     */
    public function setOperador($operador)
    {
        $this->operador = $operador;
        return $this;
    }

}