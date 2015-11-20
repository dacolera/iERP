<?php

namespace Tests;

use PHPUnit_Framework_TestCase as TestCase;

class ServiceManagerTest extends TestCase
{
    protected $instance;

    public function setUp()
    {
        $this->instance = Bootstrap::getServiceManager();
    }

    public function getServiceManager()
    {
        return $this->instance;
    }

    public function getServices()
    {
        return array(
            array('Application\\Service\\Empresa', 'Application\\Service\\Empresa')
        );
    }

    public function getControllers()
    {
        return array(
            array('Application\\Controller\\Index', 'Application\\Controller\\IndexController'),
            array('Application\\Controller\\Empresa', 'Application\\Controller\\EmpresaController'),
        );
    }

    public function getMappers()
    {
        return array(
            array('Application\\Mapper\\Usuario', 'Application\\Mapper\\Usuario'),
            array('Application\\Mapper\\Endereco', 'Application\\Mapper\\Endereco'),
            array('Application\\Mapper\\Empresa', 'Application\\Mapper\\Empresa'),
        );
    }

    /**
     * @test
     * @dataProvider getServices
     **/
    public function servicos_instanciados_corretamente_pelo_service_manager($serviceKey, $className)
    {
        $this->assertInstanceOf($className, $this->getServiceManager()->get($serviceKey));
    }

    /**
     * @test
     * @dataProvider getControllers
     **/
    public function controllers_instanciados_corretamente_pelo_service_manager($serviceKey, $className)
    {
        $this->assertInstanceOf($className, $this->getServiceManager()->get('ControllerLoader')->get($serviceKey));
    }

    /**
     * @test
     * @dataProvider getMappers
     **/
    public function mappers_instanciados_corretamente_pelo_service_manager($serviceKey, $className)
    {
        $this->assertInstanceOf($className, $this->getServiceManager()->get($serviceKey));
    }
}