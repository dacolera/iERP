<?php

namespace Application\Mapper\Hydrator;

class Empresa extends Hydrator
{
    protected function getEntity()
    {
        return 'Application\Entity\Empresa';
    }

    public function getMap()
    {
        return array(
            'enderecoId' => 'endereco_id'
        );
    }
}
