<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'charts' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/charts',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'charts',
                    ),
                ),
            ),
            'forms' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/forms',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'forms',
                    ),
                ),
            ),
            'cadastrar' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/cadastrar',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Empresa',
                        'action'     => 'cadastrar',
                    ),
                ),
            ),
            'editar' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/editar/:id',
                    'constraints' => array(
                        'id' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Empresa',
                        'action'     => 'editar',
                    ),
                ),
            ),
            'deletar' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/deletar/:id',
                    'constraints' => array(
                        'id' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Empresa',
                        'action'     => 'deletar',
                    ),
                ),
            ),
            'ordenar' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/ordenar/:campo/:order',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Empresa',
                        'action'     => 'ordenarAjax',
                    ),
                ),
            ),
            'exportar' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/exportar[/:filter]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Empresa',
                        'action'     => 'exportar',
                    ),
                ),
            ),
            'suspender' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/suspender-ativar-toogle/:id/:status',
                    'constraints' => array(
                        'id' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Empresa',
                        'action'     => 'suspenderAtivarEmpresaToogleAjax',
                    ),
                ),
            ),
            'listar' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/listar',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Empresa',
                        'action'     => 'index',
                    ),
                ),
            ),
            'tables' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/tables',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'tables',
                    ),
                ),
            ),
            'bootstrap-elements' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/bootstrap-elements',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'bootstrapElements',
                    ),
                ),
            ),
            'login' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/login',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'login',
                    ),
                ),
            ),
            'logout' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/logout',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'logout',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Empresa' => 'Application\Controller\EmpresaController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
