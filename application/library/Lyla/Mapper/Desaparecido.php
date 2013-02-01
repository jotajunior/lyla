<?php
namespace Lyla\Mapper;

use Lyla\Common\ProxyMapper\Mapper;

class Desaparecido extends Mapper
{

    /**
     *
     * @return array 
     */
    public function getIdentifier()
    {
        return array('id');
    }

    /**
     * 
     * @return array
     */
    public function getProperties()
    {
        return array(
            'id' => 'id',
            'nome' => 'nome',
            'dataNasc' => 'data_nasc',
            'cor' => 'cor',
            'corOlhos' => 'cor_olhos',
            'altura' => 'altura',
            'tipoFisico' => 'tipo_fisico',
            'cidadeOrigem' => 'cidade_desap',
            'ufOrigem' => 'estado_desap',
            'contato' => 'contato',
            //# contatoTelefone: string
            'foto' => 'foto',
            'observacoes' => 'adicionais',
            'ativo' => 'ativo'
        );
    }

    /**
     * 
     * @return string
     */
    public function getRemoteEntity()
    {
        return 'desap';
    }
}
