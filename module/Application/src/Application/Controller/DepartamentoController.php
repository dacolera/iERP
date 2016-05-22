<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Adapter\Iterator;
use Zend\Paginator\Factory;
use Zend\Paginator\Paginator;

class DepartamentoController extends AbstractActionController
{
    public function indexAction()
    {
        $busca = $this->params()->fromQuery('busca', null);
        $field = $this->params()->fromQuery('field', null);
        
        $serviceDepartamento = $this->getServiceLocator()->get('Application\Service\Departamento');
        $listaDepartamentos = $serviceDepartamento->pegarDepartamentos($field, $busca);
        $listaDepartamentos->buffer();
        
        $paginator = new Paginator(new Iterator($listaDepartamentos));
        $page = $this->params()->fromRoute('page', false);
        
        $paginator->setCurrentPageNumber($page)
            ->setDefaultItemCountPerPage(10);
        $viewHelperManager = $this->getServiceLocator()->get('ViewHelperManager');
        $paginationHelper = $viewHelperManager->get('paginationControl');
        
        $model = new ViewModel(['departamentos' => $paginator, 'paginator' => $paginationHelper]);
        return $model;
    }
    
    public function cadastrarAction()
    {
        if ($this->getRequest()->isPost()) {
            
            $serviceDepartamento = $this->getServiceLocator()->get('Application\Service\Departamento');
            try {
                $serviceDepartamento->saveDepartamento(
                    $this->getRequest()->getPost()
                );
            } catch (\Exception $e) {
                throw $e;
            }

            $this->redirect()->toRoute('listarDepartamento');
        }
    }
    
    public function editarAction()
    {
        $id = $this->params()->fromRoute('id', false);
        
        if ($this->getRequest()->isPost()) {
            
            $serviceDepartamento = $this->getServiceLocator()->get('Application\Service\Departamento');
            try {
                $serviceDepartamento->saveDepartamento(
                    $this->getRequest()->getPost()
                );
            } catch (\Exception $e) {
                throw $e;
            }

            $this->redirect()->toRoute('listarDepartamento');
        }
        
        $serviceDepartamento = $this->getServiceLocator()->get('Application\Service\Departamento');
        $departamento = $serviceDepartamento->pegarDepartamentoPorId($id);
        
        $view = new ViewModel();
        $view->setVariable('departamento', $departamento);
        
        return $view;
    }
    
    public function deletarAction()
    {
        $id =  $this->params()->fromRoute('id', false);

        if($id) {
            $serviceEmpresa = $this->getServiceLocator()->get('Application\Service\Departamento');

            try {
                $serviceEmpresa->deletarDepartamento($id);
            } catch (\Exception $e) {
                throw $e;
            }

            $this->redirect()->toRoute('listarDepartamento');
        }
    }

    public function detalheAction()
    {
        $id =  $this->params()->fromRoute('id', false);

        if($id) {
            $serviceDepartamento = $this->getServiceLocator()->get('Application\Service\Departamento');
            $model = new ViewModel();
            $model->setVariable(
                'departamento',
                (new \Application\Mapper\Hydrator\Departamento)
                    ->extract($serviceDepartamento->pegarDepartamentoPorId($id))
            );
            return $model;
        }
        $this->redirect()->toRoute('listarDepartamento');
    }
    
    public function suspenderAtivarDepartamentoToogleAjaxAction()
    {
        if($this->getRequest()->isXmlHttpRequest()){
            $id =  $this->params()->fromRoute('id', false);
            $status = $this->params()->fromRoute('status', false);
            if($id && $status) {
                $service = $this->getServiceLocator()->get('Application\Service\Departamento');
                $model = new ViewModel();
                $model->setTerminal(true);
                try {
                    $service->suspenderAtivarToogleDepartamento($id, $status);
                    $retorno = array('status' => 'ok');
                } catch (\Exception $e) {
                    throw $e;
                }
                echo  json_encode($retorno);
                exit;
            }
        }
        $this->redirect()->toRoute('listarDepartamento');
    }
    
    public function exportarAction()
    {
            //pega o service de empresa
            $serviceDep = $this->getServiceLocator()->get('Application\Service\Departamento');
            $serviceExport = $this->getServiceLocator()->get('Application\Service\Export');
            //pega o(s) parametros de filtro da rota ajax
            $busca = $this->params()->fromQuery('busca', null);
            $field = $this->params()->fromQuery('field', null);

            //realiza a query e retorna array
            $listaDepartamentos = $serviceDep->pegarDepartamentos($field, $busca);//$serviceEmp->pegarEmpresasExcel($filter);
            //chama o exporta excel
            $serviceExport->exportExcel($listaDepartamentos, 'Listagem de Departamentos');
    }
}