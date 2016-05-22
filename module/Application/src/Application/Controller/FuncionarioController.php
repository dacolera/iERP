<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Adapter\Iterator;
use Zend\Paginator\Factory;
use Zend\Paginator\Paginator;

class FuncionarioController extends AbstractActionController
{
    public function indexAction()
    {
        $busca = $this->params()->fromQuery('busca', null);
        $field = $this->params()->fromQuery('field', null);
        
        $serviceFuncionario = $this->getServiceLocator()->get('Application\Service\Funcionario');
        $serviceDepartamento = $this->getServiceLocator()->get('Application\Service\Departamento');
        
        $listaFuncionarios = $serviceFuncionario->pegarFuncionarios($field, $busca);
        $listaFuncionarios->buffer();
        
        $paginator = new Paginator(new Iterator($listaFuncionarios));
        $page = $this->params()->fromRoute('page', false);
        
        $paginator->setCurrentPageNumber($page)
            ->setDefaultItemCountPerPage(10);
        $viewHelperManager = $this->getServiceLocator()->get('ViewHelperManager');
        $paginationHelper = $viewHelperManager->get('paginationControl');
        
        $model = new ViewModel([
            'funcionarios' => $paginator,
            'paginator' => $paginationHelper, 
            'departamentos' => array_column(
                iterator_to_array(
                    $serviceDepartamento->pegarDepartamentos('status', 'A')
                        ->getDataSource()
                ),
                'nome',
                'id_departamento'
            )
        ]);
        return $model;
    }
    
    public function cadastrarAction()
    {
        if ($this->getRequest()->isPost()) {
            
            $serviceFuncionario  = $this->getServiceLocator()->get('Application\Service\Funcionario');
            try {
                $serviceFuncionario->saveFuncionario(
                    $this->getRequest()->getPost()
                );
            } catch (\Exception $e) {
                throw $e;
            }

            $this->redirect()->toRoute('listarFuncionario');
        }
        $serviceDepartamento = $this->getServiceLocator()->get('Application\Service\Departamento');
        $view = new ViewModel(['departamentos' => $serviceDepartamento->pegarDepartamentos('status', 'A')]);
        return $view;
    }
    
    public function editarAction()
    {
        $id = $this->params()->fromRoute('id', false);
        
        if ($this->getRequest()->isPost()) {
            
            $serviceFuncionario = $this->getServiceLocator()->get('Application\Service\Funcionario');
            try {
                $serviceFuncionario->saveFuncionario(
                    $this->getRequest()->getPost()
                );
            } catch (\Exception $e) {
                throw $e;
            }

            $this->redirect()->toRoute('listarFuncionario');
        }
        
        $serviceFuncionario = $this->getServiceLocator()->get('Application\Service\Funcionario');
        $serviceDepartamento = $this->getServiceLocator()->get('Application\Service\Departamento');
        $funcionario = $serviceFuncionario->pegarFuncionarioPorId($id);
        
        $view = new ViewModel([
            'departamentos' => array_column(
                iterator_to_array(
                    $serviceDepartamento->pegarDepartamentos('status', 'A')
                        ->getDataSource()
                ),
                'nome',
                'id_departamento'
            ),
            'funcionario' => $funcionario   
        ]);
        
        return $view;
    }
    
    public function deletarAction()
    {
        $id =  $this->params()->fromRoute('id', false);

        if($id) {
            $serviceFuncionario = $this->getServiceLocator()->get('Application\Service\Funcionario');

            try {
                $serviceFuncionario->deletarFuncionario($id);
            } catch (\Exception $e) {
                throw $e;
            }

            $this->redirect()->toRoute('listarFuncionario');
        }
    }

    public function detalheAction()
    {
        $id =  $this->params()->fromRoute('id', false);

        if($id) {
            $serviceFuncionario = $this->getServiceLocator()->get('Application\Service\Funcionario');
            $model = new ViewModel();
            $model->setVariable(
                'funcionario',
                (new \Application\Mapper\Hydrator\Funcionario)
                    ->extract($serviceFuncionario->pegarFuncionarioPorId($id))
            );
            return $model;
        }
        $this->redirect()->toRoute('listarFuncionario');
    }
    
    public function suspenderAtivarFuncionarioToogleAjaxAction()
    {
        if($this->getRequest()->isXmlHttpRequest()){
            $id =  $this->params()->fromRoute('id', false);
            $status = $this->params()->fromRoute('status', false);
            if($id && $status) {
                $service = $this->getServiceLocator()->get('Application\Service\Funcionario');
                $model = new ViewModel();
                $model->setTerminal(true);
                try {
                    $service->suspenderAtivarToogleFuncionario($id, $status);
                    $retorno = array('status' => 'ok');
                } catch (\Exception $e) {
                    throw $e;
                }
                echo  json_encode($retorno);
                exit;
            }
        }
        $this->redirect()->toRoute('listarFuncionario');
    }
    
    public function exportarAction()
    {
            //pega o service de empresa
            $serviceFunc = $this->getServiceLocator()->get('Application\Service\Funcionario');
            $serviceExport = $this->getServiceLocator()->get('Application\Service\Export');
            //pega o(s) parametros de filtro da rota ajax
            $busca = $this->params()->fromQuery('busca', null);
            $field = $this->params()->fromQuery('field', null);

            //realiza a query e retorna array
            $listaFuncionarios = $serviceFunc->pegarFuncionarios($field, $busca);//$serviceEmp->pegarEmpresasExcel($filter);
            //chama o exporta excel
            $serviceExport->exportExcel($listaFuncionarios, 'Listagem de Funcionarios');
    }
}