<?php

namespace Application\Mapper\Hydrator;

class Departamento extends Hydrator
{
    protected function getEntity()
    {
        return 'Application\Entity\Departamento';
    }

    public function getMap()
    {
        return array(
            'id' => 'id_departamento'    
        );
    }

    protected function getTemporary()
    {
        return array();
    }
}
