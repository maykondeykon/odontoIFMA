<?php
/**
 * Classe para abstração de funções
 */
namespace odontoIFMA\controller;

use odontoIFMA\entity\Permissao;


/**
 * Class AbstractController
 * @package odontoIFMA\controller
 */
abstract class AbstractController
{
    /**
     * @var object $app Recebe instância da aplicação
     */
    protected $app;
    /**
     * @var object $em Recebe instância do entity manager do Doctrine
     */
    protected $em;
    /**
     * @var String $entity Recebe o nome da entidade a ser instânciada
     */
    protected $entity;

    /**
     * Cria o objeto e insere no banco de dados
     * @param array $dados Dados para criação do objeto a ser persistido
     * @return object Retorna o objeto persistido
     * @throws \Exception Se os dados estiverem vazios
     */
    public function insert(array $dados)
    {
        if (null != $dados) {
            $entity = new $this->entity($dados);
            $this->persist($entity);
            return $entity;
        }

        throw new \Exception("Dados vazios.");
    }

    /**
     * Recupera o objeto e atualiza
     * @param array $dados Dados para localizar e atualizar o objeto
     * @return object Retorna o objeto atualizado
     * @throws \Exception Se os dados estiverem vazios ou o objeto não puder ser encontrado
     */
    public function update(array $dados)
    {
        if (null != $dados && isset($dados['id'])) {
            $entity = $this->em->getRepository($this->entity)->find($dados['id']);

            if ($entity) {
                $entity->__construct($dados);
                $this->persist($entity);
                return $entity;
            }
        }
        throw new \Exception("Dados vazios ou id indefinido.");
    }

    /**
     * Deleta um objeto
     * @param Integer $id Id do objeto a ser deletado
     * @return Integer O Id deletado
     * @throws \Exception Se o objeto não for encontrado ou o Id não for definido
     */
    public function delete($id)
    {
        if (null != $id) {
            $entity = $this->em->getRepository($this->entity)->find($id);

            if ($entity) {
                $this->em->remove($entity);
                $this->em->flush();
                return $id;
            } else {
                throw new \Exception('Registro não encontrado.');
            }
        }
        throw new \Exception("Id indefinido.");
    }

    /**
     * Persiste o objeto no banco de dados
     * @param object $entity Objeto a ser persistido no banco de dados
     * @return object O objeto persistido
     * @throws \Exception Caso ocorra erro durante a persistência
     */
    protected function persist($entity)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->persist($entity);
            $this->em->flush();
            $this->em->clear();
            $this->em->getConnection()->commit();
        } catch (\Exception $exc) {
            $this->em->getConnection()->rollback();
            $this->em->close();
            throw $exc;
        }

        return $entity;
    }

    /**
     * Checa se existe sessão aberta e se o perfil do usuário tem permissão para acessar o recurso
     * @throws \Exception Se não houver sessão aberta ou não houver permissão de acesso
     * @return void
     */
    protected function getPermissao()
    {
        if (null == $this->app['session']->get('usuario')) {
            throw new \Exception("Não permitido.", 403);
        }

        $callers = debug_backtrace();
        $metodo = $callers[1]['function'];
        $perfil = $this->app['session']->get('usuario')['perfil'];

        $permissao = new Permissao();

        if ($permissao->isValid($metodo, $perfil)) {
            return;
        } else {
            throw new \Exception("Não permitido.");
        }
    }

    /**
     * Executa consulta no banco de dados usando a cláusula LIKE
     * @param string $sql A query a ser usada na consulta
     * @param string $param O parâmetro de busca
     * @return array Resultado da consulta
     * @throws \Exception Caso ocorra erro durante a consulta
     */
    public function findLike($sql, $param)
    {
        try {
            $stmt = $this->em->getConnection()->prepare($sql);
            $stmt->bindValue('param', '%' . $param . '%', \PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $exc) {
            throw $exc;
        }
    }

    /**
     * Executa consulta no banco de dados usando a intervalo de datas
     * @param string $sql A query a ser usada na consulta
     * @param string $dateIni data inicial
     * @param string $dateFim data final
     * @return array
     * @throws \Exception Caso ocorra erro durante a consulta
     */
    public function findDateInterval($sql, $dateIni, $dateFim)
    {
        try {
            $dateIni = date_create_from_format('d/m/Y', $dateIni);
            $dateFim = date_create_from_format('d/m/Y', $dateFim);

            $stmt = $this->em->getConnection()->prepare($sql);
            $stmt->bindValue('dateIni', $dateIni->format('Y/m/d') . ' 00:00:00');
            $stmt->bindValue('dateFim', $dateFim->format('Y/m/d') . ' 23:59:59');

            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $exc) {
            throw $exc;
        }
    }

    /**
     * Exibe mensagem de sucesso da operação
     * @param array $params Dados para exibição na mensagem
     * @return mixed Tela de sucesso
     */
    public function msgSuccess(array $params)
    {
        return $this->app['twig']->render('success/success.twig', $params);
    }
}