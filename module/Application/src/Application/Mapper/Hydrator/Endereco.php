<?php

namespace Application\Mapper\Hydrator;

class Endereco extends Hydrator
{
    protected function getEntity()
    {
        return 'Application\Entity\Endereco';
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
