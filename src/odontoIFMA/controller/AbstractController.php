<?php

namespace odontoIFMA\controller;
use odontoIFMA\entity\Permissao;

abstract class AbstractController
{
    protected $app;
    protected $em;
    protected $entity;

    public function insert($dados)
    {
        if (null != $dados) {
            $entity = new $this->entity($dados);
            $this->persist($entity);
            return $entity;
        }

        throw new \Exception("Dados vazios.");
    }

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
     * @param Integer $id
     * @return Integer / null
     * @throws \Exception
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

    protected function getPermissao()
    {
        if (null == $this->app['session']->get('usuario')) {
            throw new \Exception("Não permitido.", 403);
        }

        $callers=debug_backtrace();
        $metodo = $callers[1]['function'];
        $perfil = $this->app['session']->get('usuario')['perfil'];

        $permissao = new Permissao();

        if($permissao->isValid($metodo,$perfil)){
            return;
        }else{
            throw new \Exception("Não permitido.");
        }
    }

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

    public function msgSuccess(array $params)
    {
        return $this->app['twig']->render('success/success.twig', $params);
    }

}