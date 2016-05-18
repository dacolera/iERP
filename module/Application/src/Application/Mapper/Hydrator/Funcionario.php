<?php

namespace Application\Mapper\Hydrator;

class Funcionario extends Hydrator
{
    protected function getEntity()
    {
        return 'Application\Entity\Funcionario';
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
