<?php

namespace Application\Mapper\Hydrator;

class Empresa extends Hydrator
{
    protected function getEntity()
    {
        return 'Application\Entity\Empresa';
    }

    /**
     * Recupera mapeamento de atributos da entidade para campos do banco 
     * @return array(string => mixed)
     */
    public function extract($entity)
    {
        $return = parent::extract($entity);
        return $return;
    }

    /**
     * Transforma o array de dados na entidade
     * @param Array $data
     * @param ConviteVaga\Entity\Empresa $object
     * @return ConviteVaga\Entity\Empresa
     */
    public function hydrate(array $data, $object)
    {
        return parent::hydrate($data, $object);
    }

    protected function getMap()
    {
        return array(
           'id' => 'usr_id',
           'enderecoId' => 'endereco_id'     
        );
    }
}
