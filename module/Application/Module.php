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
       $eventManager->attach(
            'dispatch',
            array(
                $this,
                'activeAction'
            ),
            -100
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
    
    public function activeAction($e)
    {
        $routeMatch = $e->getRouteMatch();
        $viewModel = $e->getViewModel();
        $viewModel->setVariable(
            'controller',
            substr(
                $routeMatch->getParam('controller'),
                (strrpos($routeMatch->getParam('controller'), '\\') +1)
            )
        );
        
        $viewModel->setVariable('action', $routeMatch->getParam('action'));
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
                'Application\Mapper\Usuario' => 'Application\Factory\Mapper\Usuario',
                'Application\Mapper\Departamento' => 'Application\Factory\Mapper\Departamento',
                'Application\Mapper\Funcionario' => 'Application\Factory\Mapper\Funcionario'
            ),
            'invokables' => array(
                'Application\Service\Empresa' => 'Application\Service\Empresa',
                'Application\Service\Departamento' => 'Application\Service\Departamento',
                'Application\Service\Funcionario' => 'Application\Service\Funcionario',
                'Application\Service\Export' => 'Application\Service\Export'
            )
        );
    }                        
}
