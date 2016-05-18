<?php

namespace Application\Factory\Mapper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Funcionario implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = new \Application\Mapper\Funcionario();
        $dbConfig = $serviceLocator->get('Configuration')['db'];
        $mapper
            ->setDbAdapter(new \Zend\Db\Adapter\Adapter($dbConfig))
            ->setEntityPrototype(new \Application\Entity\Funcionario())
            ->setHydrator(new \Application\Mapper\Hydrator\Funcionario());

        return $mapper;
    }
}
