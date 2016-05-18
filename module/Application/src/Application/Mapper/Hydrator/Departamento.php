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
        return array();
    }

    protected function getTemporary()
    {
        return array();
    }
}
