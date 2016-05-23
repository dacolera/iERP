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
            'getCep' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/buscacep/:cep',
                    'constraints' => array(
                        'cep' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'getCepAjax',
                    ),
                ),    
            ),
            'cadastrarEmpresa' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/empresa/cadastrar',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Empresa',
                        'action'     => 'cadastrar',
                    ),
                ),
            ),
            'editarEmpresa' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/empresa/editar/:id',
                    'constraints' => array(
                        'id' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Empresa',
                        'action'     => 'editar',
                    ),
                ),
            ),
            'deletarEmpresa' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/empresa/deletar/:id',
                    'constraints' => array(
                        'id' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Empresa',
                        'action'     => 'deletar',
                    ),
                ),
            ),
            'detalheEmpresa' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/empresa/detalhe/:id',
                    'constraints' => array(
                        'id' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Empresa',
                        'action'     => 'detalhe',
                    ),
                ),
            ),
            'exportarEmpresa' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/empresa/exportar',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Empresa',
                        'action'     => 'exportar',
                    ),
                ),
            ),
            'suspenderEmpresa' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/empresa/suspender-ativar-toogle/:id/:status',
                    'constraints' => array(
                        'id' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Empresa',
                        'action'     => 'suspenderAtivarEmpresaToogleAjax',
                    ),
                ),
            ),
            'listarEmpresa' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/empresa/listar[/page][/:page]',
                    'constraints' => array(
                        'page' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Empresa',
                        'action'     => 'index',
                        'page' => 1,
                    ),
                ),
            ),
            'cadastrarDepartamento' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/departamento/cadastrar',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Departamento',
                        'action'     => 'cadastrar',
                    ),
                ),
            ),
            'editarDepartamento' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/departamento/editar/:id',
                    'constraints' => array(
                        'id' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Departamento',
                        'action'     => 'editar',
                    ),
                ),
            ),
            'deletarDepartamento' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/departamento/deletar/:id',
                    'constraints' => array(
                        'id' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Departamento',
                        'action'     => 'deletar',
                    ),
                ),
            ),
            'detalheDepartamento' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/departamento/detalhe/:id',
                    'constraints' => array(
                        'id' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Departamento',
                        'action'     => 'detalhe',
                    ),
                ),
            ),
            'exportarDepartamento' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/departamento/exportar',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Departamento',
                        'action'     => 'exportar',
                    ),
                ),
            ),
            'suspenderDepartamento' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/departamento/suspender-ativar-toogle/:id/:status',
                    'constraints' => array(
                        'id' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Departamento',
                        'action'     => 'suspenderAtivarDepartamentoToogleAjax',
                    ),
                ),
            ),
            'listarDepartamento' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/departamento/listar[/page][/:page]',
                    'constraints' => array(
                        'page' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Departamento',
                        'action'     => 'index',
                        'page' => 1,
                    ),
                ),
            ),
            'cadastrarFuncionario' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/funcionario/cadastrar',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Funcionario',
                        'action'     => 'cadastrar',
                    ),
                ),
            ),
            'editarFuncionario' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/funcionario/editar/:id',
                    'constraints' => array(
                        'id' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Funcionario',
                        'action'     => 'editar',
                    ),
                ),
            ),
            'deletarFuncionario' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/funcionario/deletar/:id',
                    'constraints' => array(
                        'id' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Funcionario',
                        'action'     => 'deletar',
                    ),
                ),
            ),
            'detalheFuncionario' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/funcionario/detalhe/:id',
                    'constraints' => array(
                        'id' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Funcionario',
                        'action'     => 'detalhe',
                    ),
                ),
            ),
            'exportarFuncionario' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/funcionario/exportar',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Funcionario',
                        'action'     => 'exportar',
                    ),
                ),
            ),
            'suspenderFuncionario' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/funcionario/suspender-ativar-toogle/:id/:status',
                    'constraints' => array(
                        'id' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Funcionario',
                        'action'     => 'suspenderAtivarFuncionarioToogleAjax',
                    ),
                ),
            ),
            'listarFuncionario' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/funcionario/listar[/page][/:page]',
                    'constraints' => array(
                        'page' => '\d+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Funcionario',
                        'action'     => 'index',
                        'page' => 1,
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
            'download' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/download/nfe',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'download',
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
            'Application\Controller\Empresa' => 'Application\Controller\EmpresaController',
            'Application\Controller\Funcionario' => 'Application\Controller\FuncionarioController',
            'Application\Controller\Departamento' => 'Application\Controller\DepartamentoController'
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
