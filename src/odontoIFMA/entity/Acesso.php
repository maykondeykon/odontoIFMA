<?php
/**
 * Entidade Acesso
 */

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
     * Atributo id
     * @var integer $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Atributo login
     * @var string $login
     * @ORM\Column(name="login", type="string", length=255, nullable=false)
     */
    private $login;

    /**
     * Atributo senha
     * @var string $senha
     * @ORM\Column(name="senha", type="string", length=255, nullable=false)
     */
    private $senha;

    /**
     * Atributo operador
     * @var Operador $operador
     * @ORM\OneToOne(targetEntity="Operador", inversedBy="acesso")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="operador_id", referencedColumnName="id")
     * })
     */
    private $operador;

    /**
     * Atributo salt
     * @var string $salt
     */
    private $salt;

    /**
     * Inicializa entidade
     * @param array $data Dados para popular entidade
     */
    public function __construct(array $data = array())
    {
        (new Hydrator\ClassMethods())->hydrate($data, $this);
        $this->salt = base64_encode(hash("SHA256", '19|20)\d\d([- /.])(0[1-9]|1[012])\2([012][0-9]|3[01]', true));
    }

    /**
     * Encripta senha
     * @param string $password
     * @return string Senha criptografada
     */
    public function encryptPassword($password)
    {
        return md5($this->salt . $password . $this->salt);
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
     * Retorna atributo login
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Seta atributo login
     * @param string $login
     * @return object $this
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * Retorna atributo senha
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Seta atributo senha
     * @param string $senha
     * @return object $this
     */
    public function setSenha($senha)
    {
        $this->senha = $this->encryptPassword(trim($senha));
        return $this;
    }

    /**
     * Retorna atributo operador
     * @return object Operador
     */
    public function getOperador()
    {
        return $this->operador;
    }

    /**
     * Seta atributo operador
     * @param Operador $operador
     * @return object $this
     */
    public function setOperador($operador)
    {
        $this->operador = $operador;
        return $this;
    }

}