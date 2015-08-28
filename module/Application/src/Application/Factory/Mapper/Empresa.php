<?php

namespace Application\Factory\Mapper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Empresa implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = new \Application\Mapper\Empresa(
            $serviceLocator->get('Application\Mapper\Usuario'),
            $serviceLocator->get('Application\Mapper\Endereco')
        );
        $dbConfig = $serviceLocator->get('Configuration')['db'];
        $mapper
            ->setDbAdapter(new \Zend\Db\Adapter\Adapter($dbConfig))
            ->setEntityPrototype(new \Application\Entity\Empresa())
            ->setHydrator(new \Application\Mapper\Hydrator\Empresa());

        return $mapper;
    }
}