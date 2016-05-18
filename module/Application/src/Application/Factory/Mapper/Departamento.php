<?php

namespace Application\Factory\Mapper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Departamento implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = new \Application\Mapper\Departamento();
        $dbConfig = $serviceLocator->get('Configuration')['db'];
        $mapper
            ->setDbAdapter(new \Zend\Db\Adapter\Adapter($dbConfig))
            ->setEntityPrototype(new \Application\Entity\Departamento())
            ->setHydrator(new \Application\Mapper\Hydrator\Departamento());

        return $mapper;
    }
}
