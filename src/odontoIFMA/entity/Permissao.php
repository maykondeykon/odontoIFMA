<?php

namespace odontoIFMA\entity;

class Permissao
{
    private $permissoes = array(
        'ATENDENTE' => array(
            'recursos' => array(
                'home' => array('principal','home','fa fa-fw fa-home','Home'), //nome do método => grupo de botões, nome da rota, ícone, texto de exibição
                'paciente' => array('cadastros','cadPaciente','fa fa-fw fa-edit','Cadastro Paciente'),
                'tipoCampus' => array('cadastros','cadTipoCampus','fa fa-fw fa-edit','Cadastro Campus'),
                'operador' => array('cadastros','cadOperador','fa fa-fw fa-edit','Cadastro Operador'),
                'consultas' => array('principal','consultas','fa fa-fw fa-search','Consultas'),
                'atendimento' => array('cadastros','cadAtendimento','fa fa-fw fa-edit','Agendar Atendimento'),
            ),
            'heranca' => null
        ),
        'DENTISTA' => array(
            'recursos' => array(
                'anamnese' => array('principal','cadAnamnese','fa fa-fw fa-edit','Anamnese'),
            ),
            'heranca' => 'ATENDENTE'
        ),
        'ADMINISTRADOR' => array(
            'recursos' => array(
                'tipoOperador' => array('cadastros','cadTipoOperador','fa fa-fw fa-edit','Cadastro Tipo Operador'),
                'testePermissao' => array('testes','testePermissao','fa fa-fw fa-edit','Testes'),
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
        if (array_key_exists($rota, $this->getPermissoes($perfil))) {
            return true;
        }
        return false;
    }
}