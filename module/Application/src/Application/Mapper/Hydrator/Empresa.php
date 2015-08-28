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
            'endereco_id' => 'end_id'
        );
    }

    protected function getTemporary()
    {
        return array('endereco','usuario');
    }
}
