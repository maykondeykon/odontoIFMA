<?php

namespace odontoIFMA\entity;


class Permissao
{
    private $permissoes = array(
        'ATENDENTE' => array(
            'recursos' => array(
                'home',
                'cadTipoPaciente',
                'cadTipoCampus',
                'cadOperador',
            ),
            'heranca' => null
        ),
        'DENTISTA' => array(
            'recursos' => array(
                'cadAnamnese',
            ),
            'heranca' => 'ATENDENTE'
        ),
        'ADMINISTRADOR' => array(
            'recursos' => array(
                'cadTipoOperador',
            ),
            'heranca' => 'DENTISTA'
        ),
    );

    /**
     * @param $perfil -- Perfil do usuário
     * @return array -- lista de todas os recursos desponíveis
     */
    public function getPermissoes($perfil)
    {
        $rec1 = $this->permissoes[$perfil]['recursos'];
        $heranca = $this->permissoes[$perfil]['heranca'];

        while($heranca){
            $perfil = $heranca;
            $rec2 = $this->permissoes[$heranca]['recursos'];
            $rec1 = array_merge($rec2, $rec1);
            $heranca = $this->permissoes[$perfil]['heranca'];
        }

        return $rec1;
    }

    /**
     * @param $rota -- recurso a testar
     * @param $perfil -- perfil para checagem
     * @return bool -- retorna true se possui permissão, false se não
     */
    public function isValid($rota, $perfil)
    {
        if (in_array($rota, $this->getPermissoes($perfil))) {
            return true;
        }
        return false;
    }
}