<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\SessionManager;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $session = new SessionManager();
        $session->start();
        $eventManager->attach(
            'dispatch',
             array(
                $this,
                'secureSession'
            )
        ); 
    }

    public function secureSession($e) 
    { 
        $target = $e->getTarget(); 

        if(!$target instanceof \Application\Controller\IndexController 
            && (
                !isset($_SESSION['user']['logado']) || 
                !$_SESSION['user']['logado']
            )
        )
        {
            return $target->redirect()->toRoute('home');    
        }        
    } 

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                /*
                 * Configurações de Mappers
                 */
                'Application\Mapper\Empresa' => 'Application\Factory\Mapper\Empresa',
                'Application\Mapper\Endereco' => 'Application\Factory\Mapper\Endereco',
                'Application\Mapper\Usuario' => 'Application\Factory\Mapper\Usuario'
            ),
            'invokables' => array(
                'Application\Service\Empresa' => 'Application\Service\Empresa'
            )
        );
    }                        
}
