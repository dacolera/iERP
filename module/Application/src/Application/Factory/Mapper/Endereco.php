<?php

namespace Application\Factory\Mapper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Endereco implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = new \Application\Mapper\Endereco();
        $dbConfig = $serviceLocator->get('Configuration')['db'];
        $mapper
            ->setDbAdapter(new \Zend\Db\Adapter\Adapter($dbConfig))
            ->setentityprototype(new \Application\Entity\Endereco())
            ->setHydrator(new \Application\Mapper\Hydrator\Endereco());

        return $mapper;
    }
}