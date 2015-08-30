<?php

namespace Application\Mapper\Hydrator;

class Usuario extends Hydrator
{
    protected function getEntity()
    {
        return 'Application\Entity\Usuario';
    }

    protected function getTemporary()
    {
        return array();
    }
}
