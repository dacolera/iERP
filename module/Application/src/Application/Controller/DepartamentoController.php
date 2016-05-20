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
            ->setDefaultItemCountPerPage(1);
        $viewHelperManager = $this->getServiceLocator()->get('ViewHelperManager');
        $paginationHelper = $viewHelperManager->get('paginationControl');
        
        $model = new ViewModel(['departamentos' => $paginator, 'paginator' => $paginationHelper]);
        return $model;
    }
    
    public function cadastrarAction()
    {
        if($this->getRequest()->isPost()) {
            
            $serviceDepartamento = $this->getServiceLocator()->get('Application\Service\Departamento');
            try {
                $serviceDepartamento->saveDepartamento(
                        $this->getRequest()->getPost()
                );
            } catch (\Eception $e) {
                throw $e;
            }

            $this->redirect()->toRoute('listarDepartamento');
        }
    }
}