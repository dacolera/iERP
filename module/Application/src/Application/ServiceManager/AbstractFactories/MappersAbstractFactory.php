<?php

namespace Application\ServiceManager\AbstractFactories;

use Tests\Bootstrap;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Storage cache factory for multiple caches.
 */
class MappersAbstractFactory implements AbstractFactoryInterface
{
    /**
     * Determine if we can create a service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return bool
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return fnmatch('*Mapper*', $requestedName);
    }

    /**
     * Create service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return mixed
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        if(!class_exists($requestedName)) {
            return false;
        }

        //fullqualifiedname das mappers \Application\Mapper\?
        //instanciar a mapper

        $mapper = new $requestedName;

        //extrair a chave de montagem
        $assembleKey = substr($requestedName, (strrpos($requestedName, '\\') + 1));
        //extrair o root Namespace da request
        $rootNamespace = substr($requestedName, 0, strpos($requestedName, '\\'));
        //montar o nome da entidade
        $entityClass = "$rootNamespace\\Entity\\$assembleKey";
        //montar o nome da hydrator
        $hydratorClass = "$rootNamespace\\Mapper\\Hydrator\\$assembleKey";
        //injetar as dependencias caso necessario


            //$dbConfig = $serviceLocator->get('Configuration')['db'];

        //fallback para os teste

        //TODO descobrir porque isso eh necessario
        //if (!is_array($dbConfig)) {
            $dbConfig = array(
                'driver' => 'Pdo',
                'dsn' => 'mysql:dbname=ierp;host=localhost',
                'username' => 'root',
                'password' => '2013',
                'driver_options' => array(
                    \PDO::MYSQL_ATTR_INIT_COMMAND =>
                        'SET NAMES \'UTF8\''
                )
            );
        //}

        $mapper->setDbAdapter(new \Zend\Db\Adapter\Adapter($dbConfig));
        if (class_exists($entityClass)) {
            $mapper->setEntityPrototype(new $entityClass);
            if (class_exists($hydratorClass)) {
                $mapper->setHydrator(new $hydratorClass);
            }
        }
        return $mapper;
    }
}